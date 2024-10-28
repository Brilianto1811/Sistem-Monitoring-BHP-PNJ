<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MBarang;
use App\Models\MBarangDelete;
use App\Models\MGedung;
use App\Models\MGudang;
use App\Models\MBlok;
use App\Models\MLokasi;
use Illuminate\Http\Request;
use App\Models\MTrxBarang;
use App\Models\MTrxBarangDetail;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;

class BarangController extends Controller
{
    //
    public function barangShow(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;

        $dataBarang = MBarang::all();
        if($user_level == 'operator') {
            $dataBarang = MBarang::where('user_id_prodi', '=', $user_id_prodi_login)->get();
        }
        return view('master.barang.index', ['dataBarang' => $dataBarang]);
    }
    public function barangShowCreate(Request $request)
    {
        # code...
        $dataLokasi = MLokasi::all();
        return view('master.barang.create', ['dataLokasi' => $dataLokasi]);
    }
    public function barangShowEdit(Request $request)
    {
        // -- ambil dari request id
        $form_id_barang = $request->query('id_barang', '');

        $dataBarang = MBarang::findOrFail($form_id_barang);
        $dataLokasi = MLokasi::all();
        return view('master.barang.edit', ['dataBarang' => $dataBarang, 'dataLokasi' => $dataLokasi]);
    }
    public function barangShowDetail(Request $request)
    {
        // -- ambil dari request id
        $form_id_barang = $request->query('id_barang', '');

        // $dataBarang = MBarang::findOrFail($form_id_barang);
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

        $dataBarang = $dataBarang->where('id_barang', $form_id_barang)->latest()->first();
        // dd($dataBarang);
        return view('master.barang.detail', ['dataBarang' => $dataBarang]);
    }
    public function barangProsesAdd(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_kode_prodi_login = auth()->guard('karyawan')->user()->user_kode_prodi ?? null;
        $user_nama_prodi_login = auth()->guard('karyawan')->user()->user_nama_prodi ?? null;

        // -- ambil dari form
        $form_kode_barang = $request->post('kode_barang');
        $form_nama_barang = $request->post('nama_barang');
        $form_unit = $request->post('unit');
        $form_stok_awal = $request->post('stok_awal');
        $form_lokasi_sekarang = $request->post('lokasi_sekarang');
        $form_status_barang = $request->post('status_barang');

        $dataLokasi = MLokasi::find($form_lokasi_sekarang);

        // -- set ke table
        $tblBarang = new MBarang();
        $tblBarang->kode_barang = $form_kode_barang;
        $tblBarang->nama_barang = $form_nama_barang;
        $tblBarang->unit = $form_unit;
        $tblBarang->stok_awal = $form_stok_awal;
        $tblBarang->stok_sebelumnya = 0;
        $tblBarang->stok_sekarang = $form_stok_awal;
        $tblBarang->lokasi_awal = $dataLokasi->nama_lokasi;
        // $tblBarang->lokasi_sebelumnya = '';
        $tblBarang->lokasi_sekarang = $dataLokasi->nama_lokasi;
        $tblBarang->status_barang = $form_status_barang;
        // $tblBarang->status_barang = 'aktif';
        $tblBarang->id_gedung_create = $dataLokasi->id_gedung;
        $tblBarang->id_gudang_create = $dataLokasi->id_gudang;
        $tblBarang->id_blok_create = $dataLokasi->id_blok;
        $tblBarang->id_lokasi_create = $dataLokasi->id_lokasi;
        $tblBarang->id_gedung_now = $dataLokasi->id_gedung;
        $tblBarang->id_gudang_now = $dataLokasi->id_gudang;
        $tblBarang->id_blok_now = $dataLokasi->id_blok;
        $tblBarang->id_lokasi_now = $dataLokasi->id_lokasi;
        // $tblBarang->id_gedung_old = '';
        // $tblBarang->id_gudang_old = '';
        // $tblBarang->id_blok_old = '';
        // $tblBarang->id_lokasi_old = '';

        $tblBarang->user_id_prodi = $user_id_prodi_login;
        $tblBarang->user_kode_prodi = $user_kode_prodi_login;
        $tblBarang->user_nama_prodi = $user_nama_prodi_login;

        $tblBarang->user_create = $userid_login;
        // $tblBarang->user_update = '';
        $tblBarang->save(); // doing save here..

        // -- BUAT TRX [CREATE] -- \\
        $uuidTrx = Uuid::uuid4()->toString();
        $dateKodeTrx = Carbon::now()->format('YmdHisu');
        $tblTransaksi = new MTrxBarang();
        $tblTransaksi->kode_trx = 'CB#'.$dateKodeTrx;
        $tblTransaksi->tipe_trx = 'CREATE';
        $tblTransaksi->ket = 'CREATE BARANG #'.$tblBarang->id_barang.' UID: '.$tblBarang->uid;
        $tblTransaksi->user_create = $userid_login;
        // $tblTransaksi->user_update = ;
        $tblTransaksi->uid = $uuidTrx;
        $tblTransaksi->save();

        $tblTransaksiDetail = new MTrxBarangDetail();
        $tblTransaksiDetail->id_trx = $tblTransaksi->id_trx;
        $tblTransaksiDetail->kode_trx = $tblTransaksi->kode_trx;
        $tblTransaksiDetail->norut = 1;
        $tblTransaksiDetail->id_barang = $tblBarang->id_barang;
        $tblTransaksiDetail->kode_barang = $form_kode_barang;
        $tblTransaksiDetail->nama_barang = $tblBarang->nama_barang;
        $tblTransaksiDetail->stok = $form_stok_awal;
        $tblTransaksiDetail->save();

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('master.barang.index');
    }
    public function barangProsesEdit(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_kode_prodi_login = auth()->guard('karyawan')->user()->user_kode_prodi ?? null;
        $user_nama_prodi_login = auth()->guard('karyawan')->user()->user_nama_prodi ?? null;

        // -- ambil dari form
        $form_oldid = $request->post('oldid');
        $form_kode_barang = $request->post('kode_barang');
        $form_nama_barang = $request->post('nama_barang');
        $form_unit = $request->post('unit');
        $form_stok_awal = $request->post('stok_awal');
        $form_lokasi_sekarang = $request->post('lokasi_sekarang');
        $form_status_barang = $request->post('status_barang');

        $dataLokasi = MLokasi::find($form_lokasi_sekarang);
        $dataBarang = MBarang::find($form_oldid);

        // -- set ke table
        $tblBarang = MBarang::findOrFail($form_oldid);
        $tblBarang->kode_barang = $form_kode_barang;
        $tblBarang->nama_barang = $form_nama_barang;
        $tblBarang->unit = $form_unit;
        // $tblBarang->stok_awal = $form_stok_awal;
        // jika stok dari form itu beda dengan stok sekarang, maka update stok sebelumnya
        if($form_stok_awal != $dataBarang->stok_sekarang) {
            $tblBarang->stok_sebelumnya = $dataBarang->stok_sekarang;
        }
        $tblBarang->stok_sekarang = $form_stok_awal;
        // $tblBarang->lokasi_awal = $dataLokasi->id_lokasi;
        if ($form_lokasi_sekarang != $dataBarang->id_lokasi_now) {
            $tblBarang->lokasi_sebelumnya = $dataBarang->lokasi_sekarang;
            $tblBarang->id_gedung_old = $dataBarang->id_gedung_now;
            $tblBarang->id_gudang_old = $dataBarang->id_gudang_now;
            $tblBarang->id_blok_old = $dataBarang->id_blok_now;
            $tblBarang->id_lokasi_old = $dataBarang->id_lokasi_now;
        }
        $tblBarang->lokasi_sekarang = $dataLokasi->nama_lokasi;
        $tblBarang->status_barang = $form_status_barang;
        // $tblBarang->status_barang = 'aktif';
        // $tblBarang->id_gedung_create = $dataLokasi->id_gedung;
        // $tblBarang->id_gudang_create = $dataLokasi->id_gudang;
        // $tblBarang->id_blok_create = $dataLokasi->id_blok;
        // $tblBarang->id_lokasi_create = $dataLokasi->id_lokasi;
        $tblBarang->id_gedung_now = $dataLokasi->id_gedung;
        $tblBarang->id_gudang_now = $dataLokasi->id_gudang;
        $tblBarang->id_blok_now = $dataLokasi->id_blok;
        $tblBarang->id_lokasi_now = $dataLokasi->id_lokasi;

        $tblBarang->user_id_prodi = $user_id_prodi_login;
        $tblBarang->user_kode_prodi = $user_kode_prodi_login;
        $tblBarang->user_nama_prodi = $user_nama_prodi_login;

        // $tblBarang->user_create = $userid_login;
        $tblBarang->user_update = $userid_login;
        $tblBarang->save(); // doing save here..

        // -- BUAT TRX [UPDATE] -- \\
        $uuidTrx = Uuid::uuid4()->toString();
        $tblTransaksi = new MTrxBarang();
        $dateKodeTrx = Carbon::now()->format('YmdHisu');
        $tblTransaksi->kode_trx = 'UB#'.$dateKodeTrx;
        $tblTransaksi->tipe_trx = 'UPDATE';
        $tblTransaksi->ket = 'UPDATE BARANG #'.$tblBarang->id_barang.' UID: '.$tblBarang->uid;
        $tblTransaksi->user_create = $userid_login;
        // $tblTransaksi->user_update = ;
        $tblTransaksi->uid = $uuidTrx;
        $tblTransaksi->save();

        $tblTransaksiDetail = new MTrxBarangDetail();
        $tblTransaksiDetail->id_trx = $tblTransaksi->id_trx;
        $tblTransaksiDetail->kode_trx = $tblTransaksi->kode_trx;
        $tblTransaksiDetail->norut = 1;
        $tblTransaksiDetail->id_barang = $tblBarang->id_barang;
        $tblTransaksiDetail->kode_barang = $form_kode_barang;
        $tblTransaksiDetail->nama_barang = $tblBarang->nama_barang;
        $tblTransaksiDetail->stok = $form_stok_awal;
        $tblTransaksiDetail->save();

        Session::flash('alert-success', 'Success Edit Data'); // kasih pesan success
        return redirect()->route('master.barang.index');
    }
    public function barangProsesDelete(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_oldid = $request->query('id_barang');
        $tblBarang = MBarang::findOrFail($form_oldid);

        $tblGedungCreate = MGedung::find($tblBarang->id_gedung_create);
        $tblGedungNow = MGedung::find($tblBarang->id_gedung_now);
        $tblGedungOld = MGedung::find($tblBarang->id_gedung_old);

        $tblGudangCreate = MGudang::find($tblBarang->id_gudang_create);
        $tblGudangNow = MGudang::find($tblBarang->id_gudang_now);
        $tblGudangOld = MGudang::find($tblBarang->id_gudang_old);

        $tblBlokCreate = MBlok::find($tblBarang->id_blok_create);
        $tblBlokNow = MBlok::find($tblBarang->id_blok_now);
        $tblBlokOld = MBlok::find($tblBarang->id_blok_old);

        $tblLokasiCreate = MLokasi::find($tblBarang->id_lokasi_create);
        $tblLokasiNow = MLokasi::find($tblBarang->id_lokasi_now);
        $tblLokasiOld = MLokasi::find($tblBarang->id_lokasi_old);

        // -- MASUKIN BARANG [DELETE] untuk safety -- \\
        $tblBarangDelete = new MBarangDelete();
        $tblBarangDelete->id_barang = $tblBarang->id_barang;
        $tblBarangDelete->kode_barang = $tblBarang->kode_barang;
        $tblBarangDelete->nama_barang = $tblBarang->nama_barang;
        $tblBarangDelete->unit = $tblBarang->unit;
        $tblBarangDelete->stok_awal = $tblBarang->stok_awal;
        $tblBarangDelete->stok_sebelumnya = $tblBarang->stok_sebelumnya;
        $tblBarangDelete->stok_sekarang = $tblBarang->stok_sekarang;
        $tblBarangDelete->lokasi_awal = $tblBarang->lokasi_awal;
        $tblBarangDelete->lokasi_sebelumnya = $tblBarang->lokasi_sebelumnya;
        $tblBarangDelete->lokasi_sekarang = $tblBarang->lokasi_sekarang;
        $tblBarangDelete->status_barang = $tblBarang->status_barang;

        $tblBarangDelete->id_gedung_create = $tblGedungCreate->id_gedung ?? 0;
        $tblBarangDelete->id_gedung_now = $tblGedungNow->id_gedung ?? 0;
        $tblBarangDelete->id_gedung_old = $tblGedungOld->id_gedung ?? 0;
        $tblBarangDelete->nama_gedung_create = $tblGedungCreate->nama_gedung ?? '';
        $tblBarangDelete->nama_gedung_now = $tblGedungNow->nama_gedung ?? '';
        $tblBarangDelete->nama_gedung_old = $tblGedungOld->nama_gedung ?? '';

        $tblBarangDelete->id_gudang_create = $tblGudangCreate->id_gudang ?? 0;
        $tblBarangDelete->id_gudang_now = $tblGudangNow->id_gudang ?? 0;
        $tblBarangDelete->id_gudang_old = $tblGudangOld->id_gudang ?? 0;
        $tblBarangDelete->nama_gudang_create = $tblGudangCreate->nama_gudang ?? '';
        $tblBarangDelete->nama_gudang_now = $tblGudangNow->nama_gudang ?? '';
        $tblBarangDelete->nama_gudang_old = $tblGudangOld->nama_gudang ?? '';

        $tblBarangDelete->id_blok_create = $tblBlokCreate->id_blok ?? 0;
        $tblBarangDelete->id_blok_now = $tblBlokNow->id_blok ?? 0;
        $tblBarangDelete->id_blok_old = $tblBlokOld->id_blok ?? 0;
        $tblBarangDelete->nama_blok_create = $tblBlokCreate->nama_blok ?? '';
        $tblBarangDelete->nama_blok_now = $tblBlokNow->nama_blok ?? '';
        $tblBarangDelete->nama_blok_old = $tblBlokOld->nama_blok ?? '';

        $tblBarangDelete->id_lokasi_create = $tblLokasiCreate->id_lokasi ?? 0;
        $tblBarangDelete->id_lokasi_now = $tblLokasiNow->id_lokasi ?? 0;
        $tblBarangDelete->id_lokasi_old = $tblLokasiOld->id_lokasi ?? 0;
        $tblBarangDelete->nama_lokasi_create = $tblLokasiCreate->nama_lokasi ?? '';
        $tblBarangDelete->nama_lokasi_now = $tblLokasiNow->nama_lokasi ?? '';
        $tblBarangDelete->nama_lokasi_old = $tblLokasiOld->nama_lokasi ?? '';

        $tblBarangDelete->id_trx_last = $tblBarang->id_trx_last;
        $tblBarangDelete->kode_trx_last = $tblBarang->kode_trx_last;
        $tblBarangDelete->tipe_trx_last = $tblBarang->tipe_trx_last;
        $tblBarangDelete->id_trx_move_last = $tblBarang->id_trx_move_last;
        $tblBarangDelete->kode_trx_move_last = $tblBarang->kode_trx_move_last;

        $tblBarangDelete->user_create_last = $tblBarang->user_create ?? '';
        $tblBarangDelete->user_update_last = $tblBarang->user_update ?? '';
        $tblBarangDelete->created_at_last = $tblBarang->created_at ?? '';
        $tblBarangDelete->updated_at_last = $tblBarang->updated_at ?? '';

        $tblBarangDelete->user_create = $userid_login;
        // $tblBarangDelete->user_update = 0;
        $tblBarangDelete->save();

        // -- BUAT TRX [DELETE] -- \\
        $uuidTrx = Uuid::uuid4()->toString();
        $dateKodeTrx = Carbon::now()->format('YmdHisu');
        $tblTransaksi = new MTrxBarang();
        $tblTransaksi->kode_trx = 'DB#'.$dateKodeTrx;
        $tblTransaksi->tipe_trx = 'DELETE';
        $tblTransaksi->ket = 'DELETE BARANG #'.$tblBarang->id_barang.' UID: '.$tblBarang->uid;
        $tblTransaksi->user_create = $userid_login;
        // $tblTransaksi->user_update = ;
        $tblTransaksi->uid = $uuidTrx;
        $tblTransaksi->save();

        $tblTransaksiDetail = new MTrxBarangDetail();
        $tblTransaksiDetail->id_trx = $tblTransaksi->id_trx;
        $tblTransaksiDetail->kode_trx = $tblTransaksi->kode_trx;
        $tblTransaksiDetail->norut = 1;
        $tblTransaksiDetail->id_barang = $tblBarang->id_barang;
        $tblTransaksiDetail->kode_barang = $tblBarang->kode_barang;
        $tblTransaksiDetail->nama_barang = $tblBarang->nama_barang;
        $tblTransaksiDetail->stok = $tblBarang->stok_sekarang;
        $tblTransaksiDetail->save();

        $tblBarang->delete();

        Session::flash('alert-success', 'Success Delete Data'); // kasih pesan success
        return redirect()->route('master.barang.index');
    }
}
