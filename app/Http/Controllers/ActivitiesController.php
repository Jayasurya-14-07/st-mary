<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function common(Request $request)
    {
        $segments = $request->segments();
        $lastSegment = end($segments);
        $item = Activities::where('slug', $lastSegment)->firstOrFail();

        return view('frontend.activities', compact('item'));
    }
}
