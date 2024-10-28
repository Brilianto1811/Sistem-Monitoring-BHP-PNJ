@extends('layouts.base-dashboard')
@section('custom-css')
    <link href="/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
    <link href="/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
@endsection


@section('title', 'Halaman Laporan History')
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
                    <form action="{{ route('laporan.history.index') }}" method="get">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">Tanggal Awal:</label>
                                <input type="text" name="date_from" class="form-control datepicker form-control-sm"
                                    @if (!request()->get('date_from')) data-value="keisi default wkwkwk" @endif
                                    value="{{ request()->get('date_from') }}" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Tanggal Akhir:</label>
                                <input type="text" name="date_to" class="form-control datepicker form-control-sm"
                                    @if (!request()->get('date_to')) data-value="keisi default wkwkwk" @endif
                                    value="{{ request()->get('date_to') }}" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="select2-sm">
                                    <label class="form-label">Nama Bahan:</label>
                                    <select class="single-select" name="barang" id="barang" required>
                                        <option value="" selected disabled>-- Pilih Bahan --</option>
                                        @foreach ($dataBarang as $nomor => $value)
                                            <option @if (request()->get('barang') && request()->get('barang') == $value['id_barang']) selected @endif value="{{ $value['id_barang'] }}">{{ $value['nama_barang'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('laporan.history.index') }}" name="filter" value="clear"
                                        class="btn btn-danger m-1 radius-30 px-5"><i class="bx bx-eraser me-1"></i>Clear</a>
                                    <button name="filter" value="filter" class="btn btn-primary m-1 radius-30 px-5"><i
                                            class="bx bx-filter me-1"></i>Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">Data Laporan History Stok In & Out</h4>
                    </div>
                    <hr />
                    <div class="table-responsive">
                        <table id="table-utama" class="table table-sm table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tipe Transaksi</th>
                                    <th>Jumlah/Qty</th>
                                    <th>Keterangan</th>
                                    <th>Kode Permintaan</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Informasi Permintaan</th>
                                    <th>Nomor Urut</th>
                                    <th>Kode Bahan</th>
                                    <th>Nama Bahan</th>

                                    {{-- identity --}}
                                    <th>Username Create</th>
                                    <th>NIP/NIDN/NIK User Create</th>
                                    <th>Nama User Create</th>
                                    <th>Username Update</th>
                                    <th>NIP/NIDN/NIK User Update</th>
                                    <th>Nama User Update</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>UID Transaksi</th>
                                    <th>UID Bahan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataTransaksiDetail as $index => $value)
                                <tr>
                                    <th><center>{{ $index + 1 }}</center></th>
                                    <th>{{ $value->kode_trx }}</th>
                                    <th>{{ $value->tipe_trx }}</th>
                                    <th>{{ $value->stok }}</th>
                                    <th>{!! $value->ket !!}</th>
                                    <th>{{ $value->kode_permintaan }}</th>
                                    <th>{{ $value->nama_mahasiswa }}</th>
                                    <th>{{ $value->informasi }}</th>
                                    <th>{{ $value->norut }}</th>
                                    <th>{{ $value->kode_barang }}</th>
                                    <th>{{ $value->nama_barang }}</th>

                                    {{-- identity --}}
                                    <th>{{ $value->user_create }}</th>
                                    <th>{{ $value->nip_user_create }}</th>
                                    <th>{{ $value->nama_user_create }}</th>
                                    <th>{{ $value->user_update }}</th>
                                    <th>{{ $value->nip_user_update }}</th>
                                    <th>{{ $value->nama_user_update }}</th>
                                    <th>{{ $value->created_at }}</th>
                                    <th>{{ $value->updated_at }}</th>
                                    <th>{{ $value->uid }}</th>
                                    <th>{{ $value->uid_detail }}</th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">Data Laporan History Pemindahan Barang</h4>
                    </div>
                    <hr />
                    <div class="table-responsive">
                        <table id="table-utama2" class="table table-sm table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Pemindahan</th>
                                    <th>Jumlah Dipindah</th>
                                    <th>Keterangan</th>
                                    <th>Nomor Urut</th>
                                    <th>Kode Bahan</th>
                                    <th>Nama Bahan</th>
                                    <th>Lokasi Sekarang</th>
                                    <th>Kode Gedung</th>
                                    <th>Nama Gedung</th>
                                    <th>Kode Gudang</th>
                                    <th>Nama Gudang</th>
                                    <th>Kode Blok</th>
                                    <th>Nama Blok</th>
                                    <th>Kode Lokasi</th>
                                    <th>Nama Lokasi</th>

                                    {{-- identity --}}
                                    <th>User Create</th>
                                    <th>NIP User Create</th>
                                    <th>Nama User Create</th>
                                    <th>User Update</th>
                                    <th>NIP User Update</th>
                                    <th>Nama User Update</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>UID Pindah</th>
                                    <th>UID Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataTransaksiPindahDetail as $index => $value)
                                    <tr>
                                        <th><center>{{ $index + 1 }}</center></th>
                                        <th>{{ $value->kode_pindah }}</th>
                                        <th>{{ $value->stok }}</th>
                                        <th>{!! $value->ket !!}</th>
                                        <th>{{ $value->norut }}</th>
                                        <th>{{ $value->kode_barang }}</th>
                                        <th>{{ $value->nama_barang }}</th>
                                        <th>{{ $value->lokasi_sekarang }}</th>
                                        <th>{{ $value->kode_gedung }}</th>
                                        <th>{{ $value->nama_gedung }}</th>
                                        <th>{{ $value->kode_gudang }}</th>
                                        <th>{{ $value->nama_gudang }}</th>
                                        <th>{{ $value->kode_blok }}</th>
                                        <th>{{ $value->nama_blok }}</th>
                                        <th>{{ $value->kode_lokasi }}</th>
                                        <th>{{ $value->nama_lokasi }}</th>

                                        {{-- identity --}}
                                        <th>{{ $value->user_create }}</th>
                                        <th>{{ $value->nip_user_create }}</th>
                                        <th>{{ $value->nama_user_create }}</th>
                                        <th>{{ $value->user_update }}</th>
                                        <th>{{ $value->nip_user_update }}</th>
                                        <th>{{ $value->nama_user_update }}</th>
                                        <th>{{ $value->created_at }}</th>
                                        <th>{{ $value->updated_at }}</th>
                                        <th>{{ $value->uid }}</th>
                                        <th>{{ $value->uid_detail }}</th>
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
                klass: { buttonClear: 'd-none' },
            })
        </script>
        <script>
            $(document).ready(function() {
                $('.single-select').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });

                //Default data table
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

                                // Set the header cell to contain the input element
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
                                        '({search})'; //$(this).parents('th').find('select').val();

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
        <script>
            $(document).ready(function() {
                //Default data table
                $('#table-utama2 thead tr')
                    .clone(true)
                    .addClass('filters-table2')
                    .appendTo('#table-utama2 thead');
                var table = $('#table-utama2').DataTable({
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

                                // Set the header cell to contain the input element
                                var cell = $('.filters-table2 th').eq(
                                    $(api.column(colIdx).header()).index()
                                );
                                var title = $(cell).text();
                                $(cell).html('<input class="form-control form-control-sm" type="text" placeholder="' +
                                    title + '..." />');

                                // On every keypress in this input
                                $(
                                        'input',
                                        $('.filters-table2 th').eq($(api.column(colIdx).header()).index())
                                    )
                                    .off('keyup change')
                                    .on('change', function(e) {
                                        // Get the search value
                                        $(this).attr('title', $(this).val());
                                        var regexr =
                                        '({search})'; //$(this).parents('th').find('select').val();

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
                table.buttons().container().appendTo('#table-utama2_wrapper .col-md-6:eq(0)');
            });
        </script>
    @endsection
