<!DOCTYPE html>
<html lang="en" data-textdirection="@yield('text_direction', 'ltr')" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="@yield('app_description', 'app description')">
    <meta name="keywords" content="@yield('keywords')">
    <title>@yield('title', @$layoutTitle)</title>
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
          href="{{asset('assets/admin/')}}/app-assets/vendors/css/extensions/toastr.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/css/app.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/css/colors.min.css">


    <!-- date picker css -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/vendors/css/pickers/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/vendors/css/pickers/pickadate/pickadate.css">

    <!-- select css -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/vendors/css/forms/selects/select2.min.css">

    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/css/core/menu/menu-types/vertical-overlay-menu.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/css/plugins/extensions/toastr.min.css">


    <!-- date picker css -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/css/plugins/pickers/daterange/daterange.min.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/')}}/assets/css/style.css">
    <!-- END Custom CSS-->

    <style>
        .bg-gradient-x-primary {
            background-image: linear-gradient(to right, #7b1fa2 0%, #c2185b 100%);
        }

        .main-menu.menu-light .navigation > li.open {
            border-left: 4px solid #c2185b;
        }

        .main-menu.menu-light .navigation > li ul .active > a {
            color: #c2185b;
            font-weight: 500;
        }

        .tag-primary {
            background-color: #c2185b;
        }

        .required {
            color: red;
        }
    </style>
    @yield('styles')
</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns"
      class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar">

<!-- navbar-fixed-top -->
@include('Admin.Layouts.Partials.header')
<!-- sidebar -->
<div data-scroll-to-active="true" class="main-menu menu-fixed menu-light menu-accordion menu-shadow">
    <!-- sidebar header -->
    @section('sidebar_search')
        <div class="main-menu-header">
            <input type="text" placeholder="Search" class="menu-search form-control round"/>
        </div>
@show
<!-- sidebar -->
    <div class="main-menu-content">
        @include('Admin.Layouts.Partials.sidebar')
    </div>
</div>
<!-- / sidebar -->

{{-- breadcrumb --}}
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-1">
                <h3 class="content-header-title">@yield('breadcrumb_header', 'breadcrumb_header')</h3>
            </div>

            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
                <div class="breadcrumb-wrapper col-xs-12">
                    <ol class="breadcrumb">
                        @yield('breadcrumb_content')
                    </ol>
                </div>
            </div>
        </div>

        @include('errors')
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
{{-- /breadcrumb --}}

@include('Admin.Layouts.Partials.footer')


<!-- BEGIN VENDOR JS-->
<script src="{{asset('assets/admin/')}}/app-assets/vendors/js/vendors.min.js"
        type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->


<!-- date picker js -->
<script
    src="{{asset('assets/admin/')}}/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js"
    type="text/javascript"></script>
<script
    src="{{asset('assets/admin/')}}/app-assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js"
    type="text/javascript"></script>
<script src="{{asset('assets/admin/')}}/app-assets/vendors/js/pickers/pickadate/picker.js"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/')}}/app-assets/vendors/js/pickers/pickadate/picker.date.js"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/')}}/app-assets/vendors/js/pickers/pickadate/picker.time.js"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/')}}/app-assets/vendors/js/pickers/daterange/daterangepicker.js"
        type="text/javascript"></script>

<!-- select js -->
<script src="{{asset('assets/admin/')}}/app-assets/vendors/js/forms/select/select2.full.min.js"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/')}}/app-assets/vendors/js/extensions/toastr.min.js"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/')}}/app-assets/js/scripts/extensions/toastr.min.js"
        type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN STACK JS-->
<script src="{{asset('assets/admin/')}}/app-assets/js/core/app-menu.min.js"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/')}}/app-assets/js/core/app.min.js"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/')}}/app-assets/js/scripts/customizer.min.js"
        type="text/javascript"></script>
<!-- END STACK JS-->
<!-- BEGIN PAGE LEVEL JS-->


<!-- date picker js -->
<script
    src="{{asset('assets/admin/')}}/app-assets/js/scripts/pickers/dateTime/picker-date-time.min.js"
    type="text/javascript"></script>

<!-- select js -->
<script src="{{asset('assets/admin/')}}/app-assets/js/scripts/forms/select/form-select2.min.js"
        type="text/javascript"></script>


<!-- END PAGE LEVEL JS-->
@yield('scripts')
<script>
    $(function () {
        $('a[href="{{URL::current()}}"]').parent().addClass('active');
        {{--toastr.success("{{ 'asdas asdjasdas' }}");--}}
        {{--toastr.("{{ 'asdas asdjasdas' }}");--}}
        @if(session()->has('feedback'))
        toastr.{{ session()->get('feedback')['type'] }}("{{ session()->get('feedback')['message'] }}");
        @endif
    })
</script>
</body>
</html>
