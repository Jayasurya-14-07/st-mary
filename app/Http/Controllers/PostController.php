<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function common(Request $request)
    {
        $segments = $request->segments();

        // Get the last segment of the URL
        $lastSegment = end($segments);

        $post = Posts::with('categories')->where('slug', $lastSegment)->first();

        if (!$post) {
            abort(404);
        }

        return Inertia::render('Post', [
            'post' => $post,
        ]);
    }
}