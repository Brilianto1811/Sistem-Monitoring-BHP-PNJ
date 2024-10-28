@extends('layouts.base-dashboard')
@section('custom-css')
<link href="/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
<link href="/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
@endsection


@section('title', 'Halaman Laporan Bahan')
@section('content')
    <div class="row">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <div class="alert alert-{{ $msg }} border-0 bg-{{ $msg }} alert-dismissible fade show">
                    <div class="text-white">{{ Session::get('alert-' . $msg) }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endforeach
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">Filtering</h4>
                    </div>
                    <hr />
                    <form action="{{ route('laporan.barang.index') }}" method="get">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">Tanggal Awal:</label>
                                <input type="text" name="date_from" class="form-control datepicker form-control-sm" @if(!request()->get('date_from')) data-value="keisi default wkwkwk" @endif value="{{ request()->get('date_from') }}" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Tanggal Akhir:</label>
                                <input type="text" name="date_to" class="form-control datepicker form-control-sm" @if(!request()->get('date_to')) data-value="keisi default wkwkwk" @endif value="{{ request()->get('date_to') }}" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('laporan.barang.index') }}" name="filter" value="clear" class="btn btn-danger m-1 radius-30 px-5"><i class="bx bx-eraser me-1"></i>Clear</a>
                                    <button name="filter" value="filter" class="btn btn-primary m-1 radius-30 px-5"><i class="bx bx-filter me-1"></i>Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">Data Laporan Bahan</h4>
                    </div>
                    <hr />
                    <div class="table-responsive">
                        <table id="table-utama" class="table table-sm table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Bahan</th>
                                    <th>Nama Bahan</th>
                                    <th>Satuan</th>
                                    <th>Status Bahan</th>
                                    <th>Stok Awal</th>
                                    <th>Stok Sebelumnya</th>
                                    <th>Stok Sekarang</th>
                                    <th>Lokasi Awal</th>
                                    <th>Lokasi Sebelumnya</th>
                                    <th>Lokasi Sekarang</th>
                                    <th>Gedung Awal</th>
                                    <th>Gedung Sebelumnya</th>
                                    <th>Gedung Sekarang</th>
                                    <th>Gudang Awal</th>
                                    <th>Gudang Sebelumnya</th>
                                    <th>Gudang Sekarang</th>
                                    <th>Blok Awal</th>
                                    <th>Blok Sebelumnya</th>
                                    <th>Blok Sekarang</th>
                                    <th>Transaksi Terakhir</th>
                                    <th>Pemindahan Terakhir</th>
                                    <th>Username Create</th>
                                    <th>NIP/NIDN/NIK User Create</th>
                                    <th>Nama User Create</th>
                                    <th>Username Update</th>
                                    <th>NIP/NIDN/NIK User Update</th>
                                    <th>Nama User Update</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>UID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataBarang as $index => $value)
                                <tr>
                                    <td><center>{{ $index +1 }}<center></td>
                                    <td>{{ $value->kode_barang }}</td>
                                    <td>{{ $value->nama_barang }}</td>
                                    <td>{{ $value->unit }}</td>
                                    <td>{{ $value->status_barang }}</td>
                                    <td>{{ $value->stok_awal }}</td>
                                    <td>{{ $value->stok_sebelumnya }}</td>
                                    <td>{{ $value->stok_sekarang }}</td>
                                    <td>{{ $value->lokasi_awal }}</td>
                                    <td>{{ $value->lokasi_sebelumnya }}</td>
                                    <td>{{ $value->lokasi_sekarang }}</td>
                                    <td>{{ $value->nama_gedung_create }}</td>
                                    <td>{{ $value->nama_gedung_old }}</td>
                                    <td>{{ $value->nama_gedung_now }}</td>
                                    <td>{{ $value->nama_gudang_create }}</td>
                                    <td>{{ $value->nama_gudang_old }}</td>
                                    <td>{{ $value->nama_gudang_now }}</td>
                                    <td>{{ $value->nama_blok_create }}</td>
                                    <td>{{ $value->nama_blok_old }}</td>
                                    <td>{{ $value->nama_blok_now }}</td>
                                    <td>{{ $value->kode_trx_last }}</td>
                                    <td>{{ $value->kode_trx_move_last }}</td>
                                    <td>{{ $value->user_create }}</td>
                                    <td>{{ $value->nip_user_update }}</td>
                                    <td>{{ $value->nama_user_update }}</td>
                                    <td>{{ $value->user_create }}</td>
                                    <td>{{ $value->nip_user_update }}</td>
                                    <td>{{ $value->nama_user_update }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>{{ $value->updated_at }}</td>
                                    <td>{{ $value->uid }}</td>
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
    <script src="/assets/plugins/datetimepicker/js/legacy.js"></script>
	<script src="/assets/plugins/datetimepicker/js/picker.js"></script>
    <script src="/assets/plugins/datetimepicker/js/picker.date.js"></script>
    <script>
		$('.datepicker').pickadate({
            max: new Date(),
            format: 'dd mmmm yyyy',
            formatSubmit: 'yyyy-mm-dd',
            selectYears: true,
            selectMonths: true,
		})
	</script>
    <script>
        $(document).ready(function() {
            $('#table-utama thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#table-utama thead');
            var table = $('#table-utama').DataTable({
                orderCellsTop: true,
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print', 'colvis'],
                scrollX: true,
                initComplete: function() {
                    var api = this.api();
                    console.log(api.columns().eq(0), 'apinya')

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input class="form-control form-control-sm" type="text" placeholder="' +
                                title + '..." />');

                            // On every keypress in this input
                            $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('change', function(e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr =
                                    '({search})';

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value +
                                                ')))') :
                                            '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function(e) {
                                    e.stopPropagation();

                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
            });
            table.buttons().container().appendTo('#table-utama_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
