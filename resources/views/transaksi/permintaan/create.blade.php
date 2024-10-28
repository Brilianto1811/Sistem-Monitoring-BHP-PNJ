@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Form Permintaan BHP')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tambah</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('transaksi.permintaan.index') }}">Permintaan BHP</a>
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
                <form id="mainForm" ref="mainForm" method="POST" action="{{ route('transaksi.permintaan.proses-add') }}" @submit.prevent="onSubmitCancel()">
                    @csrf
                    {{-- GRID SYSTEM FORM --}}
                    {{-- https://getbootstrap.com/docs/4.0/layout/grid/#equal-width --}}
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">NIM:</label>
                            <input type="text" name="nim" id="nim" class="form-control form-control-sm" placeholder="Masukkan Nomor Induk Mahasiswa (NIM)" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Nama Mahasiswa:</label>
                            <input type="text" name="nama" id="nama" class="form-control form-control-sm" placeholder="Masukkan Nama Lengkap Mahasiswa" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Jurusan:</label>
                                <select class="single-select" name="jurusan" id="jurusan" required>
                                    <option value="" disabled>-- Pilih Jurusan --</option>
                                    @foreach ($dataJurusan as $nomor => $value)
                                        <option value="{{ $value['id_jurusan'] }}">{{ $value['nama_jurusan'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Program Studi:</label>
                                <select class="single-select" name="prodi" id="prodi" required>
                                    <option value="" disabled>-- Pilih Program Studi --</option>
                                    @foreach ($dataProdi as $nomor => $value)
                                        <option value="{{ $value['id_prodi'] }}">{{ $value['nama_prodi'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Kelas:</label>
                                <select class="single-select" name="kelas" id="kelas" required>
                                    <option value="" disabled>-- Pilih Kelas --</option>
                                    @foreach ($dataKelas as $nomor => $value)
                                        <option value="{{ $value['id_kelas'] }}">{{ $value['nama_kelas'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Informasi Permintaan:</label>
                            <textarea name="info" id="info" class="form-control form-control-sm" rows="4" placeholder="Nama Matkul/Praktik, Nama Kerja, Dosen Instruktur, Tanggal Pemakaian, Lokasi Praktik" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="select2-sm">
                                <label class="form-label">Paket Praktik:</label>
                                <select class="" name="praktek" id="praktek">
                                    <option value="" disabled selected>-- Pilih Paket Praktik --</option>
                                    @foreach ($dataPaketPraktek as $nomor => $value)
                                        <option value="{{ $value['id_praktek'] }}">{{ $value['nama_praktek'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3" v-for="(x, k) in listStok" :key="x">
                        <div class="col-md-1 col-sm-12 col-xs-12 align-self-center">
                            <button class="btn btn-danger btn-sm" type="button" @click="removeRow(k)">x</button>
                            [[ k+1 ]]
                        </div>
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="select2-sm">
                                <label class="form-label">Nama Bahan:</label>
                                <select class="single-select" name="barang[]" :id="`barang${x}`" required>
                                    <option value="" selected disabled>-- Pilih Bahan --</option>
                                    @foreach ($dataBarang as $nomor => $value)
                                        <option value="{{ $value['id_barang'] }}">{{ $value['nama_barang'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <label class="form-label">Jumlah Permintaan:</label>
                            <input class="form-control form-control-sm" type="number" name="stok[]" :id="'stok'+k" placeholder="Masukkan Jumlah Permintaan (minimal 1)" min="1">
                        </div>
                        <div class="row mt-3">
                            <hr>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 text-end">
                            <button class="btn btn-success btn-sm" type="button" @click="addRow()"><i class="bx bx-plus me-1"></i>Tambah BHP</button>
                        </div>
                    </div>
                    {{-- [END] GRID SYSTEM FORM --}}

                    {{-- ACTION FORM --}}
                    <div class="row justify-content-center">
                        <div class="col-5">
                            <a href="{{ route('transaksi.permintaan.index') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-x me-1"></i>Batal</a>
                            {{-- <button type="button" class="btn btn-primary m-1 radius-30 px-5 ml-auto" @click="cekFirst()"><i class="bx bx-link-external me-1"></i>Ajukan Permintaan</button> --}}
                            <button type="submit" class="btn btn-primary m-1 radius-30 px-5 ml-auto"><i class="bx bx-link-external me-1"></i>Ajukan Permintaan</button>
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
    let dataPaket = JSON.parse(`{!! $dataPaketPraktek !!}`)
    let dataPaketDetail = JSON.parse(`{!! $dataPaketPraktekDetail !!}`)

    // -- vue 3 -- \\
    const { createApp } = Vue
    createApp({
    delimiters: ['[[', ']]'],
    data() {
      return {
        message: 'Hello Vue!',
        listStok: []
      }
    },
    methods: {
        initSelect2() {
            this.$nextTick()
            this.$nextTick()
            setTimeout(() => {
                for(let i = 0; i < this.listStok.length; i++) {
                    console.log($(`#barang${this.listStok[i]}`))
                    try {
                        $(`#barang${this.listStok[i]}`).select2('destroy')
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
                        });
                    } catch (e) {
                        console.log(e, 'barin2')
                    }
                }
            }, 0);
        },
        addRow() {
            this.listStok.push(Math.random().toString().replaceAll('.', ''))
            this.initSelect2()
        },
        removeRow(index) {
            this.listStok.splice(index, 1)
            this.$nextTick()
            this.initSelect2()
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
            console.log(this.$refs.mainForm)
            this.$refs.mainForm.preventDefault();
            if(this.listStok.length > 0) {
                this.$refs.mainForm.submit()
                return true
            }
            alert('Silahkan Add Row Dahulu.!')
            return false
        },

        setDataBarang(evt) {
            console.log(evt.target.value)
            this.listStok = []
            this.$nextTick()
            this.$nextTick()
            dataPaketDetail.filter(v => v.id_praktek == evt.target.value).forEach((v, k) => {
                this.addRow()
                this.$nextTick()
                this.$nextTick()
                setTimeout(() => {
                    this.$nextTick()
                    console.log(v.id_barang, v.qty)
                    console.log($(`#stok${k}`))
                    $(`#barang${this.listStok[k]}`).val(v.id_barang).trigger("change");
                    $(`#stok${k}`).val(v.qty).trigger("change")
                    this.$nextTick()
                }, 0)
            });
        }
    },
    mounted() {
        $(`#praktek`).select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        }).on("change", (e) => {
            console.log('ketrigger, ngubah')
            this.setDataBarang(e)
        });
    },
  }).mount('#app')

    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    $("input[type='number']").on("input", function() {
        var nonNumReg = /[^0-9]/g
        $(this).val($(this).val().replace(nonNumReg, ''));
    });

</script>
@endsection
