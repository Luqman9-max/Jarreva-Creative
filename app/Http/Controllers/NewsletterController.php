<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Mail\NewSubscriberNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);

        // 1. Save to database FIRST
        $subscriber = Subscriber::create($validated);

        // 2. Send email AFTER response is sent (non-blocking)
        $subscriberEmail = $subscriber->email;
        dispatch(function () use ($subscriberEmail) {
            try {
                Mail::to('jarrevacreative@gmail.com')->send(new NewSubscriberNotification($subscriberEmail));
                Log::info('Subscriber notification sent for: ' . $subscriberEmail);
            } catch (\Exception $e) {
                Log::error('Subscriber notification failed: ' . $e->getMessage());
            }
        })->afterResponse();

        // 3. Return success immediately
        return response()->json([
            'message' => 'Sys_Uplink: Signal accepted.',
            'subscriber' => $subscriber
        ], 201);
    }
}
