<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactUsController extends Controller
{
    public function contactUs()
    {
        return view('frontend.pages.contactUs');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'g-recaptcha-response' => 'required',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe'),
            'response' => $request->get('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (!$response->json('success')) {
            return response()->json([
                'status' => 'false',
                'message' => 'reCAPTCHA verification failed. Please try again.'
            ], 422);
        }

        Contact::create($request->only([
            'name',
            'email',
            'phone',
            'subject',
            'message',
        ]));

        return response()->json([
            'status' => 'true', 
            'message' => 'Your message has been sent successfully!'
        ]);
    }
}
