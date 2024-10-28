@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Form Tambah Profil Pengguna')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tambah</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('master.userprofile.index') }}">Profil Pengguna</a>
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
                <form method="POST" action="{{ route('master.userprofile.proses-add') }}">
                    @csrf

                    {{-- GRID SYSTEM FORM --}}
                    {{-- https://getbootstrap.com/docs/4.0/layout/grid/#equal-width --}}
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">User ID / Username:</label>
                            <input class="form-control form-control-sm" type="text" name="userid" id="userid" placeholder="Masukkan User ID / Username" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Password:</label>
                            <input class="form-control form-control-sm" type="password" name="password" id="password" placeholder="Masukkan Password" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">NIP/NIDN/NIK:</label>
                            <input class="form-control form-control-sm" type="text" name="nip" id="nip" placeholder="Masukkan NIP/NIDN/NIK">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Nama Pengguna:</label>
                            <input class="form-control form-control-sm" type="text" name="nama" id="nama" placeholder="Masukkan Nama Asli Pengguna">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Nama Program Studi:</label>
                                <select class="single-select" name="prodi" id="prodi">
                                    <option value="" selected disabled>-- Pilih Program Studi --</option>
                                    @foreach ($dataProdi as $nomor => $value)
                                        <option value="{{ $value->id_prodi }}">{{ $value->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Level:</label>
                                <select class="single-select" name="level" id="level" required>
                                    <option value="" selected disabled>-- Pilih Level --</option>
                                    <option value="admin">Admin</option>
                                    <option value="operator">Operator</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Status Pengguna:</label>
                                <select class="single-select" name="status" id="status" required>
                                    <option value="" selected disabled>-- Pilih Status Pengguna --</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- [END] GRID SYSTEM FORM --}}

                    {{-- ACTION FORM --}}
                    <div class="row justify-content-center">
                        <div class="col-8 text-center">
                            <a href="{{ route('master.userprofile.index') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-x me-1"></i>Batal</a>
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
