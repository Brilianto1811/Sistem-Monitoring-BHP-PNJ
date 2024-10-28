@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Form Stok Out Bahan')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tambah</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('transaksi.stok.out.index') }}">Stok Out</a>
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
                {{-- ubah ini --}}
                {{-- numpang api dulu hehe --}}
                <form ref="mainForm" method="POST" action="{{ route('transaksi.stok.out.proses-add') }}" @submit.prevent="onSubmitCancel()">
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
                            <button class="btn btn-success btn-sm" type="button" @click="addRow()"><i class="bx bx-plus me-1"></i>Tambah Bahan Keluar</button>
                        </div>
                    </div>
                    <div class="row mb-3" v-for="(x, k) in listStok" :key="x">
                        <div class="col-1 align-self-center">
                            <button class="btn btn-danger btn-sm" type="button" @click="removeRow(k)">x</button>
                        </div>
                        <div class="col-5">
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
                        <div class="col-6">
                            <label class="form-label">Jumlah Stok Out:</label>
                            <input class="form-control form-control-sm" type="number" name="stok[]" :id="'stok'+k" placeholder="Masukkan Jumlah Stok Bahan Keluar (minimal 1) | Contoh: 3, 5, 7" min="0" required>
                        </div>
                        <div class="row mt-3">
                            <hr>
                        </div>
                    </div>
                    {{-- [END] GRID SYSTEM FORM --}}

                    {{-- ACTION FORM --}}
                    <div class="row justify-content-center">
                        <div class="col-8 text-center">
                            <a href="{{ route('transaksi.stok.out.index') }}" class="btn btn-secondary m-1 radius-30 px-5"><i class="bx bx-x me-1"></i>Batal</a>
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
</script>
@endsection
