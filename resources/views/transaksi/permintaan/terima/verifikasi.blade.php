@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Verifikasi Permintaan Bahan')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Verifikasi</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('transaksi.permintaan.terima.index') }}">Verifikasi Permintaan Bahan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Verifikasi</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <table id="table-utama" class="table table-striped table-bordered table-sm" style="width:100%">
                    <tbody>
                        <tr>
                            <td>Kode Permintaan:</td>
                            <td>{{ $dataPermintaan->kode_permintaan }}</td>
                        </tr>
                        <tr>
                            <td>Informasi Permintaan:</td>
                            <td>{!! $dataPermintaan->informasi !!}</td>
                        </tr>
                        <tr>
                            <td>NIM:</td>
                            <td>{{ $dataPermintaan->noid }}</td>
                        </tr>
                        <tr>
                            <td>Nama:</td>
                            <td>{{ $dataPermintaan->nama }}</td>
                        </tr>
                        <tr>
                            <td>Status Verifikasi:</td>
                            <td>
                                @if ($dataPermintaan->status_permintaan == '1')
                                    <span class="badge bg-success rounded-pill">Diterima</span>
                                @endif
                                @if ($dataPermintaan->status_permintaan == '2')
                                    <span class="badge bg-danger rounded-pill">Ditolak</span>
                                @endif
                                @if ($dataPermintaan->status_permintaan == '0')
                                    <span class="badge bg-secondary rounded-pill">Menunggu</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>

                        {{-- back identity --}}
                        <tr>
                            <td>User Created:</td>
                            <td>{{ $dataPermintaan->user_create }}</td>
                        </tr>
                        <tr>
                            <td>Created At:</td>
                            <td>{{ $dataPermintaan->created_at }}</td>
                        </tr>
                        <tr>
                            <td>User Updated:</td>
                            <td>{{ $dataPermintaan->user_update }}</td>
                        </tr>
                        <tr>
                            <td>Updated At:</td>
                            <td>{{ $dataPermintaan->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>UID:</td>
                            <td>{{ $dataPermintaan->uid }}</td>
                        </tr>
                    </tbody>
                </table>
                <table id="table-utama" class="table table-striped table-bordered mt-3 table-sm" style="width:100%">
                    <thead>
                        <th>No.</th>
                        <th>Kode Bahan</th>
                        <th>Nama Bahan</th>
                        <th>Jumlah Permintaan</th>
                        <th>UID</th>
                    </thead>
                    <tbody>
                        @foreach ($dataPermintaanDetail as $index => $value)
                        <tr>
                            <td><center>{{ $value->norut }}</center></td>
                            <td>{{ $value->kode_barang }}</td>
                            <td>{{ $value->nama_barang }}</td>
                            <td>{{ $value->qty }}</td>
                            <td>{{ $value->uid }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- ACTION FORM --}}
                <div class="row mt-1">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('transaksi.permintaan.terima.index') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-chevron-left me-1"></i>Kembali</a>
                            </div>
                            @if (!in_array($dataPermintaan->status_permintaan, ['1', '2']))
                            <div>
                                <form action="{{ route('transaksi.permintaan.terima.proses-verifikasi') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="oldid" id="oldid" value="{{ $dataPermintaan->id_permintaan }}">
                                    <button type="submit" name="status" value="tolak" class="btn btn-danger m-1 px-3"><i class="bx bx-x me-1"></i>Tolak</button>
                                    <button type="submit" name="status" value="terima" class="btn btn-success m-1 px-3"><i class="bx bx-check me-1"></i>Terima</button>
                                </form>
                            </div>
                            @endif
                        </div>
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
