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
            @if(\Illuminate\Support\Facades\Auth::user()->type === 1)
                <li class="">
                    <a href="{{route('sender.parcels.index')}}"
                       class="menu-item">Index</a>
                </li>
                <li class="">
                    <a href="{{route('sender.parcels.create')}}"
                       class="menu-item">Create</a>
                </li>
            @elseif(\Illuminate\Support\Facades\Auth::user()->type === 2)
                <li class="">
                    <a href="{{route('biker.parcels.index')}}"
                       class="menu-item">Index</a>
                </li>
            @endif
        </ul>
    </li>

    @if(\Illuminate\Support\Facades\Auth::user()->type === 2)
        <li class="nav-item"><a href="{{route('biker.orders.index')}}">
                <i class="ft-home"></i><span class="menu-title">Orders</span>
            </a>
        </li>
    @endif

</ul>
