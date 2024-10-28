@extends('layouts.base-dashboard')
@section('custom-css')
@endsection

@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card radius-15 bg-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="mb-0 text-white">{{ $totalPermintaan }}</h2>
                    </div>
                    <div class="ms-auto font-35 text-white"><i class="bx bx-list-check"></i></div>
                </div>
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Total Permintaan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card radius-15 bg-secondary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="mb-0 text-white">{{ $totalPermintaanPending }}</h2>
                    </div>
                    <div class="ms-auto font-35 text-white"><i class="bx bx-time"></i></div>
                </div>
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Menunggu Permintaan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card radius-15 bg-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="mb-0 text-white">{{ $totalPermintaanDiterima }}</h2>
                    </div>
                    <div class="ms-auto font-35 text-white"><i class="bx bx-check-shield"></i></div>
                </div>
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Permintaan Diterima</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card radius-15 bg-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="mb-0 text-white">{{ $totalPermintaanDitolak }}</h2>
                    </div>
                    <div class="ms-auto font-35 text-white"><i class="bx bx-shield-x"></i></div>
                </div>
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Permintaan Ditolak</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
@endsection
