<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);

        // Save to database
        Subscriber::create($validated);

        Log::info('New subscriber: ' . $validated['email']);

        // Return success immediately — admin sees new subscribers in the database
        return response()->json([
            'message' => 'Sys_Uplink: Signal accepted.',
        ], 201);
    }
}
