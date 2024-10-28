@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Form Pindah Bahan')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tambah</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('transaksi.moving.index') }}">Pindah</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container" id="app">
    <div class="row">
        @if (\Session::has('error'))
            <div class="alert alert-danger border-0 bg-danger fade show">
                <div class="text-white">{!! \Session::get('error') !!}</div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('transaksi.moving.proses-add') }}" ref="mainForm" @submit.prevent="onSubmitCancel()">
                    @csrf

                    {{-- GRID SYSTEM FORM --}}
                    {{-- https://getbootstrap.com/docs/4.0/layout/grid/#equal-width --}}
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Keterangan:</label>
                            <textarea name="keterangan" id="keterangan" class="form-control form-control-sm" rows="3" placeholder="Masukkan Keterangan" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 text-end">
                            <button class="btn btn-success btn-sm" type="button" @click="addRow()"><i class="bx bx-plus me-1"></i>Tambah Pindah Bahan</button>
                        </div>
                    </div>
                    <div class="row mb-3" v-for="(x, k) in listStok" :key="x">
                        <div class="align-self-center">
                            <button class="btn btn-danger btn-sm" type="button" @click="removeRow(k)">x</button>
                        </div>
                        <div class="col-2">
                            <div class="select2-sm">
                                <label class="form-label">Nama Bahan:</label>
                                <select class="single-select" name="barang[]" :id="`barang${x}`" onchange="apa()" required>
                                    <option value="" selected disabled>-- Pilih Bahan --</option>
                                    @foreach ($dataBarang as $nomor => $value)
                                        <option value="{{ $value['id_barang'] }}">{{ $value['nama_barang'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <label class="form-label">Jumlah Dipindah:</label>
                            <input class="form-control form-control-sm" type="number" name="stok[]" :id="`stok${x}`" placeholder="Masukkan Jumlah Bahan Dipindah (minimal 1) | Contoh: 3, 5, 7" v-model="stok[k]" min="1">
                        </div>
                        <div class="col-2">
                            <div class="select2-sm">
                                <label class="form-label">Gedung:</label>
                                <select class="single-select" name="gedung[]" :id="`gedung${x}`" required>
                                    <option value="" selected disabled>-- Pilih Gedung --</option>
                                    @foreach ($dataGedung as $nomor => $value)
                                        <option v-if="barang[k] != ''" value="{{ $value['id_gedung'] }}">{{ $value['nama_gedung'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="select2-sm">
                                <label class="form-label">Gudang:</label>
                                <select class="single-select" name="gudang[]" :id="`gudang${x}`" required>
                                    <option value="" selected disabled>-- Pilih Gudang --</option>
                                    @foreach ($dataGudang as $nomor => $value)
                                        <option v-if="gedung[k] == {{$value['id_gedung']}}" value="{{$value['id_gudang']}}">{{$value['nama_gudang']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="select2-sm">
                                <label class="form-label">Blok:</label>
                                <select class="single-select" name="blok[]" :id="`blok${x}`" required>
                                    <option value="" selected disabled>-- Pilih Blok --</option>
                                    @foreach ($dataBlok as $nomor => $value)
                                        <option v-if="gudang[k] == {{ $value['id_gudang'] }}" value="{{ $value['id_blok'] }}">{{ $value['nama_blok'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="select2-sm">
                                <label class="form-label">Lokasi:</label>
                                <select class="single-select" name="lokasi[]" :id="`lokasi${x}`" required>
                                    <option value="" selected disabled>-- Pilih Lokasi --</option>
                                    @foreach ($dataLokasi as $nomor => $value)
                                        <option v-if="blok[k] == {{ $value['id_blok'] }}" value="{{ $value['id_lokasi'] }}">{{ $value['nama_lokasi'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <hr>
                        </div>
                    </div>
                    {{-- [END] GRID SYSTEM FORM --}}

                    {{-- ACTION FORM --}}
                    <div class="row justify-content-center">
                        <div class="col-8 text-center">
                            <a href="{{ route('transaksi.moving.index') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-x me-1"></i>Batal</a>
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
    const { createApp, watch } = Vue
    createApp({
    delimiters: ['[[', ']]'],
    data() {
      return {
        message: 'Hello Vue!',
        listStok: [],
        barang: [],
        gudang: [],
        gedung: [],
        blok: [],
        lokasi: [],
        stok: [],
      }
    },
    methods: {
        initSelect2() {
            this.$nextTick()
            this.$nextTick()
            setTimeout(() => {
                for(let i = 0; i < this.listStok.length; i++) {
                    try {
                        $(`#barang${this.listStok[i]}`).select2('destroy')
                        $(`#gedung${this.listStok[i]}`).select2('destroy')
                        $(`#gudang${this.listStok[i]}`).select2('destroy')
                        $(`#blok${this.listStok[i]}`).select2('destroy')
                        $(`#lokasi${this.listStok[i]}`).select2('destroy')
                    } catch (e) {
                        console.log('#barang'+i)
                        console.log(e, 'barin1')
                    }
                    try {
                        $(`#barang${this.listStok[i]}`).select2({
                            theme: 'bootstrap4',
                            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                            placeholder: $(this).data('placeholder'),
                            allowClear: Boolean($(this).data('allow-clear')),
                        }).on("change", (e) => {
                            this.changeBarang(e, i)
                        });
                        $(`#gedung${this.listStok[i]}`).select2({
                            theme: 'bootstrap4',
                            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                            placeholder: $(this).data('placeholder'),
                            allowClear: Boolean($(this).data('allow-clear')),
                        }).on("change", (e) => {
                            this.changeGedung(e, i)
                        });
                        $(`#gudang${this.listStok[i]}`).select2({
                            theme: 'bootstrap4',
                            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                            placeholder: $(this).data('placeholder'),
                            allowClear: Boolean($(this).data('allow-clear')),
                        }).on("change", (e) => {
                            this.changeGudang(e, i)
                        });
                        $(`#blok${this.listStok[i]}`).select2({
                            theme: 'bootstrap4',
                            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                            placeholder: $(this).data('placeholder'),
                            allowClear: Boolean($(this).data('allow-clear')),
                        }).on("change", (e) => {
                            this.changeBlok(e, i)
                        });
                        $(`#lokasi${this.listStok[i]}`).select2({
                            theme: 'bootstrap4',
                            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                            placeholder: $(this).data('placeholder'),
                            allowClear: Boolean($(this).data('allow-clear')),
                        }).on("change", (e) => {
                            this.changeLokasi(e, i)
                        });
                    } catch (e) {
                        console.log(e, 'barin2')
                    }
                }
            }, 0);
        },
        addRow() {
            console.log(this.stok, 'stoknya0')
            this.listStok.push(Math.random().toString().replaceAll('.', ''))
            this.barang.push('')
            this.gudang.push('')
            this.gedung.push('')
            this.blok.push('')
            this.lokasi.push('')
            this.stok.push('0')
            this.initSelect2()
        },
        removeRow(index) {
            this.listStok.splice(index, 1)
            this.barang.splice(index, 1)
            this.gudang.splice(index, 1)
            this.gedung.splice(index, 1)
            this.blok.splice(index, 1)
            this.lokasi.splice(index, 1)
            this.$nextTick()
            this.initSelect2()
        },

        changeBarang(x, i) {
            console.log(x, 'ini barang x')
            this.barang[i] = x.target.value
            this.gedung[i] = ''
            this.gudang[i] = ''
            this.blok[i] = ''
            this.lokasi[i] = ''
            this.stok[i] = '0'
        },
        changeGedung(x, i) {
            console.log(x.target.value, 'ini gedung x')
            this.gedung[i] = x.target.value
            this.gudang[i] = ''
            this.blok[i] = ''
            this.lokasi[i] = ''
        },
        changeGudang(x, i) {
            console.log(x.target.value, 'ini gudang x')
            this.gudang[i] = x.target.value
            this.blok[i] = ''
            this.lokasi[i] = ''
        },
        changeBlok(x, i) {
            console.log(x.target.value, 'ini blok x')
            this.blok[i] = x.target.value
            this.lokasi[i] = ''
        },
        changeLokasi(x, i) {
            console.log(x, 'ini lokasi x')
            this.lokasi[i] = x.target.value
        },
        onSubmitCancel(evt) {
            console.log(evt)
            // evt.preventDefault()
            // this.$refs.mainForm.preventDefault();
            if(this.listStok.length > 0) {
                this.$refs.mainForm.submit()
                // evt.submit()
                return true
            }
            alert('Silahkan Add Row Dahulu.!')
            return false
        },
        cekFirst(evt) {
            console.log(evt, 'eventnya...')
            console.log(this.listStok.length, 'lstok...')
            if(this.listStok.length > 0) {
                this.$refs.mainForm.submit()
                return true
            }
            alert('Silahkan Add Row Dahulu.!')
            return false
        }
    }
  }).mount('#app')
    $("input[type='number']").on("input", function() {
        var nonNumReg = /[^0-9]/g
        $(this).val($(this).val().replace(nonNumReg, ''));
    });

    function apa () {
        console.log(11)
    }
</script>
@endsection
