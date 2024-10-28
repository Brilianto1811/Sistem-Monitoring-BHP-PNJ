@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Form Tambah Program Studi')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tambah</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('master.prodi.index') }}">Program Studi</a>
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
                <form method="POST" action="{{ route('master.prodi.proses-add') }}">
                    @csrf

                    {{-- GRID SYSTEM FORM --}}
                    {{-- https://getbootstrap.com/docs/4.0/layout/grid/#equal-width --}}

                    <div class="row mb-3">
                        <div class="col-12">
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
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Kode Program Studi:</label>
                            <input class="form-control form-control-sm" type="text" name="kode_prodi" id="kode_prodi" placeholder="Masukkan Kode Program Studi | Contoh: PSMD3AB, PSSD4KG, PSED3EI">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Nama Program Studi:</label>
                            <input class="form-control form-control-sm" type="text" name="nama_prodi" id="nama_prodi" placeholder="Masukkan Nama Program Studi | Contoh: D3-Alat Berat, D4-Konstruksi Gedung, D3-Elektronika Industri">
                        </div>
                    </div>
                    {{-- [END] GRID SYSTEM FORM --}}

                    {{-- ACTION FORM --}}
                    <div class="row justify-content-center">
                        <div class="col-8 text-center">
                            <a href="{{ route('master.prodi.index') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-x me-1"></i>Batal</a>
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
