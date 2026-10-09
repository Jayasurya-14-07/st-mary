<?php

namespace App\Http\Controllers;

use App\Helpers\Common as Helper;
use App\Models\Category;
use App\Models\Menus;
use App\Models\Pages;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function common(Request $request)
    {
        $segments = $request->segments();
        
        $lastSegment = end($segments);

        $page = Pages::with('menu.parent.parent.parent.parent')->find($request->route('page_id'));

        if (!$page) {
            $page = Pages::with('menu.parent.parent.parent.parent')
                ->where('slug', $lastSegment)
                ->first();
        }
       
        if (!$page) {
            abort(404);
        }

        // Get menu details
        $menu = $page->menu;
        
        // Breadcrumbs array
        $breadcrumbs = [];

        // Fetch parent menus recursively.
        while ($menu && $menu->parent) {
            $menu = $menu->parent;

            $breadcrumbs[] = [
                'name' => $menu->name,
                'url' => ($path = Helper::getMenuUrlPath($menu)) ? url($path) : '#',
            ];
        }

        // Reverse to get correct order (parent first)
        $breadcrumbs = array_reverse($breadcrumbs);
       
        // Add the current page at the end
        $currentPath = $page->menu ? Helper::getMenuUrlPath($page->menu) : null;

        $breadcrumbs[] = [
            'name' => $page->title,
            'url' => $currentPath ? url($currentPath) : url($page->slug),
        ];

        // Randomize the page banner
        $bannerDirectory = public_path('frontend/assets/images/page-banner');
        $randomBanner = '/frontend/assets/images/slider-1.jpg'; // fallback default
        
        if (\Illuminate\Support\Facades\File::exists($bannerDirectory)) {
            $files = \Illuminate\Support\Facades\File::files($bannerDirectory);
            if (!empty($files)) {
                $randomFile = $files[array_rand($files)];
                $randomBanner = '/frontend/assets/images/page-banner/' . $randomFile->getFilename();
            }
        }

        return view('frontend.page', compact('page', 'breadcrumbs', 'randomBanner'));
    }
}
