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

        $subscriber = Subscriber::create($validated);

        // Send email notification (non-blocking — don't fail the response if mail fails)
        try {
            Mail::to('jarrevacreative@gmail.com')->send(new NewSubscriberNotification($subscriber->email));
            Log::info('Subscriber notification email sent successfully to jarrevacreative@gmail.com for: ' . $subscriber->email);
        } catch (\Exception $e) {
            Log::error('Subscriber notification email failed: ' . $e->getMessage());
        }

        return response()->json([
            'message' => 'Sys_Uplink: Signal accepted.',
            'subscriber' => $subscriber
        ], 201);
    }
}
