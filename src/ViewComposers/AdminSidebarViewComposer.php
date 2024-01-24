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
                    ],
                    [
                        'label' => 'Social Links',
                        'route' => 'river.store-social-links'
                    ],
                    [
                        'label' => 'Email settings',
                        'route' => 'river.store-email-setting'
                    ],
                    [
                        'label' => "Backup",
                        'route' => 'river.site-backup'
                    ],
                    [
                        'label' => 'Code snippets',
                        'route' => 'river.code-snippets'
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
                    ],
                    [
                        'label' => 'Assets',
                        'route' => 'river.template-assets.index',
                    ],
                    [
                        'label' => 'Global Css',
                        'route' => 'river.template-assets.index',
                    ],
                    [
                        'label' => 'Global Js',
                        'route' => 'river.template-assets.index',
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
            // [
            //     'label' => 'User Role',
            //     'icon' => 'fas fa-user', //feather icon-box
            //     'route' => 'river.users-role.index',
            // ],
            [
                'label' => 'Pages',
                'icon' => 'fas fa-folder',
                'route' => 'river.pages.index',
            ],
            [
                'label' => 'Contact Form',
                'icon' => 'fas fa-file-contract',
                'route' => 'river.contact-form.index',
            ],
            // [
            //     'label' => 'Visit Site',
            //     'icon' => 'fas fa-eye',
            //     'route' => 'riversite.homepage',
            // ],
            [
                'label' => 'Newsletter Submissions',
                'icon' =>  'fa-solid fa-envelope',
                'route' => 'river.newslatter-submissions.index'
            ],
            [
                'label' => 'FAQ',
                'icon' => 'fas fa-comments',
                'route' => 'river.faq.index'
            ],
            [
                'label' => 'Menu',
                'icon' => 'fas fa-bars',
                'route' => 'river.menu.index'
            ],
            [
                'label' => 'Blogs',
                'icon' => 'fas fa-th-large',
                'children' => [
                    [
                        'label' => ' All blogs',
                        'route' => 'river.blog.index',
                    ],
                    [
                        'label' => 'Categories',
                        'route' => 'river.blog-category.index',
                    ],
                    [
                        'label' => 'Tag',
                        'route' => 'river.tag.index'
                    ]
                ]
            ],
            [
                'label' => 'Testimonial',
                'icon' => 'fa-solid fa-comment-dots',
                'route' => 'river.testimonial.index'
            ],
            [
                'label' => 'Service',
                'icon' => 'fas fa-headset',
                'children' => [
                    [
                        'label' => 'All Services',
                        'route' => 'river.service.index'
                    ],
                    [
                        'label' => 'Service Category',
                        'route' => 'river.service-category.index'
                    ]
                ]
            ],
            [
                'label' => 'Configuration',
                'icon' => 'fa-solid fa-comment-dots',
                'route' => 'river.configuration'
            ],
            [
                'label' => 'File manager',
                'icon' => 'fa-solid fa-file-lines',
                'route' => 'river.file-manager'
            ],
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
