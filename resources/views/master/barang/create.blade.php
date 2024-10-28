@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Form Tambah Bahan')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tambah</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('master.barang.index') }}">Bahan</a>
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
                <form method="POST" action="{{ route('master.barang.proses-add') }}">
                    @csrf

                    {{-- GRID SYSTEM FORM --}}
                    {{-- https://getbootstrap.com/docs/4.0/layout/grid/#equal-width --}}
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Kode Bahan:</label>
                            <input class="form-control form-control-sm" type="text" name="kode_barang" id="kode_barang" placeholder="Masukkan Kode Bahan | Contoh: BB001, BS001" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Nama Bahan:</label>
                            <input class="form-control form-control-sm" type="text" name="nama_barang" id="nama_barang" placeholder="Masukkan Nama Bahan | Contoh: Baut, Sekrup" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Satuan:</label>
                            <input class="form-control form-control-sm" type="text" name="unit" id="unit" placeholder="Masukkan Satuan | Contoh: pcs, pack, unit" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Stok Awal:</label>
                            <input class="form-control form-control-sm" type="number" name="stok_awal" id="stok_awal" min="1" placeholder="Masukkan Stok Awal (minimal 1) | Contoh: 3, 5, 7" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Lokasi Awal:</label>
                                <select class="single-select" name="lokasi_sekarang" id="lokasi_sekarang" required>
                                    <option value="" selected disabled>-- Pilih Lokasi Awal --</option>
                                    @foreach ($dataLokasi as $nomor => $value)
                                        <option value="{{ $value['id_lokasi'] }}">{{ $value['nama_lokasi'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Status Bahan:</label>
                                <select class="single-select" name="status_barang" id="status_barang">
                                    <option value="" selected disabled>-- Pilih Status Bahan --</option>
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
                            <a href="{{ route('master.barang.index') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-x me-1"></i>Batal</a>
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
    $("input[type='number']").on("input", function() {
        var nonNumReg = /[^0-9]/g
        $(this).val($(this).val().replace(nonNumReg, ''));
    });
</script>
@endsection
