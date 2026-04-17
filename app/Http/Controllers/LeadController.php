<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Jobs\SendEmailNotification;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class LeadController extends Controller
{
    /**
     * Entry point from the 'Evolve' button
     */
    public function evolve()
    {
        return redirect()->route('catalog.index');
    }

    /**
     * Show the lead capture form
     */
    public function showForm(Request $request)
    {
        // If they already have the cookie, redirect directly to catalog
        if ($request->cookie('jarreva_lead_captured')) {
            return redirect()->route('catalog.index');
        }

        return view('public.lead-form');
    }

    /**
     * Handle the form submission
     */
    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:leads,email',
        ], [
            'email.unique' => 'This email is already registered. You will be redirected to the catalog.'
        ]);

        // 1. Save to database
        Lead::create($validated);

        // 2. Queue email notification via Resend HTTP API
        $html = view('emails.new_lead', [
            'leadName' => $validated['name'],
            'leadEmail' => $validated['email'],
        ])->render();

        SendEmailNotification::dispatch(
            'jarrevacreative@gmail.com',
            'New Lead Captured: ' . $validated['name'],
            $html,
            $validated['email']  // reply-to user's email
        );

        Log::info('New lead queued: ' . $validated['email']);

        // 3. Set cookie and redirect immediately
        $cookie = Cookie::make('jarreva_lead_captured', true, 60 * 24 * 365);

        return redirect()->route('catalog.index')->withCookie($cookie);
    }
}
