@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Form Tambah Mahasiswa')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tambah</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('master.mahasiswa.index') }}">Mahasiswa</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('master.mahasiswa.proses-add') }}">
                    @csrf

                    {{-- GRID SYSTEM FORM --}}
                    {{-- https://getbootstrap.com/docs/4.0/layout/grid/#equal-width --}}
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-3">
                                <div class="select2-sm">
                                    <label class="form-label">Nama Jurusan:</label>
                                    <select class="single-select" name="id_jurusan" id="id_jurusan">
                                        <option value="" selected disabled>-- Pilih Jurusan --</option>
                                        @foreach ($dataJurusan as $nomor => $value)
                                            <option value="{{ $value['id_jurusan'] }}">{{ $value['nama_jurusan'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="select2-sm">
                                    <label class="form-label">Nama Program Studi:</label>
                                    <select class="single-select" name="id_prodi" id="id_prodi">
                                        <option value="" selected disabled>-- Pilih Program Studi --</option>
                                        @foreach ($dataProdi as $nomor => $value)
                                            <option value="{{ $value['id_prodi'] }}">{{ $value['nama_prodi'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="select2-sm">
                                    <label class="form-label">Nama Kelas:</label>
                                    <select class="single-select" name="id_kelas" id="id_kelas">
                                        <option value="" selected disabled>-- Pilih Kelas --</option>
                                        @foreach ($dataKelas as $nomor => $value)
                                            <option value="{{ $value['id_kelas'] }}">{{ $value['nama_kelas'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="select2-sm">
                                    <label class="form-label">NIM:</label>
                                    <input class="form-control form-control-sm" type="text" name="nama_nim"
                                        id="nama_nim" placeholder="Masukkan Nomor Induk Mahasiswa (NIM)">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="select2-sm">
                                    <label class="form-label">Nama Mahasiswa:</label>
                                    <input class="form-control form-control-sm" type="text" name="nama_mahasiswa"
                                        id="nama_mahasiswa" placeholder="Masukkan Nama Lengkap Mahasiswa">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row mb-3">
                                <div class="select2-sm">
                                    <label class="form-label">No. Telp:</label>
                                    <input class="form-control form-control-sm" type="text" name="nomor_telp"
                                        id="nomor_telp" placeholder="Masukkan Nomor Telepon Aktif Mahasiswa">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="select2-sm">
                                    <label class="form-label">Alamat:</label>
                                    <input class="form-control form-control-sm" type="text" name="nama_alamat"
                                        id="nama_alamat" placeholder="Masukkan Alamat Mahasiswa">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="select2-sm">
                                    <label class="form-label">E-Mail:</label>
                                    <input class="form-control form-control-sm" type="text" name="nama_email"
                                        id="nama_email" placeholder="Masukkan E-Mail Mahasiswa (nama.mahasiswa@mhsw.pnj.ac.id)">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="select2-sm">
                                    <label class="form-label">Password:</label>
                                    <input class="form-control form-control-sm" type="text" name="nama_password"
                                        id="nama_password" placeholder="Masukkan Password">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- [END] GRID SYSTEM FORM --}}

                        {{-- ACTION FORM --}}
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <a href="{{ route('master.mahasiswa.index') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-x me-1"></i>Batal</a>
                                <button type="submit" class="btn btn-primary m-1 radius-30 px-5 ml-auto"><i class="bx bx-save me-1"></i>Simpan</button>
                            </div>
                        </div>
                        {{-- [END] ACTION FORM --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
@endsection
