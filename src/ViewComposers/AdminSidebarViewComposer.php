<?php

namespace Rashidul\River\ViewComposers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Rashidul\River\Constants;
use Rashidul\River\Models\DataType;
use Rashidul\River\Utility\RolesCache;

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
        $datatypes = $this->getDataTypeMenus();

        $menus[] = [
            'label' => 'Dashboard',
            'route' => 'river.admin.dashboard',
            'icon' => 'feather icon-home'
        ];

        if (count($datatypes)) {
            $menus = array_merge($menus, $datatypes);
        }

        $system_menus = [
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
            [
                'label' => 'Data Types',
                'icon' => 'fas fa-tv', //feather icon-box
                'children' => [
                    [
                        'label' => 'All types',
                        'route' => 'river.datatypes.index',
                    ]
                ]
            ],
            [
                'label' => 'Users',
                'icon' => 'fas fa-user', //feather icon-box
                'route' => 'river.users.index',
            ],
            [
                'label' => 'User Role',
                'icon' => 'fas fa-user', //feather icon-box
                'route' => 'river.users-role.index',
            ]
        ];
        if (RolesCache::isDeveloper()) {
            $menus = array_merge($menus, $system_menus);
        }

        $view->with('menus', $menus);
    }

    private function getDataTypeMenus()
    {
        $types = Cache::rememberForever(Constants::CACHE_KEY_DATATYPES, function () {
            return DataType::all();
        });

        $menu = [];
        foreach ($types as $type) {
            if ($type->show_on_menu) {
                $m = [
                    'label' => $type->plural,
                    'children' => [
                        [
                            'label' => 'All ' . $type->plural,
                            'url' => route('river.data-entries.index', $type->slug),
                        ],
                        [
                            'label' => 'Add ' . $type->singular,
                            'url' => route('river.data-entries.create', $type->slug),
                        ]
                    ],
                ];
                if ($type->icon) {
                    $m['icon'] = $type->icon;
                }
                $menu[] = $m;
            }
        }


        return $menu;
    }
}
