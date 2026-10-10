<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\FlashNews;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactUsController extends Controller
{
    public function contactUs()
    {
        $flashNews = FlashNews::where('status', 1)
            ->orderBy('publish_date', 'desc')
            ->get();

        return Inertia::render('Contact', [
            'flashNews' => $flashNews,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'phone'   => 'nullable|string|regex:/^[0-9]+$/|max:15',
            'subject' => 'nullable|string|max:100',
            'message' => 'required|string|max:500',
        ]);

        Contact::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'status'  => 'true',
                'message' => 'Your message has been sent successfully!'
            ]);
        }

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
