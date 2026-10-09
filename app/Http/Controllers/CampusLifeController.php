<?php

namespace App\Http\Controllers;

use App\Models\CampusLife;
use Illuminate\Http\Request;

class CampusLifeController extends Controller
{
    public function common(Request $request)
    {
        $segments = $request->segments();
        $lastSegment = end($segments);
        $item = CampusLife::where('slug', $lastSegment)->firstOrFail();

        return view('frontend.campus-life', compact('item'));
    }
}
