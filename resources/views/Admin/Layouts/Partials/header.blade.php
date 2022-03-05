<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-dark bg-gradient-x-primary navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left">
                    <a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs">
                        <i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item"><a href="{{route('dashboard')}}" class="navbar-brand">
                        <img alt="stack admin logo"
                             src="{{asset('assets/admin/')}}/app-assets/images/logo/stack-logo-light.png"
                             class="brand-logo">
                        <h2 class="brand-text">Saloodo! </h2></a></li>
                <li class="nav-item hidden-md-up float-xs-right">
                    <a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container">
                        <i class="fa fa-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                <ul class="nav navbar-nav">
                    <li class="nav-item hidden-sm-down">
                        <a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs">
                            <i class="ft-menu"></i></a></li>
                </ul>
                @if(\Illuminate\Support\Facades\Auth::check())
                <ul class="nav navbar-nav float-xs-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link">
                            <span class="avatar avatar-online">
                                <img
                                    src="{{asset('assets/admin/')}}/app-assets/images/portrait/small/avatar-s-1.png"
                                    alt="avatar">
                                <i></i></span><span class="user-name">{{Auth::user()->name}}</span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{route('logout')}}" class="dropdown-item"><i class="ft-power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
</nav>
