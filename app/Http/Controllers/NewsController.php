<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function common(Request $request)
    {
        $segments = $request->segments();
        $lastSegment = end($segments);
        $item = News::where('slug', $lastSegment)->firstOrFail();

        return view('frontend.news', compact('item'));
    }
}
