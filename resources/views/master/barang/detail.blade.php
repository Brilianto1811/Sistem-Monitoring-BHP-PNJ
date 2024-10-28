@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Detail Bahan')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Detail</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('master.barang.index') }}">Bahan</a>
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
                            <td>Kode Bahan:</td>
                            <td>{{ $dataBarang->kode_barang }}</td>
                        </tr>
                        <tr>
                            <td>Nama Bahan:</td>
                            <td>{{ $dataBarang->nama_barang }}</td>
                        </tr>
                        <tr>
                            <td>Satuan:</td>
                            <td>{{ $dataBarang->unit }}</td>
                        </tr>
                        <tr>
                            <td>Status Bahan:</td>
                            <td>
                                {{-- {{ $dataBarang->status_barang }} --}}
                                @if ($dataBarang->status_barang == 'aktif')
                                <span class="badge bg-success rounded-pill">Aktif</span>
                                @endif
                                @if ($dataBarang->status_barang == 'nonaktif')
                                    <span class="badge bg-danger rounded-pill">Non-Aktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <td>Stok Awal:</td>
                            <td>{{ $dataBarang->stok_awal }}</td>
                        </tr>
                        <tr>
                            <td>Stok Sebelumnya:</td>
                            <td>{{ $dataBarang->stok_sebelumnya }}</td>
                        </tr>
                        <tr>
                            <td>Stok Sekarang:</td>
                            <td>{{ $dataBarang->stok_sekarang }}</td>
                        </tr>
                        <tr>
                            <td>Transaksi Terakhir:</td>
                                @php
                                    $urlRoute = 'transaksi.stok.out.detail';
                                    $valParam = 'id_trx_last';
                                    if ($dataBarang['tipe_trx_last'] == 'STOK_IN') {
                                        $urlRoute = 'transaksi.stok.in.detail';
                                    }
                                    if ($dataBarang['tipe_trx_last'] == 'STOK_OUT_MAHASISWA') {
                                        // $urlRoute = 'transaksi.permintaan.terima.verifikasi';
                                        // $valParam = 'id_trx_last';
                                    }
                                @endphp
                            <td><a target="_blank" class="btn btn-link btn-sm"
                                    href="{{ route($urlRoute, ['id_trx' => $dataBarang['id_trx_last']]) }}">{{ $dataBarang['kode_trx_last'] }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <td>Lokasi Awal:</td>
                            <td>{{ $dataBarang->lokasi_awal }}</td>
                        </tr>
                        <tr>
                            <td>Lokasi Sebelumnya:</td>
                            <td>{{ $dataBarang->lokasi_sebelumnya }}</td>
                        </tr>
                        <tr>
                            <td>Lokasi Sekarang:</td>
                            <td>{{ $dataBarang->lokasi_sekarang }}</td>
                        </tr>
                        <tr>
                            <td>Pemindahan Terakhir</td>
                            <td><a target="_blank" class="btn btn-link btn-sm"
                                        href="{{ route('transaksi.moving.detail', ['id_pindah' => $dataBarang['id_trx_move_last']]) }}">{{ $dataBarang['kode_trx_move_last'] }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <td>Gedung Create:</td>
                            <td>{{ $dataBarang->kode_gedung_create }} | {{ $dataBarang->nama_gedung_create }}</td>
                        </tr>
                        <tr>
                            <td>Gudang Create:</td>
                            <td>{{ $dataBarang->kode_gudang_create }} | {{ $dataBarang->nama_gudang_create }}</td>
                        </tr>
                        <tr>
                            <td>Blok Create:</td>
                            <td>{{ $dataBarang->kode_blok_create }} | {{ $dataBarang->nama_blok_create }}</td>
                        </tr>
                        <tr>
                            <td>Lokasi Create:</td>
                            <td>{{ $dataBarang->kode_lokasi_create }} | {{ $dataBarang->nama_lokasi_create }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <td>Gedung Sebelumnya:</td>
                            <td>{{ $dataBarang->kode_gedung_old }} | {{ $dataBarang->nama_gedung_old }}</td>
                        </tr>
                        <tr>
                            <td>Gudang Sebelumnya:</td>
                            <td>{{ $dataBarang->kode_blok_old }} | {{ $dataBarang->nama_blok_old }}</td>
                        </tr>
                        <tr>
                            <td>Blok Sebelumnya:</td>
                            <td>{{ $dataBarang->kode_blok_old }} | {{ $dataBarang->nama_blok_old }}</td>
                        </tr>
                        <tr>
                            <td>Lokasi Sebelumnya:</td>
                            <td>{{ $dataBarang->kode_lokasi_old }} | {{ $dataBarang->nama_lokasi_old }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <td>Gedung Sekarang:</td>
                            <td>{{ $dataBarang->kode_gedung_now }} | {{ $dataBarang->nama_gedung_now }}</td>
                        </tr>
                        <tr>
                            <td>Gudang Sekarang:</td>
                            <td>{{ $dataBarang->kode_gudang_now }} | {{ $dataBarang->nama_gudang_now }}</td>
                        </tr>
                        <tr>
                            <td>Blok Sekarang:</td>
                            <td>{{ $dataBarang->kode_blok_now }} | {{ $dataBarang->nama_blok_now }}</td>
                        </tr>
                        <tr>
                            <td>Lokasi Sekarang:</td>
                            <td>{{ $dataBarang->kode_lokasi_now }} | {{ $dataBarang->nama_lokasi_now }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>

                        {{-- back identity --}}
                        <tr>
                            <td>User Created:</td>
                            <td>{{ $dataBarang->user_create }}</td>
                        </tr>
                        <tr>
                            <td>Created At:</td>
                            <td>{{ $dataBarang->created_at }}</td>
                        </tr>
                        <tr>
                            <td>User Updated:</td>
                            <td>{{ $dataBarang->user_update }}</td>
                        </tr>
                        <tr>
                            <td>Updated At:</td>
                            <td>{{ $dataBarang->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>UID:</td>
                            <td>{{ $dataBarang->uid }}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- ACTION FORM --}}
                <div class="row mt-1">
                    <div class="col-12">
                        <a href="{{ route('master.barang.index') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-chevron-left me-1"></i>Kembali</a>
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
