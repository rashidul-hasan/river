<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{\Request::route()->getName() == 'admin.dashboard' ? 'active' : ''}}">
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
            </ul>
            {{--<div class="pcoded-navigation-label">Product Management</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded-hasmenu @yield('products')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-box"></i>
                        </span>
                        <span class="pcoded-mtext">Products</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{\Request::route()->getName() == 'products.index' || \Request::route()->getName() == 'products.edit' ? 'active' : ''}}">
                            <a href="{{ route('products.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">All Products</span>
                            </a>
                        </li>
                        <li class="{{\Request::route()->getName() == 'products.create' ? 'active' : ''}}">
                            <a href="{{ route('products.create') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Add Product</span>
                            </a>
                        </li>
                        <li class="{{\Request::route()->getName() == 'categories.index' ? 'active' : ''}}">
                            <a href="{{ route('categories.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Category</span>
                            </a>
                        </li>
                        <li class="{{\Request::route()->getName() == 'brands.index' ? 'active' : ''}}">
                            <a href="{{ route('brands.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Brands</span>
                            </a>
                        </li>
                        <li class="{{\Request::route()->getName() == 'reviews.all' ? 'active' : ''}}">
                            <a href="{{ route('reviews.all') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Reviews</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{\Request::route()->getName() == 'admin.orders.index' ? 'active' : ''}}">
                    <a href="{{route('admin.orders.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-cart-plus"></i>
                        </span>
                        <span class="pcoded-mtext">Orders</span>
                    </a>
                </li>
                <li class="{{\Request::route()->getName() == 'customers.index' || \Request::route()->getName() == 'customers.show' ? 'active' : ''}}">
                    <a href="{{route('customers.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                           <i class="fa fa-user"></i>
                        </span>
                        <span class="pcoded-mtext">Customers</span>
                    </a>
                </li>

                <li class="pcoded-hasmenu @yield('question')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span>
                        <span class="pcoded-mtext">Product Questions</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{\Request::route()->getName() == 'all.questions' ? 'active' : ''}}">
                            <a href="{{ route('all.questions') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">All Questions</span>
                            </a>
                        </li>
                        <li class="{{\Request::route()->getName() == 'unanswered.qn' ? 'active' : ''}}">
                            <a href="{{ route('unanswered.qn') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Unanswered Questions</span>
                            </a>
                        </li>
                        <li class="{{\Request::route()->getName() == 'answered.qn' ? 'active' : ''}}">
                            <a href="{{ route('answered.qn') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Answered Questions</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pcoded-hasmenu @yield('pcbuilder')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span>
                        <span class="pcoded-mtext">PC Builder</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{\Request::route()->getName() == 'components.index' ? 'active' : ''}}">
                            <a href="{{ route('components.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Components</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pcoded-hasmenu @yield('pcbuilder')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span>
                        <span class="pcoded-mtext">Offers</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{\Request::route()->getName() == 'flashdeals.index' ? 'active' : ''}}">
                            <a href="{{ route('flashdeals.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Flash Deals</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pcoded-hasmenu @yield('pages')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span>
                        <span class="pcoded-mtext">Pages</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{\Request::route()->getName() == 'pages.index' || \Request::route()->getName() == 'pages.edit' ? 'active' : ''}}">
                            <a href="{{ route('pages.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">All Pages</span>
                            </a>
                        </li>
                        <li class="{{\Request::route()->getName() == 'menus.index' ? 'active' : ''}}">
                            <a href="{{ route('menus.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Footer Menus</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pcoded-hasmenu @yield('website_setup')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                           <i class="fas fa-tv"></i>
                        </span>
                        <i class="fa fa-television"></i>
                        <span class="pcoded-mtext">Website Setup</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{\Request::route()->getName() == 'sliders.index' || \Request::route()->getName() == 'sliders.edit' ? 'active' : ''}}">
                            <a href="{{ route('sliders.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Sliders</span>
                            </a>
                        </li>
                        <li class="{{\Request::route()->getName() == 'banners.index' || \Request::route()->getName() == 'banners.edit' ? 'active' : ''}}">
                            <a href="{{ route('banners.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Banners</span>
                            </a>
                        </li>
                        <li class="{{\Request::route()->getName() == 'store.front' ? 'active' : ''}}">
                            <a href="{{ route('store.front') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Appearance</span>
                            </a>
                        </li>
<!--                        <li class="{{\Request::route()->getName() == 'payment.index' ? 'active' : ''}}">
                            <a href="{{ route('payment.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Payment Method</span>
                            </a>
                        </li>-->
                    </ul>
                </li>

                <li class="pcoded-hasmenu @yield('setup_configurations')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                          <i class="fas fa-cog"></i>
                        </span>
                        <i class="fa fa-television"></i>
                        <span class="pcoded-mtext">Setup & Configs</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{\Request::route()->getName() == 'shipping.method' ? 'active' : ''}}">
                            <a href="{{ route('shipping.method') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Shipping Method</span>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>--}}
        </div>
    </div>
