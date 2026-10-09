<?php

namespace App\Http\Controllers;

use App\Models\LivesOfSaint;
use Illuminate\Http\Request;

class LivesOfSaintController extends Controller
{
    public function common(Request $request)
    {
        $segments = $request->segments();
        $lastSegment = end($segments);
        $item = LivesOfSaint::where('slug', $lastSegment)->firstOrFail();

        return view('frontend.lives-of-saint', compact('item'));
    }
}
