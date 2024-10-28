@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Form Tambah Lokasi')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tambah</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('master.lokasi.index') }}">Lokasi</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container" id="app">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('master.lokasi.proses-add') }}">
                        @csrf

                        {{-- GRID SYSTEM FORM --}}
                        {{-- https://getbootstrap.com/docs/4.0/layout/grid/#equal-width --}}
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="select2-sm">
                                    <label class="form-label">Nama Gedung:</label>
                                    <select class="single-select" name="id_gedung" id="id_gedung">
                                        <option value="" selected disabled>-- Pilih Gedung --</option>
                                        @foreach ($dataGedung as $nomor => $value)
                                            <option value="{{ $value['id_gedung'] }}">{{ $value['nama_gedung'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="select2-sm">
                                    <label class="form-label">Nama Gudang:</label>
                                    <select class="single-select" name="id_gudang" id="id_gudang">
                                        <option value="" selected disabled>-- Pilih Gudang --</option>
                                        @foreach ($dataGudang as $nomor => $value)
                                            <option value="{{ $value['id_gudang'] }}">{{ $value['nama_gudang'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="select2-sm">
                                    <label class="form-label">Nama Blok:</label>
                                    <select class="single-select" name="id_blok" id="id_blok">
                                        <option value="" selected disabled>-- Pilih Blok --</option>
                                        @foreach ($dataBlok as $nomor => $value)
                                            <option value="{{ $value['id_blok'] }}">{{ $value['nama_blok'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label">Kode Lokasi:</label>
                                <input class="form-control form-control-sm" type="text" name="kode_lokasi" id="kode_lokasi" placeholder="Masukkan Kode Lokasi | Contoh: Sk1, Sl2">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label">Nama Lokasi:</label>
                                <input class="form-control form-control-sm" type="text" name="nama_lokasi" id="nama_lokasi" placeholder="Masukkan Nama Lokasi | Contoh: Sekat 1, Slot 2">
                            </div>
                        </div>
                        {{-- [END] GRID SYSTEM FORM --}}

                        {{-- ACTION FORM --}}
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <a href="{{ route('master.lokasi.index') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-x me-1"></i>Batal</a>
                                <button type="submit" class="btn btn-primary m-1 radius-30 px-5 ml-auto"><i class="bx bx-save me-1"></i>Simpan</button>
                            </div>
                        </div>
                        {{-- [END] ACTION FORM --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        // -- vue 3 -- \\
        const {
            createApp,
            watch
        } = Vue
        createApp({
            delimiters: ['[[', ']]'],
            data() {
                return {
                    message: 'Hello Vue!',
                    gedung: '',
                    gudang: '',
                    blok: '',
                }
            },
            methods: {
                initSelect2() {
                    this.$nextTick()
                    this.$nextTick()
                    setTimeout(() => {
                        try {
                            // $('#barang'+i).select2('destroy')
                            $(`#gedung`).select2('destroy')
                            $(`#gudang`).select2('destroy')
                            $(`#blok`).select2('destroy')
                        } catch (e) {
                            console.log('#barang')
                            console.log(e, 'barin1')
                        }
                        try {
                            $(`#gedung`).select2({
                                theme: 'bootstrap4',
                                width: $(this).data('width') ? $(this).data('width') : $(this)
                                    .hasClass('w-100') ? '100%' : 'style',
                                placeholder: $(this).data('placeholder'),
                                allowClear: Boolean($(this).data('allow-clear')),
                            }).on("change", (e) => {
                                this.changeGedung(e, -1)
                            });
                            $(`#gudang`).select2({
                                theme: 'bootstrap4',
                                width: $(this).data('width') ? $(this).data('width') : $(this)
                                    .hasClass('w-100') ? '100%' : 'style',
                                placeholder: $(this).data('placeholder'),
                                allowClear: Boolean($(this).data('allow-clear')),
                            }).on("change", (e) => {
                                this.changeGudang(e, -1)
                            });
                            $(`#blok`).select2({
                                theme: 'bootstrap4',
                                width: $(this).data('width') ? $(this).data('width') : $(this)
                                    .hasClass('w-100') ? '100%' : 'style',
                                placeholder: $(this).data('placeholder'),
                                allowClear: Boolean($(this).data('allow-clear')),
                            }).on("change", (e) => {
                                this.changeBlok(e, -1)
                            });
                        } catch (e) {
                            console.log(e, 'barin2')
                        }
                    }, 0);
                },

                changeGedung(x, i) {
                    console.log(x.target.value, 'ini gedung x')
                    this.gedung = x.target.value
                    this.gudang = ''
                    this.blok = ''
                },
                changeGudang(x, i) {
                    console.log(x.target.value, 'ini gudang x')
                    this.gudang = x.target.value
                    this.blok = ''
                },
                changeBlok(x, i) {
                    console.log(x.target.value, 'ini blok x')
                    this.blok = x.target.value
                },
            },
            mounted() {
                this.initSelect2()
            },
        }).mount('#app')

        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
@endsection
