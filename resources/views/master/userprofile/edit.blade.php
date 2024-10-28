@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Form Edit Profil Pengguna')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Edit</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('master.userprofile.index') }}">Profil Pengguna</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('master.userprofile.proses-edit') }}">
                    @csrf
                    <input type="hidden" value="{{ request()->get('id_login', '') }}" name="oldid">

                    {{-- GRID SYSTEM FORM --}}
                    {{-- https://getbootstrap.com/docs/4.0/layout/grid/#equal-width --}}
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">User ID / Username:</label>
                            <input value="{{ $dataLogin->userid }}" class="form-control form-control-sm" type="text" name="userid" id="userid" placeholder="Masukkan User ID / Username" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Password: <i>(silahkan input untuk mengganti password)</i></label>
                            <input value="" class="form-control form-control-sm" type="password" name="password" id="password" placeholder="Masukkan Password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">NIP/NIDN/NIK:</label>
                            <input value="{{ $dataLogin->nip }}" class="form-control form-control-sm" type="text" name="nip" id="nip" placeholder="Masukkan NIP/NIDN/NIK" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Nama Pengguna:</label>
                            <input value="{{ $dataLogin->nama_user }}" class="form-control form-control-sm" type="text" name="nama" id="nama" placeholder="Masukkan Nama Asli Pengguna" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Nama Program Studi:</label>
                                <select class="single-select" name="prodi" id="prodi" required>
                                    <option value="" disabled>-- Pilih Program Studi --</option>
                                    @foreach ($dataProdi as $nomor => $value)
                                        <option {{ ($value->id_prodi == $dataLogin->user_id_prodi)? 'selected': '' }} value="{{ $value->id_prodi }}">{{ $value->nama_prodi }}</option>
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
                                    <option disabled>-- Pilih Level --</option>
                                    <option {{ ($dataLogin->level == 'admin')? 'selected' : '' }} value="admin">Admin</option>
                                    <option {{ ($dataLogin->level == 'operator')? 'selected' : '' }} value="operator">Operator</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Status Pengguna:</label>
                                <select class="single-select" name="status" id="status" required>
                                    <option disabled>-- Pilih Status Pengguna --</option>
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
