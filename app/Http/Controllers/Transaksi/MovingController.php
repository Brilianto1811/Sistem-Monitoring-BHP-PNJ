<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\MBarang;
use App\Models\MGedung;
use App\Models\MGudang;
use App\Models\MBlok;
use App\Models\MLokasi;
use App\Models\MTrxBarangPindah;
use App\Models\MTrxBarangPindahDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;

class MovingController extends Controller
{
    //
    public function movingShow(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;

        $dataTransaksi = MTrxBarangPindah::where('id_pindah', '>', 0);
        if($user_level == 'operator') {
            $dataTransaksi->where('user_id_prodi', '=', $user_id_prodi_login);
        }
        $dataTransaksi = $dataTransaksi->orderBy('id_pindah', 'DESC')->offset(0)->limit(100)->get();
        // $dataTransaksi= MTrxBarangPindah::orderBy('id_pindah', 'DESC')->offset(0)->limit(100)->get();
        return view('transaksi.moving.index', ['dataTransaksi' => $dataTransaksi]);
    }
    public function movingShowCreate(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;

        $dataGedung = MGedung::all();
        $dataGudang = MGudang::all();
        $dataBlok = MBlok::all();
        $dataLokasi = MLokasi::all();
        $dataBarang = MBarang::all();

        if($user_level == 'operator') {
            $dataBarang = MBarang::where('user_id_prodi', '=', $user_id_prodi_login)->get();
            $dataGedung = MGedung::where('user_id_prodi', '=', $user_id_prodi_login)->get();
            $dataGudang = MGudang::where('user_id_prodi', '=', $user_id_prodi_login)->get();
            $dataBlok = MBlok::where('user_id_prodi', '=', $user_id_prodi_login)->get();
            $dataLokasi = MLokasi::where('user_id_prodi', '=', $user_id_prodi_login)->get();
        }

        $data = [
            'dataGedung' => $dataGedung,
            'dataGudang' => $dataGudang,
            'dataBlok' => $dataBlok,
            'dataLokasi' => $dataLokasi,
            'dataBarang' => $dataBarang
        ];
        return view('transaksi.moving.create', $data);
    }
    public function movingShowEdit(Request $request)
    {
        # code...
        // return view('transaksi.moving.edit');
    }
    public function movingShowDetail(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;
        $form_id_pindah = $request->query('id_pindah', '');

        $dataTransaksi = MTrxBarangPindah::findOrFail($form_id_pindah);
        if($user_level == 'operator') {
            if($dataTransaksi->user_id_prodi != $user_id_prodi_login) {
                return abort(404);
            }
        }
        $dataTransaksiDetail = MTrxBarangPindahDetail::where('id_pindah', $dataTransaksi->id_pindah)->get();
        return view('transaksi.moving.detail', ['dataTransaksi' => $dataTransaksi, 'dataTransaksiDetail' => $dataTransaksiDetail]);
    }
    public function movingProsesAdd(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_kode_prodi_login = auth()->guard('karyawan')->user()->user_kode_prodi ?? null;
        $user_nama_prodi_login = auth()->guard('karyawan')->user()->user_nama_prodi ?? null;

        // -- ambil dari form
        $form_keterangan = $request->post('keterangan');
        $form_barang = $request->post('barang');
        $form_gedung = $request->post('gedung');
        $form_gudang = $request->post('gudang');
        $form_blok = $request->post('blok');
        $form_lokasi = $request->post('lokasi');
        $form_stok = $request->post('stok');

        // -- olah dulu
        $dataGrouping = [];
        foreach($form_barang as $index => $value) {
            $dataBarang = MBarang::findOrFail($form_barang[$index]);
            $dataGedung = MGedung::findOrFail($form_gedung[$index]);
            $dataGudang = MGudang::findOrFail($form_gudang[$index]);
            $dataBlok = MBlok::findOrFail($form_blok[$index]);
            $dataLokasi = MLokasi::findOrFail($form_lokasi[$index]);
            $dataStok = $form_stok[$index];

            // dd($dataBarang);
            array_push($dataGrouping, [
                'barang' => $dataBarang,
                'gedung' => $dataGedung,
                'gudang' => $dataGudang,
                'blok' => $dataBlok,
                'lokasi' => $dataLokasi,
                'stok' => $dataStok,
            ]);
        }

        $dataModelBarang = [];
        foreach($dataGrouping as $index => $value) {
            $tmpBarang = $value['barang'];
            $tmpGedung = $value['gedung'];
            $tmpGudang = $value['gudang'];
            $tmpBlok = $value['blok'];
            $tmpLokasi = $value['lokasi'];
            $tmpStok = $value['stok'];

            $tblBarang = MBarang::findOrFail($tmpBarang->id_barang);

            if ($tmpLokasi->id_lokasi != $dataBarang->id_lokasi_now) {
                $tblBarang->lokasi_sebelumnya = $dataBarang->lokasi_sekarang;
                $tblBarang->id_gedung_old = $dataBarang->id_gedung_now;
                $tblBarang->id_gudang_old = $dataBarang->id_gudang_now;
                $tblBarang->id_blok_old = $dataBarang->id_blok_now;
                $tblBarang->id_lokasi_old = $dataBarang->id_lokasi_now;
            }
            $tblBarang->lokasi_sekarang = $tmpLokasi->nama_lokasi;
            $tblBarang->id_gedung_now = $tmpGedung->id_gedung;
            $tblBarang->id_gudang_now = $tmpGudang->id_gudang;
            $tblBarang->id_blok_now = $tmpBlok->id_blok;
            $tblBarang->id_lokasi_now = $tmpLokasi->id_lokasi;

            array_push($dataModelBarang, $tblBarang);
        }
        // // -- set ke table

        // // -- BUAT TRX [CREATE] -- \\
        $uuidTrx = Uuid::uuid4()->toString();
        $dateKodeTrx = Carbon::now()->format('YmdHisu');
        // $list_idBarang = collect($dataModelBarang)->pluck('id_barang')->toArray();
        $list_kodeBarang = collect($dataModelBarang)->pluck('kode_barang')->toArray();

        $tblTransaksi = new MTrxBarangPindah();
        $tblTransaksi->kode_pindah = 'MV#'.$dateKodeTrx;
        // $tblTransaksi->tipe_trx = 'STOK_IN';
        $tblTransaksi->ket = $form_keterangan.'<br/><br/>MOVING BARANG #'.implode(',', $list_kodeBarang ?? []);

        $tblTransaksi->user_id_prodi = $user_id_prodi_login;
        $tblTransaksi->user_kode_prodi = $user_kode_prodi_login;
        $tblTransaksi->user_nama_prodi = $user_nama_prodi_login;

        $tblTransaksi->user_create = $userid_login;
        // $tblTransaksi->user_update = ;
        $tblTransaksi->uid = $uuidTrx;
        $tblTransaksi->save();
        // dd($tblTransaksi->id_trx);

        $dataModelTrxBarangDetail = [];
        foreach($dataGrouping as $nomor => $value) {
            $tmpBarang = $value['barang'];
            $tmpGedung = $value['gedung'];
            $tmpGudang = $value['gudang'];
            $tmpBlok = $value['blok'];
            $tmpLokasi = $value['lokasi'];
            $tmpStok = $value['stok'];

            $tblTransaksiDetail = new MTrxBarangPindahDetail();
            // 	lokasi_sekarang	id_gedung	id_gudang	id_blok	id_lokasi	user_create
            $tblTransaksiDetail->id_pindah = $tblTransaksi->id_pindah;
            $tblTransaksiDetail->kode_pindah = $tblTransaksi->kode_pindah;
            $tblTransaksiDetail->norut = $nomor + 1;
            // $tblTransaksiDetail->id_pindah_sebelumnya = '';
            // $tblTransaksiDetail->lokasi_sebelumnya = '';
            $tblTransaksiDetail->id_barang = $tmpBarang->id_barang;
            $tblTransaksiDetail->kode_barang = $tmpBarang->kode_barang;
            $tblTransaksiDetail->nama_barang = $tmpBarang->nama_barang;
            $tblTransaksiDetail->stok = intval($tmpStok);
            
            // -- lokasi pindah
            $tblTransaksiDetail->lokasi_sekarang = $tmpLokasi->nama_lokasi;
            $tblTransaksiDetail->id_gedung = $tmpGedung->id_gedung;
            $tblTransaksiDetail->nama_gedung = $tmpGedung->nama_gedung;

            $tblTransaksiDetail->id_gudang = $tmpGudang->id_gudang;
            $tblTransaksiDetail->nama_gudang = $tmpGudang->nama_gudang;

            $tblTransaksiDetail->id_blok = $tmpBlok->id_blok;
            $tblTransaksiDetail->nama_blok = $tmpBlok->nama_blok;

            $tblTransaksiDetail->id_lokasi = $tmpLokasi->id_lokasi;
            $tblTransaksiDetail->nama_lokasi = $tmpLokasi->nama_lokasi;

            $tblTransaksiDetail->user_id_prodi = $user_id_prodi_login;
            $tblTransaksiDetail->user_kode_prodi = $user_kode_prodi_login;
            $tblTransaksiDetail->user_nama_prodi = $user_nama_prodi_login;


            array_push($dataModelTrxBarangDetail, $tblTransaksiDetail);
        }
        // dd($dataModelTrxBarangDetail);
        foreach($dataModelTrxBarangDetail as $index => $value) {
            $value->save();
        }

        // -- barangnya update -- \\
        $dataBarangDetail = [];
        foreach($dataModelBarang as $index => $value) {
            $value->id_trx_move_last = $tblTransaksi->id_pindah;
            $value->kode_trx_move_last = $tblTransaksi->kode_pindah;
            array_push($dataBarangDetail, $value);
        }
        foreach($dataBarangDetail as $index => $value) {
            $value->save();
        }
 
        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('transaksi.moving.index');
    }
    public function movingProsesEdit(Request $request)
    {
        # code...
        // return view('transaksi.moving.proses-edit');
    }
    public function movingProsesDelete(Request $request)
    {
        # code...
        // return view('transaksi.moving.proses-delete');
    }
}
