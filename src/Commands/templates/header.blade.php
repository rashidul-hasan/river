<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope-fill"></i><a href="mailto:{{river_settings('email')}}">{{river_settings('email')}}</a>
            <i class="bi bi-phone-fill phone-icon"></i> {{river_settings('phone')}}
        </div>
        <div class="social-links d-none d-md-block">
            <a href="{{river_settings('twitter')}}" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="{{river_settings('facebook')}}" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="{{river_settings('Instagram')}}" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="{{river_settings('LinkedIn')}}" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
        </div>
    </div>
</section>

<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="{{url('/')}}">
                <img src="{{river_settings('header_logo')}}" alt="">
            </a>
        </h1>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto " href="{{url('/')}}">Home</a></li>
                @php
                    $pages = \Rashidul\River\Models\RiverPage::where('is_published', 1)->get();
                @endphp
                @foreach($pages as $item)
                    <li><a class="nav-link scrollto" href="{{route('riversite.page.show', $item->slug)}}">{{$item->menu_title }}</a></li>
                @endforeach
                <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">Drop Down 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li>


                @guest('customers')
                    <li><a class="getstarted scrollto" href="{{route('riversite.login')}}">Login/Register</a></li>
                @else
                    <li><a class="getstarted scrollto" href="{{route('riversite.customer.dashboard')}}">Dashboard</a></li>
                @endguest
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>

