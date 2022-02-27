<?php

namespace Rashidul\River\ViewComposers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AdminSidebarViewComposer
{

    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param \App\Repositories\UserRepository $users
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $menus = [
            [
                'label' => 'Dashboard',
                'route' => 'river.admin.dashboard',
                'icon' => 'feather icon-home'
            ],
            [
                'label' => 'Website Settings',
                'icon' => 'fas fa-tv',
                'children' => [
                    [
                        'label' => 'Sliders',
                        'route' => 'river.sliders.index',
                    ],
                    [
                        'label' => 'Banners',
                        'route' => 'river.banners.index',
                    ],
                    [
                        'label' => 'Appearance',
                        'route' => 'river.store.front',
                    ]
                ]
            ],
            [
                'label' => 'Template manager',
                'icon' => 'fas fa-tv',
                'children' => [
                    /*[
                        'label' => 'Pages',
                        'route' => 'river.templates.pages',
                    ],*/
                    [
                        'label' => 'Pages',
                        'route' => 'river.template-pages.index',
                    ]
                ]
            ],
        ];
        $view->with('menus', $menus);
    }
}
