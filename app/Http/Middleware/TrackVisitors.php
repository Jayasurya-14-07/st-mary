<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TrackVisitors
{
    public function handle(Request $request, Closure $next)
    {
        $key = 'visitor_count';

        // Set the initial count to 10000 if not already set
        if (!Cache::has($key)) {
            Cache::forever($key, 10000);
        }

        // Increment the visitor count
        Cache::increment($key);

        return $next($request);
    }
}