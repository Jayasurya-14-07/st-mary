<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function common(Request $request)
    {
        $segments = $request->segments();

        // Get the last segment of the URL
        $lastSegment = end($segments);

        $post = Posts::where('slug', $lastSegment)->first();

        return view('frontend.post', compact('post'));
    }
}