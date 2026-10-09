<?php

namespace App\Http\Controllers;

use App\Models\RegistrationSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_title_dates' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_address' => 'required|string',
            'phone' => 'required|string|max:30',
            'country' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'diocese_congregation' => 'required|string|max:255',
            'religious_theological_non_academic' => 'required|string|max:255',
            'religious_theological_academic' => 'required|string',
            'secular' => 'nullable|string',
            'present_ministry' => 'required|string',
            'interests' => 'nullable|string',
            'g-recaptcha-response' => 'required',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe'),
            'response' => $request->get('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (! $response->json('success')) {
            return response()->json([
                'status' => 'false',
                'recaptcha_error' => true,
                'message' => 'reCAPTCHA verification failed. Please try again.',
            ], 422);
        }

        unset($validated['g-recaptcha-response']);

        RegistrationSubmission::create($validated);

        return response()->json([
            'status' => 'true',
            'message' => 'Your registration has been submitted successfully!',
        ]);
    }
}
