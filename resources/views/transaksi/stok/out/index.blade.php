@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Halaman Stok Out Bahan')
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
        <a href="{{ route('transaksi.stok.out.create') }}" class="btn btn-primary m-1 radius-30 px-5"><i class="bx bx-plus me-1"></i>Form Stok Out Bahan</a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="mb-0">Data Stok Out Bahan</h4>
                </div>
                <hr/>
                <div class="table-responsive">
                    <table id="table-utama" class="table table-sm table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Transaksi</th>
                                <th>Tanggal Input</th>
                                <th>User Input</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataTransaksi as $nomor => $value)
                                <tr>
                                    <td><center>{{ $nomor+1 }}</center></td>
                                    <td>{{ $value->kode_trx }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>{{ $value->user_create }}</td>
                                    <td>{!! $value->ket !!}</td>
                                    <td>
                                        <a href="{{ route('transaksi.stok.out.detail', ['id_trx' => $value->id_trx]) }}" class="btn btn-info btn-sm m-1"><i class="bx bx-detail"></i></a>
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
		$(document).ready(function () {
			//Default data table
			var table = $('#table-utama').DataTable({
				lengthChange: false,
				buttons: ['copy', 'excel', 'pdf', 'print', 'colvis'],
                scrollX: true,
			});
			table.buttons().container().appendTo('#table-utama_wrapper .col-md-6:eq(0)');
		});
	</script>
@endsection
