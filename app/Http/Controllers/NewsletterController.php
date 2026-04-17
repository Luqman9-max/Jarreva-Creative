<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Jobs\SendEmailNotification;
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

        // 2. Queue email notification via Resend HTTP API
        $html = view('emails.new_subscriber', ['subscriberEmail' => $subscriber->email])->render();
        SendEmailNotification::dispatch(
            'jarrevacreative@gmail.com',
            'New System Subscriber: ' . $subscriber->email,
            $html
        );

        Log::info('New subscriber queued: ' . $validated['email']);

        // 3. Return success immediately
        return response()->json([
            'message' => 'Sys_Uplink: Signal accepted.',
        ], 201);
    }
}
