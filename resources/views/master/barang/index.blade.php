@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Halaman Bahan')
@section('content')
<div class="row">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <div class="alert alert-{{ $msg }} border-0 bg-{{ $msg }} alert-dismissible fade show">
            <div class="text-white">{{ Session::get('alert-' . $msg) }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    @endforeach
</div>
    <div class="row">
        <div class="col-12">
            <a href="{{ route('master.barang.create') }}" class="btn btn-primary m-1 radius-30 px-5"><i class="bx bx-plus me-1"></i>Tambah Bahan</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">Data Bahan</h4>
                    </div>
                    <hr/>
                    <div class="table-responsive">
                        <table id="table-utama" class="table table-sm table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kode Bahan</th>
                                    <th>Nama Bahan</th>
                                    <th>Satuan</th>
                                    <th>Status Bahan</th>
                                    <th>Stok Awal</th>
                                    <th>Stok Sebelumnya</th>
                                    <th>Stok Sekarang</th>
                                    <th>Transaksi Terakhir</th>
                                    <th>Lokasi Awal</th>
                                    <th>Lokasi Sebelumnya</th>
                                    <th>Lokasi Sekarang</th>
                                    <th>Pemindahan Terakhir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataBarang as $nomor => $value)
                                    <tr>
                                        <td>{{ $value['kode_barang'] }}</td>
                                        <td>{{ $value['nama_barang'] }}</td>
                                        <td>{{ $value['unit'] }}</td>
                                        <td>
                                            <center>
                                            @if ($value['status_barang'] == 'aktif')
                                                <span class="badge bg-success rounded-pill">Aktif</span>
                                            @endif
                                            @if ($value['status_barang'] == 'nonaktif')
                                                <span class="badge bg-danger rounded-pill">Non-Aktif</span>
                                            @endif
                                            </center>
                                        </td>
                                        <td>{{ $value['stok_awal'] }}</td>
                                        <td>{{ $value['stok_sebelumnya'] }}</td>
                                        <td>{{ $value['stok_sekarang'] }}</td>
                                        <td>
                                            @php
                                                $urlRoute = 'transaksi.stok.out.detail';
                                                $valParam = 'id_trx_last';
                                                if ($value['tipe_trx_last'] == 'STOK_IN') {
                                                    $urlRoute = 'transaksi.stok.in.detail';
                                                }
                                                if ($value['tipe_trx_last'] == 'STOK_OUT_MAHASISWA') {
                                                    // $urlRoute = 'transaksi.permintaan.terima.verifikasi';
                                                    // $valParam = 'id_trx_last';
                                                }
                                            @endphp
                                            <a target="_blank" class="btn btn-link btn-sm"
                                                href="{{ route($urlRoute, ['id_trx' => $value['id_trx_last']]) }}">{{ $value['kode_trx_last'] }}</a>
                                        </td>
                                        <td>{{ $value['lokasi_awal'] }}</td>
                                        <td>{{ $value['lokasi_sebelumnya'] }}</td>
                                        <td>{{ $value['lokasi_sekarang'] }}</td>
                                        <td>
                                            <a target="_blank" class="btn btn-link btn-sm"
                                                href="{{ route('transaksi.moving.detail', ['id_pindah' => $value['id_trx_move_last']]) }}">{{ $value['kode_trx_move_last'] }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('master.barang.detail', ['id_barang' => $value['id_barang']]) }}"
                                                class="btn btn-info btn-sm m-1"><i class="bx bx-detail"></i></a>
                                            <a href="{{ route('master.barang.edit', ['id_barang' => $value['id_barang']]) }}"
                                                class="btn btn-warning btn-sm m-1"><i class="bx bx-edit"></i></a>
                                            <button class="btn btn-danger btn-sm m-1" data-bs-toggle="modal"
                                                data-bs-target="#alertConfirm<?= $nomor ?>"><i
                                                    class="bx bx-trash"></i></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="alertConfirm<?= $nomor ?>" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content bg-white">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Yakin hapus data?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <a href="{{ route('master.barang.proses-delete', ['id_barang' => $value['id_barang']]) }}" class="btn btn-danger">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function() {
            var table = $('#table-utama').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print', 'colvis'],
                scrollX: true,
            });
            table.buttons().container().appendTo('#table-utama_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
