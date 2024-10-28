@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Detail Jurusan')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Detail</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('master.jurusan.index') }}">Jurusan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <table id="table-utama" class="table table-sm table-striped table-bordered" style="width:100%">
                    <tbody>
                        <tr>
                            <td>Kode Jurusan:</td>
                            <td>{{ $dataJurusan->kode_jurusan }}</td>
                        </tr>
                        <tr>
                            <td>Nama Jurusan:</td>
                            <td>{{ $dataJurusan->nama_jurusan }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>

                        {{-- back identity --}}
                        <tr>
                            <td>User Created:</td>
                            <td>{{ $dataJurusan->user_create }}</td>
                        </tr>
                        <tr>
                            <td>Created At:</td>
                            <td>{{ $dataJurusan->created_at }}</td>
                        </tr>
                        <tr>
                            <td>User Updated:</td>
                            <td>{{ $dataJurusan->user_update }}</td>
                        </tr>
                        <tr>
                            <td>Updated At:</td>
                            <td>{{ $dataJurusan->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>UID:</td>
                            <td>{{ $dataJurusan->uid }}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- ACTION FORM --}}
                <div class="row mt-1">
                    <div class="col-12">
                        <a href="{{ route('master.jurusan.index') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-chevron-left me-1"></i>Kembali</a>
                    </div>
                </div>
                {{-- [END] ACTION FORM --}}
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
