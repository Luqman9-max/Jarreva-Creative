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

        // 2. Prepare a lightweight JSON response (no Eloquent model serialization)
        $responseData = [
            'message' => 'Sys_Uplink: Signal accepted.',
        ];

        // 3. Send response with Connection: close header to force immediate delivery
        //    This ensures the browser receives the response BEFORE afterResponse() runs
        $response = response()->json($responseData, 201);
        $response->headers->set('Connection', 'close');

        // 4. Send email AFTER response is fully sent (non-blocking)
        $subscriberEmail = $subscriber->email;
        dispatch(function () use ($subscriberEmail) {
            try {
                Mail::to('jarrevacreative@gmail.com')->send(new NewSubscriberNotification($subscriberEmail));
                Log::info('Subscriber notification sent for: ' . $subscriberEmail);
            } catch (\Exception $e) {
                Log::error('Subscriber notification failed: ' . $e->getMessage());
            }
        })->afterResponse();

        return $response;
    }
}
