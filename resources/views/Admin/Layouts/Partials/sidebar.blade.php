<ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">

    <li class="nav-item"><a href="{{route('dashboard')}}">
            <i class="ft-home"></i><span class="menu-title">Dashboard</span>
        </a>
    </li>

    <li class="nav-item"><a href="javascripts::void(0);">
            <i class="ft-target"></i><span
                class="menu-title">Parcels</span>
        </a>
        <ul class="menu-content">
            <li class="">
                <a href="{{route('parcels.index')}}"
                   class="menu-item">Index</a>
            </li>
            <li class="">
                <a href="{{route('parcels.create')}}"
                   class="menu-item">Create</a>
            </li>
        </ul>
    </li>

</ul>
