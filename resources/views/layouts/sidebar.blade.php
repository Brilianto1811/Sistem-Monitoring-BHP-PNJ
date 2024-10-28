<!--sidebar-wrapper-->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="">
            <img src="/assets/images/logo-pnj.png" class="logo-icon-2" alt="" />
        </div>
        <div>
            <h4 class="logo-text">BHP</h4>
        </div>
        <a href="javascript:;" class="toggle-btn ms-auto"> <i class="bx bx-menu"></i>
        </a>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @php
            $level = (auth()->guard('karyawan')->check())? auth()->guard('karyawan')->user()->level : null;
            $status = (auth()->guard('karyawan')->check())? auth()->guard('karyawan')->user()->status_user : null;
        @endphp
        @if (in_array($level, ['operator', 'admin']))
        <li class="menu-label">Utama</li>
        <li>
            <a href="{{ route('karyawan.dashboard') }}">
                <div class="parent-icon icon-color-2"><i class="bx bx-home"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label">Master</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-4"><i class="bx bx-buildings"></i>
                </div>
                <div class="menu-title">Master Lokasi</div>
            </a>
            <ul>
                <li> <a href="{{ route('master.gedung.index') }}"><i class="bx bx-chevron-right"></i>Gedung</a>
                </li>
                <li> <a href="{{ route('master.gudang.index') }}"><i class="bx bx-chevron-right"></i>Gudang</a>
                </li>
                <li> <a href="{{ route('master.blok.index') }}"><i class="bx bx-chevron-right"></i>Blok</a>
                </li>
                <li> <a href="{{ route('master.lokasi.index') }}"><i class="bx bx-chevron-right"></i>Lokasi</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-4"> <i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Master Mahasiswa</div>
            </a>
            <ul>
                <li> <a href="{{ route('master.jurusan.index') }}"><i class="bx bx-chevron-right"></i>Jurusan</a>
                </li>
                <li> <a href="{{ route('master.prodi.index') }}"><i class="bx bx-chevron-right"></i>Program Studi</a>
                </li>
                <li> <a href="{{ route('master.kelas.index') }}"><i class="bx bx-chevron-right"></i>Kelas</a>
                </li>
                <li> <a href="{{ route('master.mahasiswa.index') }}"><i class="bx bx-chevron-right"></i>Mahasiswa</a>
                </li>
            </ul>
        </li>
        @if ($level == 'admin')
        <li>
            <a href="{{ route('master.userprofile.index') }}">
                <div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Master Profil Pengguna (Admin/Operator)</div>
            </a>
        </li>
        @endif
        <li>
            <a href="{{ route('master.barang.index') }}">
                <div class="parent-icon icon-color-4"><i class="bx bx-package"></i>
                </div>
                <div class="menu-title">Master Bahan</div>
            </a>
        </li>
        <li>
            <a href="{{ route('master.paket-praktek.index') }}">
                <div class="parent-icon icon-color-4"><i class="bx bx-box"></i>
                </div>
                <div class="menu-title">Master Paket Praktik</div>
            </a>
        </li>
        <li class="menu-label">Transaksi</li>
        <li>
            <a href="{{ route('transaksi.stok.in.index') }}">
                <div class="parent-icon icon-color-3"> <i class="bx bx-archive-in"></i>
                </div>
                <div class="menu-title">Stok In Bahan</div>
            </a>
        </li>
        <li>
            <a href="{{ route('transaksi.stok.out.index') }}">
                <div class="parent-icon icon-color-3"> <i class="bx bx-archive-out"></i>
                </div>
                <div class="menu-title">Stok Out Bahan</div>
            </a>
        </li>
        <li>
            <a href="{{ route('transaksi.moving.index') }}">
                <div class="parent-icon icon-color-3"> <i class="bx bx-map-pin"></i>
                </div>
                <div class="menu-title">Pindah Bahan</div>
            </a>
        </li>
        <li>
            <a href="{{ route('transaksi.permintaan.terima.index') }}">
                <div class="parent-icon icon-color-3"> <i class="bx bx-list-check"></i>
                </div>
                <div class="menu-title">Verifikasi Permintaan Bahan</div>
            </a>
        </li>
        <li class="menu-label">Laporan</li>
        <li>
            <a href="{{ route('laporan.barang.index') }}">
                <div class="parent-icon icon-color-7"> <i class="bx bx-file"></i>
                </div>
                <div class="menu-title">Laporan Bahan</div>
            </a>
        </li>
        <li>
            <a href="{{ route('laporan.transaksi.index') }}">
                <div class="parent-icon icon-color-7"> <i class="bx bx-file"></i>
                </div>
                <div class="menu-title">Laporan Transaksi</div>
            </a>
        </li>
        <li>
            <a href="{{ route('laporan.history.index') }}">
                <div class="parent-icon icon-color-7"> <i class="bx bx-file"></i>
                </div>
                <div class="menu-title">Laporan History</div>
            </a>
        </li>

        @else
        <li class="menu-label">Utama</li>
        <li>
            <a href="{{ route('mahasiswa.dashboard') }}">
                <div class="parent-icon icon-color-2"> <i class="bx bx-home"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('transaksi.permintaan.index') }}">
                <div class="parent-icon icon-color-3"> <i class="bx bx-basket"></i>
                </div>
                <div class="menu-title">Permintaan BHP</div>
            </a>
        </li>
        @endif
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar-wrapper-->
