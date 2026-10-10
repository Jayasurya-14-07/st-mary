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
        $latestGalleries = PhotoGallery::with('images')
            ->where('status', 1)
            ->orderBy('publish_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $formattedHomeGalleries = $latestGalleries->map(function ($gallery) {
            $images = $gallery->images()->get();
            $coverImage = $images->isNotEmpty() ? $images->random() : null;
            $coverUrl = null;
            if ($coverImage) {
                $coverUrl = !empty($coverImage->url) ? $coverImage->url : (!empty($coverImage->path) ? (str_starts_with($coverImage->path, 'http') ? $coverImage->path : asset('storage/' . ltrim($coverImage->path, '/'))) : null);
            }

            return [
                'id'           => $gallery->id,
                'title'        => $gallery->title,
                'slug'         => $gallery->slug,
                'cover_url'    => $coverUrl,
                'images_count' => $images->count(),
            ];
        });

        $galleryImages = collect();
        foreach ($latestGalleries as $gallery) {
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

        $facilitySettings = \App\Models\FacilitySetting::first();
        $formattedFacilityImages = [];
        if ($facilitySettings && !empty($facilitySettings->images)) {
            $formattedFacilityImages = array_values(array_map(function($img) {
                if (empty($img)) return null;
                return (str_starts_with($img, 'http') || str_starts_with($img, '/')) ? $img : asset('storage/' . $img);
            }, is_array($facilitySettings->images) ? $facilitySettings->images : json_decode($facilitySettings->images, true) ?? []));
        }
        if (count($formattedFacilityImages) < 4) {
            $formattedFacilityImages = [
                '/images/facilities/facilities1.jpg',
                '/images/facilities/facilities2.jpg',
                '/images/facilities/facilities3.jpg',
                '/images/facilities/facilities4.jpg',
            ];
        }

        $facilitiesSection = [
            'kicker'  => $facilitySettings->kicker ?? 'Facilities',
            'title'   => $facilitySettings->title ?? 'Facilities for Learning and Growth.',
            'excerpt' => $facilitySettings->excerpt ?? 'St. Mary’s Convent School provides a safe, welcoming, and child-friendly learning environment with facilities that support the academic, physical, creative, and overall development of our students. The school continually strives to provide the resources and opportunities needed to make learning meaningful, engaging, and enjoyable.',
            'images'  => $formattedFacilityImages,
        ];

        $belowSliderFacilities = \App\Models\Facility::where('status', 1)
            ->where('show_below_slider', 1)
            ->orderBy('order_by', 'asc')
            ->get()
            ->map(function ($f) {
                return [
                    'id'    => $f->id,
                    'title' => $f->title,
                    'slug'  => $f->slug,
                    'link'  => '/facilities#' . $f->slug,
                ];
            });

        $testimoinals = Category::where('slug', 'comments-testimonials')->first();
        $testimoinals = $testimoinals ? $testimoinals->posts()->where('status', 1)->orderBy('publish_date', 'desc')->orderBy('id', 'desc')->get() : collect();

        $dbVideos = VideoGallery::where('status', 1)
            ->orderBy('order_by', 'asc')
            ->orderBy('publish_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $formattedDbVideos = [];
        foreach ($dbVideos as $dbVideo) {
            $vId = $this->extractYoutubeVideoId($dbVideo->link);
            if ($vId) {
                $formattedDbVideos[] = [
                    'id'        => $dbVideo->id,
                    'title'     => $dbVideo->title,
                    'videoId'   => $vId,
                    'embedUrl'  => "https://www.youtube.com/embed/{$vId}",
                    'thumbnail' => "https://img.youtube.com/vi/{$vId}/hqdefault.jpg",
                ];
            }
        }

        $newsCategoryIds = Category::whereIn('slug', ['news-events', 'news', 'events'])->pluck('id');
        $newsEvents = Posts::where(function ($query) use ($newsCategoryIds) {
            $query->whereHas('categories', function ($q) use ($newsCategoryIds) {
                $q->whereIn('categories.id', $newsCategoryIds);
            })->orWhereIn('category_id', $newsCategoryIds);
        })
        ->with(['tag', 'categories'])
        ->where('status', 1)
        ->orderByRaw('COALESCE(publish_date, created_at) DESC')
        ->orderBy('id', 'desc')
        ->take(10)
        ->get();

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

        $clubsCategory = Category::where('slug', 'our-clubs')->first();
        $ourClubs = collect();

        if ($clubsCategory) {
            $ourClubs = $clubsCategory->posts()
                ->where('status', 1)
                ->orderBy('order_by', 'asc')
                ->orderBy('created_at', 'asc')
                ->orderBy('id', 'asc')
                ->get();
        }

        $formattedClubs = $ourClubs->map(function ($post) {
            $themeIconMap = [
                'card-art'      => 'fa-palette',
                'card-eco'      => 'fa-seedling',
                'card-science'  => 'fa-flask',
                'card-heritage' => 'fa-landmark',
                'card-language' => 'fa-comments',
                'card-math'     => 'fa-square-root-variable',
                'card-sports'   => 'fa-trophy',
                'card-value'    => 'fa-hand-holding-heart',
            ];

            $theme = $post->club_theme ?: 'card-art';
            $iconName = $theme ? str_replace('card-', 'icon-', $theme) : 'icon-art';
            $faIcon = $post->fa_icon ?: ($themeIconMap[$theme] ?? 'fa-palette');

            return [
                'id'      => $post->id,
                'title'   => $post->title,
                'slug'    => $post->slug,
                'excerpt' => !empty($post->excerpt) ? strip_tags($post->excerpt) : '',
                'card'    => $theme,
                'icon'    => $iconName,
                'fa'      => $faIcon,
            ];
        });

        if ($formattedClubs->isEmpty()) {
            $formattedClubs = collect($this->getDefaultClubs());
        }

        $dbLeadership = \App\Models\LeadershipMessage::where('status', 1)
            ->orderBy('order_by', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $formattedLeadership = $dbLeadership->map(function ($msg) {
            return [
                'id'            => $msg->id,
                'name'          => $msg->name,
                'slug'          => $msg->slug,
                'position'      => $msg->position,
                'subtext'       => $msg->subtext,
                'icon'          => $msg->icon ?: 'fa-user-tie',
                'feature_image' => !empty($msg->feature_image) ? (str_starts_with($msg->feature_image, 'http') ? $msg->feature_image : asset('storage/' . $msg->feature_image)) : null,
                'excerpt'       => $msg->excerpt,
                'content'       => $msg->content,
            ];
        });

        if ($formattedLeadership->isEmpty()) {
            $formattedLeadership = collect($this->getDefaultLeadershipMessages());
        }

        $extractExcerptOrContent = function ($item) {
            if (!$item) return null;
            if (!empty($item->excerpt)) {
                return $item->excerpt;
            }
            if (!empty($item->content)) {
                if (is_string($item->content)) {
                    return $item->content;
                }
                if (is_array($item->content)) {
                    $parts = [];
                    foreach ($item->content as $block) {
                        if (!empty($block['data']['content']) && is_string($block['data']['content'])) {
                            $parts[] = $block['data']['content'];
                        }
                    }
                    if (!empty($parts)) {
                        return implode('', $parts);
                    }
                }
            }
            return null;
        };

        // 1. Mission: Category 'mission' post first, fallback to Pages 'mission'
        $missionCat = Category::where('slug', 'mission')->first();
        $missionPost = $missionCat
            ? $missionCat->posts()
                ->where('status', 1)
                ->orderBy('order_by', 'asc')
                ->latest('publish_date')
                ->orderBy('id', 'desc')
                ->first()
            : null;

        $missionSource = $missionPost ?: Pages::where('slug', 'mission')->where('status', 1)->first();

        $formattedMission = $missionSource ? [
            'title'    => $missionSource->title,
            'slug'     => $missionSource->slug,
            'subtitle' => $missionSource->author,
            'excerpt'  => $extractExcerptOrContent($missionSource),
        ] : null;

        // 2. Vision: Category 'vision' post first, fallback to Pages 'vision'
        $visionCat = Category::where('slug', 'vision')->first();
        $visionPost = $visionCat
            ? $visionCat->posts()
                ->where('status', 1)
                ->orderBy('order_by', 'asc')
                ->latest('publish_date')
                ->orderBy('id', 'desc')
                ->first()
            : null;

        $visionSource = $visionPost ?: Pages::where('slug', 'vision')->where('status', 1)->first();

        $formattedVision = $visionSource ? [
            'title'    => $visionSource->title,
            'slug'     => $visionSource->slug,
            'subtitle' => $visionSource->author,
            'excerpt'  => $extractExcerptOrContent($visionSource),
        ] : null;

        // 3. Mission Focus: Category 'mission-focus' post first, fallback to Pages 'mission-focus'
        $focusCat = Category::where('slug', 'mission-focus')->first();
        $focusPost = $focusCat
            ? $focusCat->posts()
                ->where('status', 1)
                ->orderBy('order_by', 'asc')
                ->latest('publish_date')
                ->orderBy('id', 'desc')
                ->first()
            : null;

        $focusSource = $focusPost ?: Pages::where('slug', 'mission-focus')->where('status', 1)->first();

        $formattedMissionFocus = $focusSource ? [
            'title'    => $focusSource->title,
            'slug'     => $focusSource->slug,
            'subtitle' => $focusSource->author,
            'excerpt'  => $extractExcerptOrContent($focusSource),
        ] : null;

        return Inertia::render('Home', [
            'aboutus'            => $aboutus,
            'vision'             => $formattedVision,
            'mission'            => $formattedMission,
            'missionFocus'       => $formattedMissionFocus,
            'testimoinals'       => $testimoinals,
            'facilites'             => $facilitiesSection,
            'facilitiesSection'     => $facilitiesSection,
            'belowSliderFacilities' => $belowSliderFacilities,
            'galleryImages'      => $galleryImages,
            'totalGalleries'     => $totalGalleries,
            'latestGalleries'    => $latestGalleries,
            'homeGalleries'      => $formattedHomeGalleries,
            'sliders'            => $sliders,
            'sliderImages'       => $sliderImages,
            'videos'             => array_slice($formattedDbVideos, 0, 8),
            'notices'            => $flashNews,
            'flashNews'          => $flashNews,
            'newsEvents'         => $formattedNewsEvents,
            'ourClubs'           => $formattedClubs,
            'leadershipMessages' => $formattedLeadership,
        ]);
    }

    private function extractYoutubeVideoId($url)
    {
        if (is_array($url)) {
            $first = collect($url)->first();
            $url = is_array($first) ? ($first['url'] ?? '') : (is_string($first) ? $first : '');
        }

        if (!is_string($url) || empty($url)) {
            return null;
        }

        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $url, $matches);

        return $matches[1] ?? null;
    }

    public function gallery()
    {
        $galleries = PhotoGallery::with('images')
            ->where('status', 1)
            ->orderBy('publish_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $groupedByAcademicYear = [];

        foreach ($galleries as $gallery) {
            $date = \Carbon\Carbon::parse($gallery->publish_date ?: $gallery->created_at);
            $startYear = $date->month >= 4 ? $date->year : $date->year - 1;
            $endYear = $startYear + 1;
            $yearKey = $startYear . '-' . $endYear;
            $yearLabel = "Academic Year " . $startYear . " - " . $endYear;

            $images = $gallery->images()->get();
            $coverImage = $images->isNotEmpty() ? $images->random() : null;
            $coverUrl = null;
            if ($coverImage) {
                $coverUrl = !empty($coverImage->url) ? $coverImage->url : (!empty($coverImage->path) ? (str_starts_with($coverImage->path, 'http') ? $coverImage->path : asset('storage/' . ltrim($coverImage->path, '/'))) : null);
            }

            if (!isset($groupedByAcademicYear[$yearKey])) {
                $groupedByAcademicYear[$yearKey] = [
                    'year_label' => $yearLabel,
                    'year_key'   => $yearKey,
                    'start_year' => $startYear,
                    'albums'     => [],
                ];
            }

            $groupedByAcademicYear[$yearKey]['albums'][] = [
                'id'           => $gallery->id,
                'title'        => $gallery->title,
                'slug'         => $gallery->slug,
                'description'  => $gallery->description,
                'cover_url'    => $coverUrl,
                'images_count' => $images->count(),
                'publish_date' => $gallery->publish_date,
            ];
        }

        krsort($groupedByAcademicYear);

        return Inertia::render('Gallery', [
            'academicYearGalleries' => array_values($groupedByAcademicYear),
        ]);
    }

    public function showGallery($slug)
    {
        $galleryItem = PhotoGallery::with('images')
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $images = $galleryItem->images()->get()->map(function ($img) {
            $url = !empty($img->url) ? $img->url : (!empty($img->path) ? (str_starts_with($img->path, 'http') ? $img->path : asset('storage/' . ltrim($img->path, '/'))) : null);
            return [
                'id'    => $img->id,
                'title' => $img->name ?: $img->title ?: 'Gallery Photo',
                'url'   => $url,
            ];
        })->filter(fn($img) => !empty($img['url']))->values();

        $date = \Carbon\Carbon::parse($galleryItem->publish_date ?: $galleryItem->created_at);
        $startYear = $date->month >= 4 ? $date->year : $date->year - 1;
        $academicYear = "Academic Year " . $startYear . " - " . ($startYear + 1);

        return Inertia::render('SingleGallery', [
            'gallery'      => [
                'id'          => $galleryItem->id,
                'title'       => $galleryItem->title,
                'slug'        => $galleryItem->slug,
                'description' => $galleryItem->description,
            ],
            'images'       => $images,
            'academicYear' => $academicYear,
        ]);
    }

    public function videoGallery()
    {
        $videos = VideoGallery::where('status', 1)
            ->orderBy('publish_date', 'desc')
            ->orderBy('order_by', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $groupedByAcademicYear = [];

        foreach ($videos as $video) {
            $date = \Carbon\Carbon::parse($video->publish_date ?: $video->created_at);
            $startYear = $date->month >= 4 ? $date->year : $date->year - 1;
            $endYear = $startYear + 1;
            $yearKey = $startYear . '-' . $endYear;
            $yearLabel = "Academic Year " . $startYear . " - " . $endYear;

            $vId = $this->extractYoutubeVideoId($video->link);
            $thumbUrl = $vId ? "https://img.youtube.com/vi/{$vId}/hqdefault.jpg" : null;

            if (!isset($groupedByAcademicYear[$yearKey])) {
                $groupedByAcademicYear[$yearKey] = [
                    'year_label'  => $yearLabel,
                    'year_key'    => $yearKey,
                    'start_year'  => $startYear,
                    'cover_url'   => $thumbUrl,
                    'video_count' => 0,
                ];
            }

            $groupedByAcademicYear[$yearKey]['video_count']++;
            if (empty($groupedByAcademicYear[$yearKey]['cover_url']) && $thumbUrl) {
                $groupedByAcademicYear[$yearKey]['cover_url'] = $thumbUrl;
            }
        }

        krsort($groupedByAcademicYear);

        return Inertia::render('VideoGallery', [
            'academicYearVideos' => array_values($groupedByAcademicYear),
        ]);
    }

    public function videoGalleryYear($yearKey)
    {
        $parts = explode('-', $yearKey);
        $startYear = isset($parts[0]) ? (int)$parts[0] : (int)date('Y');
        $endYear = isset($parts[1]) ? (int)$parts[1] : $startYear + 1;

        $startDate = Carbon::createFromDate($startYear, 4, 1)->startOfDay();
        $endDate = Carbon::createFromDate($endYear, 3, 31)->endOfDay();

        $yearLabel = "Academic Year " . $startYear . " - " . $endYear;

        $paginated = VideoGallery::where('status', 1)
            ->whereBetween('publish_date', [$startDate, $endDate])
            ->orderBy('order_by', 'asc')
            ->orderBy('publish_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(12);

        $paginated->getCollection()->transform(function ($video) {
            $vId = $this->extractYoutubeVideoId($video->link);
            return [
                'id'           => $video->id,
                'title'        => $video->title,
                'videoId'      => $vId,
                'embedUrl'     => $vId ? "https://www.youtube.com/embed/{$vId}" : null,
                'thumbnail'    => $vId ? "https://img.youtube.com/vi/{$vId}/hqdefault.jpg" : null,
                'publish_date' => $video->publish_date ? \Carbon\Carbon::parse($video->publish_date)->format('d M Y') : null,
            ];
        });

        return Inertia::render('YearVideoGallery', [
            'yearLabel' => $yearLabel,
            'yearKey'   => $yearKey,
            'videos'    => $paginated,
        ]);
    }

    public function allfacilities()
    {
        $facilitySettings = \App\Models\FacilitySetting::first();
        $facilities = \App\Models\Facility::where('status', 1)
            ->orderBy('order_by', 'asc')
            ->get()
            ->map(function ($f) {
                return [
                    'id'            => $f->id,
                    'title'         => $f->title,
                    'slug'          => $f->slug,
                    'excerpt'       => $f->excerpt,
                    'content'       => $f->content,
                    'feature_image' => !empty($f->feature_image) ? (str_starts_with($f->feature_image, 'http') || str_starts_with($f->feature_image, '/') ? $f->feature_image : asset('storage/' . $f->feature_image)) : null,
                ];
            });

        $facilitiesSection = [
            'kicker'  => $facilitySettings->kicker ?? 'Facilities',
            'title'   => $facilitySettings->title ?? 'Facilities for Learning and Growth.',
            'excerpt' => $facilitySettings->excerpt ?? '',
        ];

        return Inertia::render('Facilities', [
            'facilities'        => $facilities,
            'facilitiesSection' => $facilitiesSection,
        ]);
    }

    public function facilityDetail($slug)
    {
        $facility = \App\Models\Facility::where('slug', $slug)->where('status', 1)->first();

        if (!$facility) {
            return redirect('/facilities');
        }

        return redirect('/facilities#' . $slug);
    }

    public function newsEvents()
    {
        $newsCategoryIds = Category::whereIn('slug', ['news-events', 'news', 'events'])->pluck('id');
        $newsEvents = Posts::where(function ($query) use ($newsCategoryIds) {
            $query->whereHas('categories', function ($q) use ($newsCategoryIds) {
                $q->whereIn('categories.id', $newsCategoryIds);
            })->orWhereIn('category_id', $newsCategoryIds);
        })
        ->with(['tag', 'categories'])
        ->where('status', 1)
        ->orderByRaw('COALESCE(publish_date, created_at) DESC')
        ->orderBy('id', 'desc')
        ->get();

        $tagIdsInNews = $newsEvents->pluck('tag_id')->filter()->unique();
        $tags = $tagIdsInNews->isNotEmpty()
            ? \App\Models\Tag::whereIn('id', $tagIdsInNews)->orderBy('name', 'asc')->get()
            : collect();

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

    public function ourClubs()
    {
        $clubsCategory = Category::where('slug', 'our-clubs')->first();
        $ourClubs = collect();

        if ($clubsCategory) {
            $ourClubs = $clubsCategory->posts()
                ->where('status', 1)
                ->orderBy('order_by', 'asc')
                ->orderBy('created_at', 'asc')
                ->orderBy('id', 'asc')
                ->get();
        }

        $themeIconMap = [
            'card-art'      => 'fa-palette',
            'card-eco'      => 'fa-seedling',
            'card-science'  => 'fa-flask',
            'card-heritage' => 'fa-landmark',
            'card-language' => 'fa-comments',
            'card-math'     => 'fa-square-root-variable',
            'card-sports'   => 'fa-trophy',
            'card-value'    => 'fa-hand-holding-heart',
        ];

        $formattedClubs = $ourClubs->map(function ($post) use ($themeIconMap) {
            $theme = $post->club_theme ?: 'card-art';
            $iconName = $theme ? str_replace('card-', 'icon-', $theme) : 'icon-art';
            $faIcon = $post->fa_icon ?: ($themeIconMap[$theme] ?? 'fa-palette');

            return [
                'id'            => $post->id,
                'title'         => $post->title,
                'slug'          => $post->slug,
                'excerpt'       => !empty($post->excerpt) ? strip_tags($post->excerpt) : '',
                'feature_image' => !empty($post->feature_image) ? (str_starts_with($post->feature_image, 'http') ? $post->feature_image : asset('storage/' . $post->feature_image)) : null,
                'card'          => $theme,
                'icon'          => $iconName,
                'fa'            => $faIcon,
            ];
        });

        if ($formattedClubs->isEmpty()) {
            $formattedClubs = collect($this->getDefaultClubs());
        }

        return Inertia::render('OurClubs', [
            'ourClubs' => $formattedClubs,
        ]);
    }

    private function getDefaultClubs()
    {
        return [
            ['card' => 'card-art', 'icon' => 'icon-art', 'fa' => 'fa-palette', 'title' => 'Art Club', 'excerpt' => 'Encourages imagination, creativity, and artistic expression through painting, sketching, and crafts.'],
            ['card' => 'card-eco', 'icon' => 'icon-eco', 'fa' => 'fa-seedling', 'title' => 'Eco Club', 'excerpt' => 'Promotes environmental awareness, sustainability, and responsible citizenship.'],
            ['card' => 'card-science', 'icon' => 'icon-science', 'fa' => 'fa-flask', 'title' => 'EVS & Science Club', 'excerpt' => 'Develops scientific curiosity through exploration, interactive experiments, and innovation.'],
            ['card' => 'card-heritage', 'icon' => 'icon-heritage', 'fa' => 'fa-landmark', 'title' => 'Heritage Club', 'excerpt' => 'Creates awareness and deep appreciation of our rich cultural heritage and traditions.'],
            ['card' => 'card-language', 'icon' => 'icon-language', 'fa' => 'fa-comments', 'title' => 'Language Club', 'excerpt' => 'Strengthens communication, vocabulary, reading, debate, and speaking skills.'],
            ['card' => 'card-math', 'icon' => 'icon-math', 'fa' => 'fa-square-root-variable', 'title' => 'Math Club', 'excerpt' => 'Makes mathematics engaging through logical thinking, puzzles, and activity-based learning.'],
            ['card' => 'card-sports', 'icon' => 'icon-sports', 'fa' => 'fa-trophy', 'title' => 'Sports Club', 'excerpt' => 'Promotes fitness, teamwork, discipline, leadership, and athletic sportsmanship.'],
            ['card' => 'card-value', 'icon' => 'icon-value', 'fa' => 'fa-hand-holding-heart', 'title' => 'Value Education Club', 'excerpt' => 'Nurtures moral character, empathy, respect, responsibility, and moral values.'],
        ];
    }

    public function leadershipMessageDetail($slug)
    {
        $message = \App\Models\LeadershipMessage::where('slug', $slug)->where('status', 1)->first();

        if (!$message) {
            $defaults = collect($this->getDefaultLeadershipMessages());
            $fallback = $defaults->firstWhere('slug', $slug);
            if ($fallback) {
                $message = (object) [
                    'id'            => 0,
                    'name'          => $fallback['name'],
                    'slug'          => $fallback['slug'],
                    'position'      => $fallback['position'],
                    'subtext'       => $fallback['subtext'],
                    'icon'          => $fallback['icon'],
                    'feature_image' => $fallback['feature_image'],
                    'excerpt'       => $fallback['excerpt'],
                    'content'       => null,
                ];
            } else {
                abort(404);
            }
        } else {
            if (!empty($message->feature_image)) {
                $message->feature_image = str_starts_with($message->feature_image, 'http') ? $message->feature_image : asset('storage/' . $message->feature_image);
            }
        }

        return Inertia::render('LeadershipMessageDetail', [
            'message' => $message,
        ]);
    }

    private function getDefaultLeadershipMessages()
    {
        return [
            [
                'id'            => 1,
                'slug'          => 'principal-message',
                'position'      => 'Principal',
                'name'          => 'Sr. Joy Maria DM',
                'icon'          => 'fa-user-tie',
                'feature_image' => '/images/principal.jpg',
                'subtext'       => 'St. Mary’s Convent School, Chhallan Ramkot',
                'excerpt'       => '<p className="message-text">“Education is not merely the acquisition of knowledge; it is the formation of character, the awakening of potential, and the preparation for a meaningful life.”</p><p className="message-text">It gives me immense joy to welcome you to the official website of St. Mary’s Convent School, Chhallan Ramkot.</p><p className="message-text">Established in 2002, our school has grown with a clear vision of providing quality education rooted in values, discipline, compassion, and excellence. Over the years, St. Mary’s has become not merely a place of learning, but a nurturing home where young minds are guided to discover their talents, develop their confidence, and grow into responsible and caring individuals.</p>',
            ],
            [
                'id'            => 2,
                'slug'          => 'management-message',
                'position'      => 'Management',
                'name'          => 'Management Message',
                'icon'          => 'fa-building-columns',
                'feature_image' => '/images/logo.png',
                'subtext'       => 'Diocese of Jammu-Srinagar Education Society (DJSES)',
                'excerpt'       => '<p className="message-text">“Our goal is to nurture intellectual curiosity, moral integrity, and leadership qualities in our students, preparing them to be compassionate global citizens.”</p><p className="message-text">The Management of St. Mary’s Convent School remains committed to upholding holistic education that balances academic vigor with strong moral values, discipline, and community service.</p><p className="message-text">Under the auspices of the Diocese of Jammu-Srinagar Education Society (DJSES), we continue to modernize facilities and foster an environment where every child feels valued, inspired, and empowered to excel.</p>',
            ],
            [
                'id'            => 3,
                'slug'          => 'head-boy-message',
                'position'      => 'Head Boy',
                'name'          => 'Utkarsh Singh',
                'icon'          => 'fa-user-graduate',
                'feature_image' => '/images/head-boy.jpg',
                'subtext'       => 'Student Leadership Council',
                'excerpt'       => '<p className="message-text">My journey at St. Mary’s Convent School began in Nursery, when I was a quiet and hesitant little child, taking my first steps into the world of learning. Little did I know that this school would become so much more than a place of education. It would become a second home—a place where I would discover my strengths, overcome my fears, build lasting friendships, and gradually find my confidence.</p><p className="message-text">Over the years, I have grown alongside my school, both academically and personally. Every experience, whether a joyful achievement or a challenging moment, has taught me valuable lessons in patience, discipline, responsibility, and maturity.</p>',
            ],
            [
                'id'            => 4,
                'slug'          => 'head-girl-message',
                'position'      => 'Head Girl',
                'name'          => 'Rimsha Verma',
                'icon'          => 'fa-graduation-cap',
                'feature_image' => '/images/head-girl.jpg',
                'subtext'       => 'Student Leadership Council',
                'excerpt'       => '<p className="message-text">My journey at St. Mary’s Convent School began in Class I, and today, as I stand in Class X as the Head Girl, I feel incredibly grateful and proud.</p><p className="message-text">These ten years have been filled with learning, growth, friendship, achievements, and unforgettable memories. The school management and my teachers have taught me not only academics but also discipline, confidence, kindness, and responsibility.</p><p className="message-text">This school is the place where I have been encouraged to discover my strengths, learn from my mistakes, face challenges with courage, and always believe in myself.</p>',
            ],
        ];
    }
}
