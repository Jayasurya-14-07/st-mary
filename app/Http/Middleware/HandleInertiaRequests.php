<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $dbMenus = \App\Helpers\Common::getMenus();
        $menus = \App\Helpers\Common::formatMenusForInertia($dbMenus);
        $notices = \App\Models\FlashNews::active()->latest('publish_date')->orderBy('id', 'desc')->get();

        return [
            ...parent::share($request),
            'siteTitle'     => __('panel.site_title'),
            'siteTitleFull' => __('panel.site_title_full'),
            'menus'         => $menus,
            'notices'       => $notices,
            'flashNews'     => $notices,
        ];
    }
}
