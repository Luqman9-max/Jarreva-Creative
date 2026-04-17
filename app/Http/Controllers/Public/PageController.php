<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactFormMail;

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

        // 2. Queue email for background processing (instant, no SMTP wait)
        Mail::to('jarrevacreative@gmail.com')->queue(new ContactFormMail($validated));

        Log::info('Contact message queued from: ' . $validated['email']);

        // 3. Return success immediately
        return response()->json(['success' => true, 'message' => 'Signal received.']);
    }
}
