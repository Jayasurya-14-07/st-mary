<?php

namespace App\Http\Controllers;

use App\Models\Sports;
use Illuminate\Http\Request;

class SportsController extends Controller
{
    public function common(Request $request)
    {
        $segments = $request->segments();
        $lastSegment = end($segments);
        $item = Sports::where('slug', $lastSegment)->firstOrFail();

        return view('frontend.sports', compact('item'));
    }
}
