<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>Admin Login</title>

    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/png" href="{{river_settings('favicon')}}" />
    <link rel="stylesheet" type="text/css" href="/river/admin/bower_components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/river/admin/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="/river/admin/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="/river/admin/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/river/admin/assets/css/pages.css">
</head>

<body themebg-pattern="theme1">

<section class="login-block">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form class="md-float-material form-material" action="{{ route('river.admin.login.post') }}" method="POST">
                    @csrf
                    <div class="text-center">
                        <img src="{{river_settings('header_logo')}}" alt="logo.png" width="180" height="80">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center txt-primary">Sign In</h3>
                                </div>
                            </div>
                            <div class="row m-b-20">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                @if (Session::has('error'))
                                    <p class="alert alert-danger text-center" style="width: 100%">{{ Session::get('error') }}</p>
                                @endif
                            </div>
                            <div class="form-group form-primary">
                                <input class="form-control" type="email" name="email" required >
                                <span class="form-bar"></span>
                                <label class="float-label">Email</label>
                            </div>
                            <div class="form-group form-primary">
                                <input type="password" class="form-control" name="password" required>
                                <span class="form-bar"></span>
                                <label class="float-label">Password</label>
                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-12">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" value="">
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Remember me</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="/river/admin/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="/river/admin/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/river/admin/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="/river/admin/bower_components/bootstrap/js/bootstrap.min.js"></script>
<script src="/river/admin/assets/pages/waves/js/waves.min.js"></script>
<script type="text/javascript" src="/river/admin/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="/river/admin/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="/river/admin/bower_components/modernizr/js/css-scrollbars.js"></script>
<script type="text/javascript" src="/river/admin/assets/js/common-pages.js"></script>
</body>
</html>
