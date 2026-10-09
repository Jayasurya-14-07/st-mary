<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\PhotoGallery;
use App\Models\Pages;
use App\Models\Posts;
use App\Models\Sliders;
use App\Models\VideoGallery;
use App\Models\UpcomingEvents;
use App\Models\FlashNews;
use App\Models\LivesOfSaint;
use App\Models\SalesianSpeak;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {

        $latestGalleries = PhotoGallery::where('status', 1)
            ->orderBy('publish_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $galleryImages = collect();
        foreach ($latestGalleries as $gallery) {
            // Get images and concat them
            $galleryImages = $galleryImages->concat($gallery->images()->get());
        }
        $galleryImages = $galleryImages->take(9);

        $totalGalleries = PhotoGallery::count();

        $aboutus = Pages::where('slug', 'about-us')->where('status', 1)->first();

        if ($aboutus) {
            if (!empty($aboutus->excerpt)) {
                $aboutus->excerpt = strip_tags($aboutus->excerpt);
            }
            $aboutus->link_url = $aboutus->slug_url ?? url($aboutus->slug);
        }

        $flashNews = FlashNews::active()->latest('publish_date')->orderBy('id', 'desc')->get();

        $sliders = Sliders::where('status', 1)
            ->orderBy('order_by', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $sliderImages = [];
        foreach ($sliders as $slider) {
            if (!empty($slider->image)) {
                $images = is_array($slider->image) ? $slider->image : json_decode($slider->image, true);
                if (is_array($images)) {
                    foreach ($images as $img) {
                        if ($img) {
                            $sliderImages[] = [
                                'url'   => str_starts_with($img, 'http') ? $img : asset('storage/' . $img),
                                'title' => $slider->title ?? '',
                            ];
                        }
                    }
                } elseif (is_string($slider->image) && !empty($slider->image)) {
                    $sliderImages[] = [
                        'url'   => str_starts_with($slider->image, 'http') ? $slider->image : asset('storage/' . $slider->image),
                        'title' => $slider->title ?? '',
                    ];
                }
            }
        }

        $facilites = Category::where('slug', 'facilities-infrastructure')->first();
        $facilites = $facilites ? $facilites->posts()->where('status', 1)->orderBy('publish_date', 'desc')->orderBy('id', 'desc')->get() : collect();

         $testimoinals = Category::where('slug', 'comments-testimonials')->first();
        $testimoinals = $testimoinals ? $testimoinals->posts()->where('status', 1)->orderBy('publish_date', 'desc')->orderBy('id', 'desc')->get() : collect();



        $dbVideos = VideoGallery::latest()->get();
        $formattedDbVideos = [];

        foreach ($dbVideos as $dbVideo) {
            $vId = $this->extractYoutubeVideoId($dbVideo->link);
            if ($vId) {
                $formattedDbVideos[] = [
                    'id' => ['videoId' => $vId],
                    'snippet' => [
                        'title' => $dbVideo->title,
                        'description' => '',
                        'thumbnails' => [
                            'high' => ['url' => "https://img.youtube.com/vi/{$vId}/hqdefault.jpg"],
                            'medium' => ['url' => "https://img.youtube.com/vi/{$vId}/mqdefault.jpg"],
                        ]
                    ]
                ];
            }
        }

        // Fetch YouTube Videos for Gallery Section
        $apiKey = env('YOUTUBE_API_KEY');
        $channelId = env('YOUTUBE_CHANNEL_ID');
        $videos = []; // Default fallback

        try {
            $response = Http::withoutVerifying()->get('https://www.googleapis.com/youtube/v3/search', [
                'key' => $apiKey,
                'channelId' => $channelId,
                'part' => 'snippet',
                'order' => 'date',
                'maxResults' => 6,
                'type' => 'video',
            ]);

            if ($response->successful()) {
                $json = $response->json();
                if (isset($json['items'])) {
                    $videos = $json['items'];
                } else {
                    Log::warning('YouTube API returned no items', $json);
                }
            } else {
                Log::error('YouTube API response error: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('YouTube API exception: ' . $e->getMessage());
        }

        // Merge DB videos at the beginning
        $videos = array_merge($formattedDbVideos, $videos);

        $newsCategory = Category::where('slug', 'news-events')->first();
        $newsEvents = collect();

        if ($newsCategory) {
            $newsEvents = $newsCategory->posts()
                ->with(['tag', 'categories'])
                ->where('status', 1)
                ->latest('publish_date')
                ->orderBy('id', 'desc')
                ->get();
        }

        if ($newsEvents->isEmpty()) {
            $newsEvents = Posts::with(['tag', 'categories'])
                ->where('status', 1)
                ->latest('publish_date')
                ->orderBy('id', 'desc')
                ->take(12)
                ->get();
        }

        $formattedNewsEvents = $newsEvents->map(function ($post) {
            return [
                'id'            => $post->id,
                'title'         => $post->title,
                'slug'          => $post->slug,
                'excerpt'       => !empty($post->excerpt) ? strip_tags($post->excerpt) : '',
                'feature_image' => !empty($post->feature_image) ? (str_starts_with($post->feature_image, 'http') ? $post->feature_image : asset('storage/' . $post->feature_image)) : null,
                'tag_name'      => $post->tag ? $post->tag->name : ($post->category_names ?: 'NEWS & EVENTS'),
                'publish_date'  => $post->publish_date ? \Carbon\Carbon::parse($post->publish_date)->format('d M') : \Carbon\Carbon::parse($post->created_at)->format('d M'),
                'full_date'     => $post->publish_date ? \Carbon\Carbon::parse($post->publish_date)->format('d F Y') : \Carbon\Carbon::parse($post->created_at)->format('d F Y'),
            ];
        });

        return Inertia::render('Home', [
            'aboutus'        => $aboutus,
            'testimoinals'   => $testimoinals,
            'facilites'      => $facilites,
            'galleryImages'  => $galleryImages,
            'totalGalleries' => $totalGalleries,
            'latestGalleries'=> $latestGalleries,
            'sliders'        => $sliders,
            'sliderImages'   => $sliderImages,
            'videos'         => $videos,
            'notices'        => $flashNews,
            'flashNews'      => $flashNews,
            'newsEvents'     => $formattedNewsEvents,
        ]);
    }

    private function extractYoutubeVideoId($url)
    {
        // Ensure $url is a string, extract first element if it's an array
        if (is_array($url)) {
            $first = collect($url)->first();
            $url = is_array($first) ? ($first['url'] ?? '') : (is_string($first) ? $first : '');
        }

        // Ensure it's a valid string before applying regex
        if (!is_string($url) || empty($url)) {
            return null;
        }

        // Apply regex to extract YouTube Video ID
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $url, $matches);

        return $matches[1] ?? null;
    }



    private function convertToEmbedUrl($url)
    {
        // Ensure it is a valid string
        if (!is_string($url) || empty($url)) {
            return '';
        }

        // Check for short URL (youtu.be)
        if (strpos($url, 'youtu.be') !== false) {
            $videoId = substr(parse_url($url, PHP_URL_PATH), 1);
            return "https://www.youtube.com/embed/$videoId";
        }

        // Check for standard YouTube URL (watch?v=)
        if (strpos($url, 'youtube.com/watch') !== false) {
            parse_str(parse_url($url, PHP_URL_QUERY), $queryParams);
            return isset($queryParams['v']) ? "https://www.youtube.com/embed/{$queryParams['v']}" : $url;
        }

        // Return original URL if no match (fallback)
        return $url;
    }

    public function gallery()
    {
        $galleries = PhotoGallery::with('images')
            ->where('status', 1)
            ->orderBy('publish_date', 'desc')
            ->get();

        return Inertia::render('Gallery', [
            'galleries' => $galleries,
        ]);
    }


    public function showYearGallery($year)
    {
        // Extract starting year if format is 2024-25 or similar
        $startYear = (int) explode('-', $year)[0];
        $startDate = $startYear . '-06-01';
        $endDate = ($startYear + 1) . '-05-31';

        $galleries = PhotoGallery::with('images')
            ->where('status', 1)
            ->whereBetween('publish_date', [$startDate, $endDate])
            ->get()
            ->sortByDesc('publish_date');

        $galleriesWithRandomImage = [];

        foreach ($galleries as $gallery) {
            $images = $gallery->images()->get();
            $imagesCount = $images->count();

            if ($images->isNotEmpty()) {
                $randomImage = $images->random();

                $galleriesWithRandomImage[] = [
                    'id' => $gallery->id,
                    'title' => $gallery->title,
                    'slug' => $gallery->slug,
                    'media' => $randomImage,
                    'images_count' => $imagesCount
                ];
            } else {
                $galleriesWithRandomImage[] = [
                    'id' => $gallery->id,
                    'title' => $gallery->title,
                    'slug' => $gallery->slug,
                    'media' => null,
                    'images_count' => 0
                ];
            }
        }

        return view('frontend.pages.yearGallery', compact('galleriesWithRandomImage', 'year'));
    }

    public function showGallery($slug)
    {
        $galleryItem = PhotoGallery::with('images')
            ->where('slug', $slug)
            ->firstOrFail();

        $galleryImages = $galleryItem->images()->get();

        // Calculate Academic Year for breadcrumbs
        $date = \Carbon\Carbon::parse($galleryItem->publish_date);
        $y = $date->month >= 6 ? $date->year : $date->year - 1;
        $academicYear = $y . '-' . substr($y + 1, -2);

        return view('frontend.pages.singleGallery', compact('galleryItem', 'galleryImages', 'academicYear'));
    }


    public function videoGallery()
    {
        $apiKey = env('YOUTUBE_API_KEY');
        $channelId = env('YOUTUBE_CHANNEL_ID');
        $uploadsPlaylistId = str_replace('UC', 'UU', $channelId);

        // Try to get from cache first
        $videos = Cache::get('youtube_videos');

        if (!$videos) {
            try {
                // Use playlistItems instead of search (costs 1 quota unit instead of 100)
                $response = Http::withoutVerifying()->get('https://www.googleapis.com/youtube/v3/playlistItems', [
                    'key' => $apiKey,
                    'playlistId' => $uploadsPlaylistId,
                    'part' => 'snippet',
                    'maxResults' => 6,
                ]);

                if ($response->successful()) {
                    $json = $response->json();
                    if (isset($json['items'])) {
                        $videos = $json['items'];
                        // Only cache if we got actual items
                        Cache::put('youtube_videos', $videos, now()->addHours(12));
                    } else {
                        Log::warning('YouTube API returned no items', $json);
                        $videos = null;
                    }
                } else {
                    Log::error('YouTube API response error: ' . $response->body());
                    $videos = null;
                }
            } catch (\Exception $e) {
                Log::error('YouTube API exception: ' . $e->getMessage());
                $videos = null;
            }
        }

        return view('frontend.pages.videoGallery', compact('videos'));
    }


    public function allfacilities()
    {
        $facilities = Category::where('slug', 'facilities-infrastructure')->first();
        $facilities = $facilities
            ? $facilities->posts()->where('status', 1)->orderBy('publish_date', 'desc')->orderBy('id', 'desc')->paginate(5)
            : collect();

        return view('frontend.pages.allfacilities', compact('facilities'));
    }

    public function newsEvents()
    {
        $newsCategory = Category::where('slug', 'news-events')->first();
        $newsEvents = collect();

        if ($newsCategory) {
            $newsEvents = $newsCategory->posts()
                ->with(['tag', 'categories'])
                ->where('status', 1)
                ->latest('publish_date')
                ->orderBy('id', 'desc')
                ->get();
        }

        if ($newsEvents->isEmpty()) {
            $newsEvents = Posts::with(['tag', 'categories'])
                ->where('status', 1)
                ->latest('publish_date')
                ->orderBy('id', 'desc')
                ->get();
        }

        $tags = \App\Models\Tag::orderBy('name', 'asc')->get();

        $formattedNewsEvents = $newsEvents->map(function ($post) {
            return [
                'id'            => $post->id,
                'title'         => $post->title,
                'slug'          => $post->slug,
                'excerpt'       => !empty($post->excerpt) ? strip_tags($post->excerpt) : '',
                'feature_image' => !empty($post->feature_image) ? (str_starts_with($post->feature_image, 'http') ? $post->feature_image : asset('storage/' . $post->feature_image)) : '/images/news/news1.jpg',
                'tag_name'      => $post->tag ? $post->tag->name : ($post->category_names ?: 'News & Events'),
                'tag_id'        => $post->tag_id,
                'publish_date'  => $post->publish_date ? \Carbon\Carbon::parse($post->publish_date)->format('d M') : \Carbon\Carbon::parse($post->created_at)->format('d M'),
                'full_date'     => $post->publish_date ? \Carbon\Carbon::parse($post->publish_date)->format('d F Y') : \Carbon\Carbon::parse($post->created_at)->format('d F Y'),
            ];
        });

        return Inertia::render('NewsEvents', [
            'newsEvents' => $formattedNewsEvents,
            'tags'       => $tags,
        ]);
    }
}
