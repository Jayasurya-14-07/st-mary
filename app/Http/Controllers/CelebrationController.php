<?php

namespace App\Http\Controllers;

use App\Models\Celebration;
use Illuminate\Http\Request;

class CelebrationController extends Controller
{
    public function common(Request $request)
    {
        $segments = $request->segments();
        $lastSegment = end($segments);
        $item = Celebration::where('slug', $lastSegment)->firstOrFail();

        return view('frontend.celebration', compact('item'));
    }
}
