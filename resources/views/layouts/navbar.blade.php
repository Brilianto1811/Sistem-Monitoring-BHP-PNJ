<!--header-->
<header class="top-header">
    <nav class="navbar navbar-expand">
        <div class="left-topbar d-flex align-items-center">
            <a href="javascript:;" class="toggle-btn"> <i class="bx bx-menu"></i>
            </a>
        </div>
        <div class="flex-grow-1 search-bar">
            <h4>@yield('title')</h4>
        </div>
        @php
            $nama_user = 'siapa?';
            $nim_user = '';
            if(auth()->guard('karyawan')->check()) {
                $nama_user = auth()->guard('karyawan')->user()->nama_user;
            }
            if(auth()->guard('mahasiswa')->check()) {
                $nama_user = auth()->guard('mahasiswa')->user()->nama_mahasiswa;
                $nim_user = auth()->guard('mahasiswa')->user()->nim;
            }
        @endphp
        <div class="right-topbar ms-auto">
            <ul class="navbar-nav">
                <li class="nav-item search-btn-mobile">
                    {{ $nim_user }}
                </li>
                <li class="nav-item dropdown dropdown-user-profile">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                        data-bs-toggle="dropdown">
                        <div class="d-flex user-box align-items-center">
                            <div class="user-info">
                                <p class="user-name mb-0">{{ $nim_user }} {{ $nama_user }}</p>
                                <p class="designattion mb-0"><small class="bx bxs-circle me-1 chart-online"></small>Online</p>
                            </div>
                            <div class="chat-user-online">
                                <img src="/assets/images/icons/user.png" class="user-img rounded-circle" alt="user avatar">
                            </div>
                        </div>
                    </a>
                    @php
                        $level = (auth()->guard('karyawan')->check())? auth()->guard('karyawan')->user()->level : null;
                        $status = (auth()->guard('karyawan')->check())? auth()->guard('karyawan')->user()->status_user : null;
                    @endphp
                    <div class="dropdown-menu dropdown-menu-end">
                        @if (in_array($level, ['operator', 'admin']))
                        <a class="dropdown-item" href="{{ route('karyawan.profil') }}"><i class="bx bx-user"></i><span>Profil</span></a>
                        @else
                        <a class="dropdown-item" href="{{ route('mahasiswa.profil') }}"><i class="bx bx-user"></i><span>Profile</span></a>
                        @endif

                        <div class="dropdown-divider mb-0"></div>

                        @if (in_array($level, ['operator', 'admin']))
                        <a class="dropdown-item" href="{{ route('karyawan.proses-logout') }}"><i
                                class="bx bx-log-out"></i><span>Logout Admin/Operator</span></a>
                        @else
                        <a class="dropdown-item" href="{{ route('mahasiswa.proses-logout') }}"><i
                                class="bx bx-log-out"></i><span>Logout Mahasiswa</span></a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!--end header-->
