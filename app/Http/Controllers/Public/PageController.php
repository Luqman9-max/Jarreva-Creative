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

        // 1. Save to database FIRST (so data is never lost)
        ContactMessage::create($validated);

        // 2. Send email AFTER response is sent (non-blocking)
        dispatch(function () use ($validated) {
            try {
                Mail::to('jarrevacreative@gmail.com')->send(new ContactFormMail($validated));
                Log::info('Contact form email sent for: ' . $validated['email']);
            } catch (\Exception $e) {
                Log::error('Contact form email failed: ' . $e->getMessage());
            }
        })->afterResponse();

        // 3. Return success immediately (user sees animation right away)
        return response()->json(['success' => true, 'message' => 'Signal received.']);
    }
}
