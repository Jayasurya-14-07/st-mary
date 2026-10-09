<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function common(Request $request)
    {
        $segments = $request->segments();
        $lastSegment = end($segments);
        $item = Events::where('slug', $lastSegment)->firstOrFail();

        return view('frontend.events', compact('item'));
    }
}
