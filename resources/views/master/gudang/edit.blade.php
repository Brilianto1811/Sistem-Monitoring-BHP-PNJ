@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Form Edit Gudang')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Edit</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('master.gudang.index') }}">Gudang</a>
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
                <form method="POST" action="{{ route('master.gudang.proses-edit') }}">
                    @csrf
                    <input value="{{ $dataGudang->id_gudang }}" type="hidden" name="oldid" id="oldid">

                    {{-- GRID SYSTEM FORM --}}
                    {{-- https://getbootstrap.com/docs/4.0/layout/grid/#equal-width --}}
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Nama Gedung:</label>
                                <select class="single-select" name="id_gedung" id="id_gedung">
                                    <option value="" selected disabled>-- Pilih Gedung --</option>
                                    @foreach ($dataGedung as $nomor => $value)
                                    @php
                                        $idnya1 = $dataGudang->id_gedung;
                                        $idnya2 = $value['id_gedung'];
                                        $select = ($idnya1 == $idnya2)? 'selected' : '';
                                    @endphp
                                        <option {{ $select }} value="{{ $value['id_gedung'] }}">{{ $value['nama_gedung'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Kode Gudang:</label>
                            <input value="{{ $dataGudang->kode_gudang }}" class="form-control form-control-sm" type="text" name="kode_gudang" id="kode_gudang" placeholder="Masukkan Kode Gudang | Contoh: RT1, TS2" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Nama Gudang:</label>
                            <input value="{{ $dataGudang->nama_gudang }}" class="form-control form-control-sm" type="text" name="nama_gudang" id="nama_gudang" placeholder="Masukkan Nama Gudang | Contoh: Ruang Teknisi 1, Tools Store 2" required>
                        </div>
                    </div>
                    {{-- [END] GRID SYSTEM FORM --}}

                    {{-- ACTION FORM --}}
                    <div class="row justify-content-center">
                        <div class="col-8 text-center">
                            <a href="{{ route('master.gudang.index') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-x me-1"></i>Batal</a>
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
