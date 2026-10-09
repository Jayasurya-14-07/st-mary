<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function common(Request $request)
    {
        $segments = $request->segments();
        $lastSegment = end($segments);
        $item = Testimonial::where('slug', $lastSegment)->firstOrFail();

        return view('frontend.testimonial', compact('item'));
    }
}
