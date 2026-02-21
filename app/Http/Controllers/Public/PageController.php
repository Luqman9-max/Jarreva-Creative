<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        try {
            Mail::to('jarrevacreative@gmail.com')->send(new ContactFormMail($validated));
            
            return response()->json(['success' => true, 'message' => 'Signal received.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Transmission failed. Please try again.'], 500);
        }
    }
}
