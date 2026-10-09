<?php

namespace App\Http\Controllers;

use App\Models\NoticesCirculars;
use Illuminate\Http\Request;

class NoticesCircularsController extends Controller
{
    public function common(Request $request)
    {
        $segments = $request->segments();
        $lastSegment = end($segments);
        $item = NoticesCirculars::where('slug', $lastSegment)->firstOrFail();

        return view('frontend.notices-circulars', compact('item'));
    }
}
