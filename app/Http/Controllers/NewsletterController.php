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

        // 1. Save to database
        $subscriber = Subscriber::create($validated);

        // 2. Queue email for background processing (instant, no SMTP wait)
        Mail::to('jarrevacreative@gmail.com')->queue(new NewSubscriberNotification($subscriber->email));

        Log::info('New subscriber queued: ' . $validated['email']);

        // 3. Return success immediately
        return response()->json([
            'message' => 'Sys_Uplink: Signal accepted.',
        ], 201);
    }
}
