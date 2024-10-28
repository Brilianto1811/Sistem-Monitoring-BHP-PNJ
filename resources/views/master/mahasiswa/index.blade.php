@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Halaman Mahasiswa')
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
        <a href="{{ route('master.mahasiswa.create') }}" class="btn btn-primary m-1 radius-30 px-5"><i class="bx bx-plus me-1"></i>Tambah Mahasiswa</a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="mb-0">Data Mahasiswa</h4>
                </div>
                <hr/>
                <div class="table-responsive">
                    <table id="table-utama" class="table table-sm table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kode Jurusan</th>
                                <th>Nama Jurusan</th>
                                <th>Kode Program Studi</th>
                                <th>Nama Program Studi</th>
                                <th>Kode Kelas</th>
                                <th>Nama Kelas</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>No. Telp</th>
                                <th>Alamat</th>
                                <th>E-Mail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataMahasiswa as $nomor => $value)
                            <tr>
                                <td>{{ $value['kode_jurusan'] }}</td>
                                <td>{{ $value['nama_jurusan'] }}</td>
                                <td>{{ $value['kode_prodi'] }}</td>
                                <td>{{ $value['nama_prodi'] }}</td>
                                <td>{{ $value['kode_kelas'] }}</td>
                                <td>{{ $value['nama_kelas'] }}</td>
                                <td>{{ $value['nim'] }}</td>
                                <td>{{ $value['nama_mahasiswa'] }}</td>
                                <td>{{ $value['telp'] }}</td>
                                <td>{{ $value['alamat'] }}</td>
                                <td>{{ $value['email'] }}</td>
                                <td>
                                    <a href="{{ route('master.mahasiswa.detail', ['id_mahasiswa' => $value['id_mahasiswa']]) }}" class="btn btn-info btn-sm m-1"><i class="bx bx-detail"></i></a>
                                    <a href="{{ route('master.mahasiswa.edit', ['id_mahasiswa' => $value['id_mahasiswa']]) }}" class="btn btn-warning btn-sm m-1"><i class="bx bx-edit"></i></a>
                                    <button class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#alertConfirm<?= $nomor ?>"><i class="bx bx-trash"></i></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="alertConfirm<?= $nomor ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content bg-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Yakin hapus data?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <a href="{{ route('master.mahasiswa.proses-delete', ['id_mahasiswa' => $value['id_mahasiswa']]) }}" class="btn btn-danger">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @for($i = 1; $i <= 10; $i++)
                            @endfor
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
