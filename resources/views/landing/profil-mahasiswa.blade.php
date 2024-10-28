@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Profil Mahasiswa')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Profil</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('mahasiswa.dashboard') }}">Mahasiswa</a>
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
                <table id="table-utama" class="table table-striped table-bordered" style="width:100%">
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
                            <td>Kode Program Studi:</td>
                            <td>{{ $dataProdi->kode_prodi }}</td>
                        </tr>
                        <tr>
                            <td>Nama Program Studi:</td>
                            <td>{{ $dataProdi->nama_prodi }}</td>
                        </tr>
                        <tr>
                            <td>Kode Kelas:</td>
                            <td>{{ $dataKelas->kode_kelas }}</td>
                        </tr>
                        <tr>
                            <td>Nama Kelas:</td>
                            <td>{{ $dataKelas->nama_kelas }}</td>
                        </tr>
                        <tr>
                            <td>NIM:</td>
                            <td>{{ $dataMahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <td>Nama Mahasiswa:</td>
                            <td>{{ $dataMahasiswa->nama_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <td>No. Telp</td>
                            <td>{{ $dataMahasiswa->telp }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $dataMahasiswa->alamat }}</td>
                        </tr>
                        <tr>
                            <td>E-Mail</td>
                            <td>{{ $dataMahasiswa->email }}</td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td>{{ $dataMahasiswa->password }}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- ACTION FORM --}}
                <div class="row mt-1">
                    <div class="col-12">
                        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-chevron-left me-1"></i>Kembali</a>
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

