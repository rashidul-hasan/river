<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <ul class="pcoded-item pcoded-left-item">
                @foreach($menus as $menu)
                <li class="{{array_key_exists('children', $menu) ? 'pcoded-hasmenu' : ''}}">
                    <a href="{{array_key_exists('route', $menu) ? route($menu['route']) : 'javascript:void(0)'}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="{{array_key_exists('icon', $menu) ? $menu['icon'] : 'feather icon-box'}}"></i>
                        </span>
                        <span class="pcoded-mtext">{{$menu['label']}}</span>
                    </a>
                    @if(array_key_exists('children', $menu))
                        <ul class="pcoded-submenu">
                            @foreach($menu['children'] as $child)
                            <li class="submenu-li" data-active-routes="river.sliders.index|river.sliders.edit">
                                <a href="{{ array_key_exists('route', $child) ? route($child['route']) : $child['url'] }}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">{{$child['label']}}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
                @endforeach

                {{--<li class="pcoded-hasmenu @yield('website_setup')">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                           <i class="fas fa-tv"></i>
                        </span>
                        <i class="fa fa-television"></i>
                        <span class="pcoded-mtext">Website Setup</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="submenu-li" data-active-routes="river.sliders.index|river.sliders.edit">
                            <a href="{{ route('river.sliders.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Sliders</span>
                            </a>
                        </li>
                        --}}{{--<li class="{{\Request::route()->getName() == 'banners.index' || \Request::route()->getName() == 'banners.edit' ? 'active' : ''}}">
                            <a href="{{ route('banners.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Banners</span>
                            </a>
                        </li>--}}{{--
                        <li class="submenu-li" data-active-routes="store.front">
                            <a href="{{ route('river.store.front') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Appearance</span>
                            </a>
                        </li>
                    </ul>
                </li>--}}

            </ul>
        </div>
    </div>
</nav>
