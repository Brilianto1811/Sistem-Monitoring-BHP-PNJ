<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\MBarang;
use App\Models\MTrxBarangDetail;
use App\Models\MTrxBarangPindahDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class LaporanHistoryController extends Controller
{
    public function laporanHistoryShow(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;

        $dataBarang = MBarang::all();
        if($user_level == 'operator') {
            $dataBarang = MBarang::where('user_id_prodi', '=', $user_id_prodi_login)->get();
        }
        $form_barang = $request->query('barang') ?? null;
        if($form_barang == null || $form_barang == '') {
            // Session::flash('alert-warning', 'Silahkan pilih barang dahulu..'); // kasih pesan warning
            Session::now('alert-warning', 'Silahkan pilih bahan dahulu..'); // kasih pesan warning
            return view('laporan.history.index', ['dataTransaksiDetail' => [], 'dataTransaksiPindahDetail' => [], 'dataBarang' => $dataBarang]);
        }

        $start = Carbon::parse($request->query('date_from_submit')) ?? Carbon::now();
        $end = Carbon::parse($request->query('date_to_submit')) ?? Carbon::now();


        $dataTransaksiDetail = MTrxBarangDetail::leftJoin('tbl_trx_barang as h1', 'tbl_trx_barang_detail.id_trx', '=', 'h1.id_trx')
                                                ->leftJoin('tbl_mahasiswa as mhs', 'h1.id_mahasiswa', '=', 'mhs.id_mahasiswa')
                                                ->leftJoin('tbl_permintaan_barang as req', 'h1.trxfrom', '=', 'req.id_permintaan')
                                                ->leftJoin('tbl_login as log1', 'h1.user_create', '=', 'log1.userid')
                                                ->leftJoin('tbl_login as log2', 'h1.user_update', '=', 'log2.userid')

                                                ->select('h1.*', 'tbl_trx_barang_detail.kode_barang', 'tbl_trx_barang_detail.nama_barang', 'tbl_trx_barang_detail.stok', 'tbl_trx_barang_detail.norut', 'tbl_trx_barang_detail.uid as uid_detail')
                                                ->addSelect('mhs.nim', 'mhs.nama_mahasiswa')
                                                ->addSelect('req.kode_permintaan', 'req.informasi')
                                                ->addSelect('log1.nip as nip_user_create', 'log1.nama_user as nama_user_create')
                                                ->addSelect('log2.nip as nip_user_update', 'log2.nama_user as nama_user_update')
        ;
        $dataTransaksiPindahDetail = MTrxBarangPindahDetail::leftJoin('tbl_trx_barang_pindah as h1', 'tbl_trx_barang_pindah_detail.id_pindah', '=', 'h1.id_pindah')
                                                            ->leftJoin('tbl_gedung as ge', 'tbl_trx_barang_pindah_detail.id_gedung', '=', 'ge.id_gedung')
                                                            ->leftJoin('tbl_gudang as gu', 'tbl_trx_barang_pindah_detail.id_gudang', '=', 'gu.id_gudang')
                                                            ->leftJoin('tbl_blok as bl', 'tbl_trx_barang_pindah_detail.id_blok', '=', 'bl.id_blok')
                                                            ->leftJoin('tbl_lokasi as lo', 'tbl_trx_barang_pindah_detail.id_lokasi', '=', 'lo.id_lokasi')

                                                            ->leftJoin('tbl_login as log1', 'h1.user_create', '=', 'log1.userid')
                                                            ->leftJoin('tbl_login as log2', 'h1.user_update', '=', 'log2.userid')

                                                            ->select('h1.*', 'tbl_trx_barang_pindah_detail.kode_barang', 'tbl_trx_barang_pindah_detail.nama_barang', 'tbl_trx_barang_pindah_detail.stok', 'tbl_trx_barang_pindah_detail.norut', 'tbl_trx_barang_pindah_detail.lokasi_sekarang', 'tbl_trx_barang_pindah_detail.uid as uid_detail')
                                                            ->addSelect('ge.kode_gedung', 'ge.nama_gedung')
                                                            ->addSelect('gu.kode_gudang', 'gu.nama_gudang')
                                                            ->addSelect('bl.kode_blok', 'bl.nama_blok')
                                                            ->addSelect('lo.kode_lokasi', 'lo.nama_lokasi')

                                                            ->addSelect('log1.nip as nip_user_create', 'log1.nama_user as nama_user_create')
                                                            ->addSelect('log2.nip as nip_user_update', 'log2.nama_user as nama_user_update')
        ;

        $dataTransaksiDetail->whereDate('h1.created_at', '>=', $start);
        $dataTransaksiDetail->whereDate('h1.created_at', '<=', $end);
        $dataTransaksiDetail->where('tbl_trx_barang_detail.id_barang', '=', $form_barang);

        $dataTransaksiPindahDetail->whereDate('h1.created_at', '>=', $start);
        $dataTransaksiPindahDetail->whereDate('h1.created_at', '<=', $end);
        $dataTransaksiPindahDetail->where('tbl_trx_barang_pindah_detail.id_barang', '=', $form_barang);

        if($user_level == 'operator') {
            $dataTransaksiDetail->where('tbl_trx_barang_detail.user_id_prodi', '=', $user_id_prodi_login);
            $dataTransaksiPindahDetail->where('tbl_trx_barang_pindah_detail.user_id_prodi', '=', $user_id_prodi_login);
        }

        $dataTransaksiDetail->orderByDesc('tbl_trx_barang_detail.created_at');
        $dataTransaksiPindahDetail->orderByDesc('tbl_trx_barang_pindah_detail.created_at');

        $dataTransaksiDetail = $dataTransaksiDetail->get();
        $dataTransaksiPindahDetail = $dataTransaksiPindahDetail->get();
        return view('laporan.history.index', ['dataTransaksiDetail' => $dataTransaksiDetail, 'dataTransaksiPindahDetail' => $dataTransaksiPindahDetail, 'dataBarang' => $dataBarang]);
    }
}
