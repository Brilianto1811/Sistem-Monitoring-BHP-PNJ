@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Form Tambah Blok')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tambah</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('master.blok.index') }}">Blok</a>
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
                <form method="POST" action="{{ route('master.blok.proses-add') }}">
                    @csrf

                    {{-- GRID SYSTEM FORM --}}
                    {{-- https://getbootstrap.com/docs/4.0/layout/grid/#equal-width --}}
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Nama Gedung:</label>
                                <select class="single-select" name="id_gedung" id="id_gedung">
                                    <option value="" selected disabled>-- Pilih Gedung --</option>
                                    @foreach ($dataGedung as $nomor => $value)
                                        <option value="{{ $value['id_gedung'] }}">{{ $value['nama_gedung'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Nama Gudang:</label>
                                <select class="single-select" name="id_gudang" id="id_gudang">
                                    <option value="" selected disabled>-- Pilih Gudang --</option>
                                    @foreach ($dataGudang as $nomor => $value)
                                        <option value="{{ $value['id_gudang'] }}">{{ $value['nama_gudang'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Kode Blok:</label>
                            <input class="form-control form-control-sm" type="text" name="kode_blok" id="kode_blok" placeholder="Masukkan Kode Blok | Contoh: Lt1, Lm2, R3">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Nama Blok:</label>
                            <input class="form-control form-control-sm" type="text" name="nama_blok" id="nama_blok" placeholder="Masukkan Nama Blok | Contoh: Lantai 1, Lemari 2, Rak 3">
                        </div>
                    </div>
                    {{-- [END] GRID SYSTEM FORM --}}

                    {{-- ACTION FORM --}}
                    <div class="row justify-content-center">
                        <div class="col-8 text-center">
                            <a href="{{ route('master.blok.index') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-x me-1"></i>Batal</a>
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
