@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Halaman Profil Pengguna')
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
        <a href="{{ route('master.userprofile.create') }}" class="btn btn-primary m-1 radius-30 px-5"><i class="bx bx-plus me-1"></i>Tambah Profil Pengguna</a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="mb-0">Data Profil Pengguna</h4>
                </div>
                <hr/>
                <div class="table-responsive">
                    <table id="table-utama" class="table table-sm table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>User ID / Username</th>
                                <th>NIP/NIDN/NIK</th>
                                <th>Nama Pengguna</th>
                                <th>Kode Program Studi</th>
                                <th>Nama Program Studi</th>
                                <th>Level</th>
                                <th>Status Pengguna</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataUserprofile as $nomor => $value)
                                <tr>
                                    <td>{{ $value['userid'] }}</td>
                                    <td>{{ $value['nip'] }}</td>
                                    <td>{{ $value['nama_user'] }}</td>
                                    <td>{{ $value['user_kode_prodi'] }}</td>
                                    <td>{{ $value['user_nama_prodi'] }}</td>
                                    <td>{{ $value['level'] }}</td>
                                    <td>
                                        <center>
                                        @if ($value['status_user'] == 'aktif')
                                            <span class="badge bg-success rounded-pill">Aktif</span>
                                        @endif
                                        @if ($value['status_user'] == 'nonaktif')
                                            <span class="badge bg-danger rounded-pill">Non-Aktif</span>
                                        @endif
                                        </center>
                                    </td>
                                    <td>
                                        <a href="{{ route('master.userprofile.detail', ['id_login' => $value['id_login']]) }}" class="btn btn-info btn-sm m-1"><i class="bx bx-detail"></i></a>
                                        <a href="{{ route('master.userprofile.edit', ['id_login' => $value['id_login']]) }}" class="btn btn-warning btn-sm m-1"><i class="bx bx-edit"></i></a>
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
                                                        <a href="{{ route('master.userprofile.proses-delete', ['id_login' => $value['id_login']]) }}" class="btn btn-danger">Hapus</a>
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
		$(document).ready(function () {
			var table = $('#table-utama').DataTable({
				lengthChange: false,
				buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
			});
			table.buttons().container().appendTo('#table-utama_wrapper .col-md-6:eq(0)');
		});
	</script>
@endsection
