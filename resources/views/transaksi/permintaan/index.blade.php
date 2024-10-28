@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Halaman Permintaan BHP')
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
        <a href="{{ route('transaksi.permintaan.create') }}" class="btn btn-primary m-1 radius-30 px-5"><i class="bx bx-plus me-1"></i>Form Permintaan BHP</a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="mb-0">Data Permintaan BHP</h4>
                </div>
                <hr/>
                <div class="table-responsive">
                    <table id="table-utama" class="table table-striped table-bordered table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Action</th>
                                <th>Status Permintaan</th>
                                <th>Kode Permintaan</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Informasi Permintaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPermintaan as $index => $value)
                            <tr>
                                <td><center>{{ $index + 1 }}</center></td>
                                <td>
                                    <a href="{{ route('transaksi.permintaan.detail', ['id_trx' => $value->id_permintaan]) }}" class="btn btn-info btn-sm m-1"><i class="bx bx-detail"></i></a>
                                </td>
                                <td>
                                    @if ($value->status_permintaan == '1')
                                        <span class="badge bg-success rounded-pill">Diterima</span>
                                    @endif
                                    @if ($value->status_permintaan == '2')
                                        <span class="badge bg-danger rounded-pill">Ditolak</span>
                                    @endif
                                    @if ($value->status_permintaan == '0')
                                        <span class="badge bg-secondary rounded-pill">Menunggu</span>
                                    @endif
                                </td>
                                <td>{{ $value->kode_permintaan }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>{{ $value->informasi }}</td>
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
	$(document).ready(function () {
		var table = $('#table-utama').DataTable({
			lengthChange: false,
            scrollX: true,
		});
		table.buttons().container().appendTo('#table-utama_wrapper .col-md-6:eq(0)');
	});
</script>
@endsection
