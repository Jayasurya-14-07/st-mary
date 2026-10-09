<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\News;
use App\Models\UpcomingEvents;
use App\Models\Activities;
use App\Models\CampusLife;
use App\Models\Celebration;
use App\Models\Sports;
use App\Models\Events;
use App\Models\NoticesCirculars;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        
        if (empty($query)) {
            return redirect()->back();
        }

        $results = new Collection();

        // Pages
        $pages = Pages::where('title', 'LIKE', "%{$query}%")
            ->orWhere('excerpt', 'LIKE', "%{$query}%")
            ->get();
        foreach ($pages as $item) {
            $results->push([
                'title' => $item->title,
                'url' => url($item->slug),
                'type' => 'Page'
            ]);
        }

        // News
        $news = News::where('title', 'LIKE', "%{$query}%")
            ->orWhere('excerpt', 'LIKE', "%{$query}%")
            ->get();
        foreach ($news as $item) {
            $results->push([
                'title' => $item->title,
                'url' => url('news/' . $item->slug),
                'type' => 'News'
            ]);
        }

        // Activities
        $activities = Activities::where('title', 'LIKE', "%{$query}%")
            ->get();
        foreach ($activities as $item) {
            $results->push([
                'title' => $item->title,
                'url' => url('activities/' . $item->slug),
                'type' => 'Activity'
            ]);
        }

        // Upcoming Events
        $upcomingEvents = UpcomingEvents::where('title', 'LIKE', "%{$query}%")
            ->get();
        foreach ($upcomingEvents as $item) {
            $results->push([
                'title' => $item->title,
                'url' => url('upcoming-events/' . $item->slug),
                'type' => 'Upcoming Event'
            ]);
        }

        // Campus Life
        $campusLife = CampusLife::where('title', 'LIKE', "%{$query}%")
            ->get();
        foreach ($campusLife as $item) {
            $results->push([
                'title' => $item->title,
                'url' => url('campus-life/' . $item->slug),
                'type' => 'Campus Life'
            ]);
        }

        // Celebrations
        $celebrations = Celebration::where('title', 'LIKE', "%{$query}%")
            ->get();
        foreach ($celebrations as $item) {
            $results->push([
                'title' => $item->title,
                'url' => url('celebrations/' . $item->slug),
                'type' => 'Celebration'
            ]);
        }

        // Sports
        $sports = Sports::where('title', 'LIKE', "%{$query}%")
            ->get();
        foreach ($sports as $item) {
            $results->push([
                'title' => $item->title,
                'url' => url('sports/' . $item->slug),
                'type' => 'Sports'
            ]);
        }

        // Events
        $events = Events::where('title', 'LIKE', "%{$query}%")
            ->get();
        foreach ($events as $item) {
            $results->push([
                'title' => $item->title,
                'url' => url('events/' . $item->slug),
                'type' => 'Event'
            ]);
        }

        // Notices & Circulars
        $notices = NoticesCirculars::where('title', 'LIKE', "%{$query}%")
            ->get();
        foreach ($notices as $item) {
            $results->push([
                'title' => $item->title,
                'url' => url('notices-circulars/' . $item->slug),
                'type' => 'Notice'
            ]);
        }

        // Manual Pagination
        $perPage = 10;
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $items = $results->forPage($currentPage, $perPage);
        
        $paginatedResults = new LengthAwarePaginator(
            $items, 
            $results->count(), 
            $perPage, 
            $currentPage, 
            ['path' => Paginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('frontend.search', [
            'results' => $paginatedResults,
            'query' => $query,
            'totalResults' => $results->count()
        ]);
    }
}
