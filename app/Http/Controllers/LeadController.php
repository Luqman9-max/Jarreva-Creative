<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Cookie;

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

        Lead::create($validated);

        // Set cookie for 1 year (60 minutes * 24 hours * 365 days)
        $cookie = Cookie::make('jarreva_lead_captured', true, 60 * 24 * 365);

        return redirect()->route('catalog.index')->withCookie($cookie);
    }
}
