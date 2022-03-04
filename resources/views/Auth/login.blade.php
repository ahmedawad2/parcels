<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">

<!-- Mirrored from pixinvent.com/stack-responsive-bootstrap-4-admin-template/html/ltr/vertical-menu-template-nav-dark/login-with-bg-image.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 27 Aug 2017 13:08:33 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Login</title>
    <link rel="apple-touch-icon"
          href="{{asset('assets/admin/')}}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon"
          href="{{asset('assets/admin/')}}/app-assets/images/ico/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/vendors/css/extensions/pace.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/css/app.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/css/colors.min.css">
    <!-- END STACK CSS-->
    <!-- select css -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/vendors/css/forms/selects/select2.min.css">
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/')}}/assets/css/style.css">
    <!-- END Custom CSS-->
</head>
<body data-open="click" data-menu="vertical-menu" data-col="1-column"
      class="vertical-layout vertical-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1 box-shadow-3 p-0">
                    <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                        <div class="card-header no-border">
                            <div class="card-title text-xs-center">
                                <img src="{{asset('assets/admin/')}}/app-assets/images/logo/logo.jpg"
                                     alt="branding logo" width="300px;">
                            </div>
                        </div>
                        <form method="POST" action="{{ route('loginAttempt') }}">
                            @csrf
                            <div class="card-body collapse in">
                                <p class="card-subtitle line-on-side text-muted text-xs-center font-small-3 mx-2 my-1">
                                    <span>Account Details</span></p>
                                <div class="card-block">

                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control" id="user-name"
                                               placeholder="Your Email" required name="email">
                                        <div class="form-control-position">
                                            <i class="ft-user"></i>
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control" id="user-password"
                                               placeholder="Enter Password" name="password" required>
                                        <div class="form-control-position">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>

                                    <fieldset
                                        class="form-group position-relative has-icon-left">
                                        <select class="select2 form-control"
                                                name="type" id="type">
                                            <option value="1">Sender</option>
                                            <option value="2">Biker</option>
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                        @enderror
                                    </fieldset>
                                    <button type="submit" class="btn btn-outline-primary btn-block"><i
                                            class="ft-unlock"></i> Login
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<!-- BEGIN VENDOR JS-->
<script src="{{asset('assets/admin/')}}/app-assets/vendors/js/vendors.min.js"
        type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->

<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('assets/admin/')}}/app-assets/js/scripts/forms/form-login-register.min.js"
        type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->
<!-- select js -->
<script src="{{asset('assets/admin/')}}/app-assets/vendors/js/forms/select/select2.full.min.js"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/')}}/app-assets/js/scripts/forms/select/form-select2.min.js"
        type="text/javascript"></script>
</body>

</html>
