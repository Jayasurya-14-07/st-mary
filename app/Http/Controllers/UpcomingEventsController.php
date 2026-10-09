<?php

namespace App\Http\Controllers;

use App\Models\UpcomingEvents;
use Illuminate\Http\Request;

class UpcomingEventsController extends Controller
{
    public function common(Request $request)
    {
        $segments = $request->segments();
        $lastSegment = end($segments);
        $item = UpcomingEvents::where('slug', $lastSegment)->firstOrFail();

        return view('frontend.upcoming-events', compact('item'));
    }
}
