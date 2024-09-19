<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto d-flex align-items-center">
        <li class="nav-item">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @php
                        $urlAvatar = asset('images/noAvatar.png');
                        if (Auth::user() && Auth::user()->img) {
                            $urlAvatar = asset('storage/users/' . Auth::user()->img);
                        }
                    @endphp
                    <img id="avatar_header" class="rounded-circle header-profile-user" src="{{ $urlAvatar }}"
                        style="width:2rem; height:2rem" alt="Header Avatar">
                    <span id="user_name_header"
                        class="d-none d-xl-inline-block ml-1">{{ Auth::user() ? Auth::user()->name : '' }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="/profile"><i class="bx bx-user font-size-16 align-middle mr-1"></i>
                        Profile</a>
                    <button class="dropdown-item text-danger" onclick="logout()"><i
                            class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</button>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>

</nav>