</nav>

{{--<nav id="sidebar" class="sidebar">--}}
{{--    <div class="sidebar-content js-simplebar">--}}
{{--        <a class="sidebar-brand" href="">--}}
{{--            <span class="align-middle">{{config('app.name')}}-Admin</span>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--</nav>--}}
{{--<div class="vertical-menu">--}}
{{--    <div data-simplebar class="h-100">--}}
{{--        <!--- Sidemenu -->--}}
{{--        <div id="sidebar-menu">--}}
{{--            <!-- Left Menu Start -->--}}
{{--            <ul class="metismenu list-unstyled" id="side-menu">--}}
{{--                <li class="menu-title">Menu</li>--}}
{{--                <li>--}}
{{--                    <a href="{{ route('admin.dashboard') }}" class="waves-effect @yield('dashboard')">--}}
{{--                        <i class="ri-home-line "></i>--}}
{{--                        <span>Dashboard</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="{{ route('admin.orders.index') }}" class=" waves-effect @yield('orders')">--}}
{{--                        <i class="ri-shopping-cart-line "></i>--}}
{{--                        <span>Orders</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="@yield('products-menu')">--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect @yield('products')">--}}
{{--                        <i class="ri-store-2-line"></i>--}}
{{--                        <span>Products</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu @yield('show')" aria-expanded="false">--}}
{{--                        <li class="@yield('all-products')"><a href="{{ route('products.index') }}">All Products</a></li>--}}
{{--                        <li class="@yield('add-products')"><a href="{{ route('products.create') }}">Add Product</a></li>--}}
{{--                        <li class="@yield('all-cat')"><a href="{{ route('categories.index') }}">Categories</a></li>--}}
{{--                        <li class="@yield('all-brands')"><a href="{{ route('brands.index') }}">Brands</a></li>--}}
{{--                        <li class="@yield('all-brands')"><a href="{{ route('reviews.all') }}">Product Reviews</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="@yield('marketing')">--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect @yield('products')">--}}
{{--                        <i class="mdi mdi-bullhorn"></i>--}}
{{--                        <span>Marketing</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu @yield('show')" aria-expanded="false">--}}
{{--                        <li class="@yield('all-flashdel')"><a href="{{route('flashdeals.index')}}">Flash Deals</a></li>--}}
{{--                        <li class="@yield('all-flashdel')"><a href="{{route('campaigns.index')}}">Campaigns</a></li>--}}
{{--                        <li class="@yield('coupons')"><a href="{{ route('coupons.index') }}"><span>Coupons</span></a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="@yield('blogs')">--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect @yield('products')">--}}
{{--                        <i class="ri-store-2-line"></i>--}}
{{--                        <span>Blog System</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu @yield('show')" aria-expanded="false">--}}
{{--                        <li class="@yield('allblog')"><a href="{{ route('blogs.index') }}">All Posts</a></li>--}}
{{--                        <li class="@yield('blogCat')"><a href="{{ route('blogscategories.index') }}">Categories</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="{{ route('customers.index') }}" class="waves-effect @yield('cus')">--}}
{{--                        <i class="ri-user-line"></i>--}}
{{--                        <span>Customers</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="@yield('pages-menu')">--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect @yield('products')">--}}
{{--                        <i class="ri-store-2-line"></i>--}}
{{--                        <span>Pages</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu @yield('show')" aria-expanded="false">--}}
{{--                        <li class="@yield('all-pages')"><a href="{{ route('pages.index') }}">All Pages</a></li>--}}
{{--                        <li class="@yield('all-cat')"><a href="{{ route('faqs.index') }}">FAQs</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}


{{--                <li class="menu-title">System</li>--}}

{{--                <li class="@yield('Appearance')">--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect @yield('all-Appearance')">--}}
{{--                        <i class="ri-brush-fill "></i>--}}
{{--                        <span>Website Settings</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu @yield('show')" aria-expanded="false">--}}
{{--                        <li><a href="{{ route('sliders.index') }}" class="waves-effect @yield('sliders')">Sliders</a></li>--}}
{{--                        <li><a href="{{ route('banners.index') }}" class="waves-effect @yield('banners')">Banners</a></li>--}}
{{--                        <li><a href="{{ route('store.front') }}" class="waves-effect @yield('storefront')">Front End</a></li>--}}
{{--                        <li><a href="{{ route('payment.index') }}" class="waves-effect @yield('paymentMethod')">Payment Method</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="{{ route('settings.index') }}" class="waves-effect @yield('settings')">--}}
{{--                        <i class="ri-settings-3-line"></i>--}}
{{--                        <span>Settings</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="{{ route('backup.index') }}" class="waves-effect @yield('backup')">--}}
{{--                        <i class="ri-database-2-line "></i>--}}
{{--                        <span>Backup</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
