@php
    use App\Business\MenuBusiness;
    $menus = MenuBusiness::getRoleMenu(Auth::user()->role_id);
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a class="brand-link d-flex align-items-center" href="/">
        <i class="brand-image img-circle elevation-3">🍬</i>
        <span class="brand-text font-weight-light">candy store</span>
    </a>

    <div class="sidebar">
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column " data-widget="treeview" role="menu"
                data-accordion="false">

                @foreach ($menus as $menu)
                    @if ($menu['check'])
                        <li class="nav-item">
                            <div class="nav-link">
                                <i class="{{$menu['icon']}}"></i>
                                <p>
                                    {{$menu['name']}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </div>
                            <ul class="nav nav-treeview">
                                @foreach ($menu['submenu'] as $submenu)
                                    @if ($submenu['check'])
                                        <li class="nav-item">
                                            <a href="/admin{{$submenu['link']}}" class="nav-link">
                                                <i class="{{$submenu['icon']}}"></i>
                                                <p>{{$submenu['name']}}</p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>

</aside>