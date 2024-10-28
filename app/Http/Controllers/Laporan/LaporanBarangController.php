<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\MBarang;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanBarangController extends Controller
{
    public function laporanBarangShow(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;

                            // gedung
        $dataBarang = MBarang::leftJoin('tbl_gedung as ge1', 'tbl_barang.id_gedung_create', '=', 'ge1.id_gedung')
                            ->leftJoin('tbl_gedung as ge2', 'tbl_barang.id_gedung_now', '=', 'ge2.id_gedung')
                            ->leftJoin('tbl_gedung as ge3', 'tbl_barang.id_gedung_old', '=', 'ge3.id_gedung')

                            // gudang
                            ->leftJoin('tbl_gudang as gu1', 'tbl_barang.id_gudang_create', '=', 'gu1.id_gudang')
                            ->leftJoin('tbl_gudang as gu2', 'tbl_barang.id_gudang_now', '=', 'gu2.id_gudang')
                            ->leftJoin('tbl_gudang as gu3', 'tbl_barang.id_gudang_old', '=', 'gu3.id_gudang')

                            // blok
                            ->leftJoin('tbl_blok as bl1', 'tbl_barang.id_blok_create', '=', 'bl1.id_blok')
                            ->leftJoin('tbl_blok as bl2', 'tbl_barang.id_blok_now', '=', 'bl2.id_blok')
                            ->leftJoin('tbl_blok as bl3', 'tbl_barang.id_blok_old', '=', 'bl3.id_blok')

                            // lokasi
                            ->leftJoin('tbl_lokasi as lo1', 'tbl_barang.id_lokasi_create', '=', 'lo1.id_lokasi')
                            ->leftJoin('tbl_lokasi as lo2', 'tbl_barang.id_lokasi_now', '=', 'lo2.id_lokasi')
                            ->leftJoin('tbl_lokasi as lo3', 'tbl_barang.id_lokasi_old', '=', 'lo3.id_lokasi')

                            // user
                            ->leftJoin('tbl_login as lg1', 'tbl_barang.user_create', '=', 'lg1.userid')
                            ->leftJoin('tbl_login as lg2', 'tbl_barang.user_update', '=', 'lg2.userid')

                            ->select('tbl_barang.*')
                            // gedung
                            ->addSelect('ge1.kode_gedung as kode_gedung_create', 'ge1.nama_gedung as nama_gedung_create')
                            ->addSelect('ge2.kode_gedung as kode_gedung_now', 'ge2.nama_gedung as nama_gedung_now')
                            ->addSelect('ge3.kode_gedung as kode_gedung_old', 'ge3.nama_gedung as nama_gedung_old')

                            // gudang
                            ->addSelect('gu1.kode_gudang as kode_gudang_create', 'gu1.nama_gudang as nama_gudang_create')
                            ->addSelect('gu2.kode_gudang as kode_gudang_now', 'gu2.nama_gudang as nama_gudang_now')
                            ->addSelect('gu3.kode_gudang as kode_gudang_old', 'gu3.nama_gudang as nama_gudang_old')

                            // blok
                            ->addSelect('bl1.kode_blok as kode_blok_create', 'bl1.nama_blok as nama_blok_create')
                            ->addSelect('bl2.kode_blok as kode_blok_now', 'bl2.nama_blok as nama_blok_now')
                            ->addSelect('bl3.kode_blok as kode_blok_old', 'bl3.nama_blok as nama_blok_old')

                            // lokasi
                            ->addSelect('lo1.kode_lokasi as kode_lokasi_create', 'lo1.nama_lokasi as nama_lokasi_create')
                            ->addSelect('lo2.kode_lokasi as kode_lokasi_now', 'lo2.nama_lokasi as nama_lokasi_now')
                            ->addSelect('lo3.kode_lokasi as kode_lokasi_old', 'lo3.nama_lokasi as nama_lokasi_old')

                            // user
                            ->addSelect('lg1.nip as nip_user_create', 'lg1.nama_user as nama_user_create')
                            ->addSelect('lg2.nip as nip_user_update', 'lg2.nama_user as nama_user_update');

        $start = Carbon::parse($request->query('date_from_submit')) ?? Carbon::now();
        $end = Carbon::parse($request->query('date_to_submit')) ?? Carbon::now();

        $dataBarang->whereDate('tbl_barang.created_at', '>=', $start);
        $dataBarang->whereDate('tbl_barang.created_at', '<=', $end);

        if($user_level == 'operator') {
            $dataBarang->where('tbl_barang.user_id_prodi', '=', $user_id_prodi_login);
        }

        $dataBarang->orderByDesc('created_at');

        $dataBarang = $dataBarang->get();
        return view('laporan.barang.index', ['dataBarang' => $dataBarang]);
    }
}
