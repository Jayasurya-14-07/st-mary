<?php

namespace App\Http\Composers;

use App\Models\Category;
use Illuminate\View\View;

class FlashNewsComposer
{
    public function compose(View $view)
    {
        $flashNewsCategory = Category::where('slug', 'flash-news')->first();
        $flashNews = $flashNewsCategory ? $flashNewsCategory->posts()->orderBy('created_at', 'desc')->get() : collect();
       
        $view->with('flashNews', $flashNews);
    }
}