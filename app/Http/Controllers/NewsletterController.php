<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Mail\NewSubscriberNotification;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);

        try {
            $subscriber = Subscriber::create($validated);
            Mail::to('jarrevacreative@gmail.com')->send(new NewSubscriberNotification($subscriber->email));
            
            return response()->json([
                'message' => 'Sys_Uplink: Signal accepted.',
                'subscriber' => $subscriber
            ], 201);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Newsletter Subscription Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
            return response()->json([
                'message' => 'Sys_Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
