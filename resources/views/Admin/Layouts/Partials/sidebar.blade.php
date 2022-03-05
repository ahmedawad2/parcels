<ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
    @if(\Illuminate\Support\Facades\Auth::check())
        <li class="nav-item"><a href="{{route('dashboard')}}">
                <i class="ft-home"></i><span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if(\App\Models\User::isSender(\Illuminate\Support\Facades\Auth::user()))
            <li class="nav-item"><a href="javascripts::void(0);">
                    <i class="ft-target"></i><span
                        class="menu-title">Parcels</span>
                </a>
                <ul class="menu-content">

                    <li class="">
                        <a href="{{route('sender.parcels.index')}}"
                           class="menu-item">Index</a>
                    </li>
                    <li class="">
                        <a href="{{route('sender.parcels.create')}}"
                           class="menu-item">Create</a>
                    </li>
                </ul>
            </li>

        @elseif(\App\Models\User::isBiker(\Illuminate\Support\Facades\Auth::user()))
            <li class="nav-item"><a href="{{route('biker.parcels.index')}}">
                    <i class="ft-target"></i><span class="menu-title">Parcels</span>
                </a>
            </li>
        @endif

        @if(\App\Models\User::isBiker(\Illuminate\Support\Facades\Auth::user()))
            <li class="nav-item"><a href="{{route('biker.orders.index')}}">
                    <i class="ft-home"></i><span class="menu-title">Orders</span>
                </a>
            </li>
        @endif
    @endif
</ul>
