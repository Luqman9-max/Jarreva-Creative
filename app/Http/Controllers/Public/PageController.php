<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Jobs\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'topic' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // 1. Save to database
        ContactMessage::create($validated);

        // 2. Queue email notification via Resend HTTP API
        $html = view('emails.contact-form', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'topic' => $validated['topic'],
            'messageContent' => $validated['message'],
        ])->render();

        SendEmailNotification::dispatch(
            'jarrevacreative@gmail.com',
            'New Contact Form: ' . $validated['topic'],
            $html,
            $validated['email']  // reply-to user's email
        );

        Log::info('Contact message queued from: ' . $validated['email']);

        // 3. Return success immediately
        return response()->json(['success' => true, 'message' => 'Signal received.']);
    }
}
