<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use App\Models\MBlok;
use App\Models\MGedung;
use App\Models\MGudang;
use App\Models\MLokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LokasiController extends Controller
{
    //
    public function lokasiShow(Request $request)
    {
        $dataLokasi = MLokasi::leftJoin('tbl_blok', 'tbl_lokasi.id_blok', '=', 'tbl_blok.id_blok')
                            ->leftJoin('tbl_gudang', 'tbl_lokasi.id_gudang', '=', 'tbl_gudang.id_gudang')
                            ->leftJoin('tbl_gedung', 'tbl_lokasi.id_gedung', '=', 'tbl_gedung.id_gedung')
                            ->select('tbl_lokasi.*', 'tbl_gedung.nama_gedung', 'tbl_gudang.nama_gudang', 'tbl_blok.nama_blok')
                            ->get(); // narik semua dari db kirim ke view
        return view('master.lokasi.index' , ['dataLokasi' => $dataLokasi]);
    }
    public function lokasiShowCreate(Request $request)
    {
        $dataGedung = MGedung::all(); // narik semua dari db kirim ke view
        $dataGudang = MGudang::all(); // narik semua dari db kirim ke view
        $dataBlok = MBlok::all(); // narik semua dari db kirim ke view
        return view('master.lokasi.create', ['dataGedung' => $dataGedung, 'dataGudang' => $dataGudang, 'dataBlok' => $dataBlok]);

    }
    public function lokasiShowEdit(Request $request)
    {
        // -- ambil dari request id
        $form_id_lokasi = $request->query('id_lokasi', '');

        $dataLokasi = MLokasi::findOrFail($form_id_lokasi);
        $dataBlok = MBlok::all();
        $dataGudang = MGudang::all();
        $dataGedung = MGedung::all();
        return view('master.lokasi.edit', ['dataLokasi' => $dataLokasi, 'dataGedung' => $dataGedung, 'dataGudang' => $dataGudang, 'dataBlok' => $dataBlok]);
    }
    public function lokasiShowDetail(Request $request)
    {
        // -- ambil dari request id
       $form_id_lokasi = $request->query('id_lokasi', '');

       $dataLokasi = MLokasi::find($form_id_lokasi);
       $dataGedung = MGedung::find($dataLokasi->id_gedung);
       $dataGudang = MGudang::find($dataLokasi->id_gudang);
       $dataBlok = MBlok::find($dataLokasi->id_blok);


       return view('master.lokasi.detail', ['dataGudang' => $dataGudang, 'dataGedung' => $dataGedung, 'dataBlok' => $dataBlok, 'dataLokasi' => $dataLokasi]);
    }
    public function lokasiProsesAdd(Request $request)
    {
        $form_kode_lokasi = $request->post('kode_lokasi');
        $form_nama_lokasi = $request->post('nama_lokasi');
        $form_id_gedung = $request->post('id_gedung');
        $form_id_gudang = $request->post('id_gudang');
        $form_id_blok = $request->post('id_blok');

        // -- tarik data lagi ke table
        $tblGedung = MGedung::find($form_id_gedung);
        $tblGudang = MGudang::find($form_id_gudang);
        $tblBlok = MBlok::find($form_id_blok);

        // -- set ke table
        $tblLokasi = new MLokasi();
        $tblLokasi->kode_gedung = $tblGedung->kode_gedung;
        $tblLokasi->id_gedung = $tblGedung->id_gedung;

        $tblLokasi->kode_gudang = $tblGudang->kode_gudang;
        $tblLokasi->id_gudang = $tblGudang->id_gudang;

        $tblLokasi->kode_blok = $tblBlok->kode_blok;
        $tblLokasi->id_blok = $tblBlok->id_blok;

        $tblLokasi->kode_lokasi = $form_kode_lokasi;
        $tblLokasi->nama_lokasi = $form_nama_lokasi;

        $tblLokasi->save(); // doing save here..

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('master.lokasi.index');
    }
    public function lokasiProsesEdit(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        $form_oldid = $request->post('oldid');

        // -- ambil dari form
        $form_kode_lokasi = $request->post('kode_lokasi');
        $form_nama_lokasi = $request->post('nama_lokasi');
        $form_id_blok = $request->post('id_blok');
        $form_id_gudang = $request->post('id_gudang');
        $form_id_gedung = $request->post('id_gedung');

        // -- tarik data lagi ke table
        $tblBlok = MBlok::find($form_id_blok);
        $tblGudang = MGudang::find($form_id_gudang);
        $tblGedung = MGedung::find($form_id_gedung);

        // -- set ke table
        $tblLokasi = MLokasi::find($form_oldid);
        $tblLokasi->kode_gudang = $tblGudang->kode_gudang;
        $tblLokasi->id_gudang = $tblGudang->id_gudang;
        $tblLokasi->kode_gedung = $tblGedung->kode_gedung;
        $tblLokasi->id_gedung = $tblGedung->id_gedung;
        $tblLokasi->kode_blok = $tblBlok->kode_blok;
        $tblLokasi->id_blok = $tblBlok->id_blok;
        $tblLokasi->kode_lokasi = $form_kode_lokasi;
        $tblLokasi->nama_lokasi = $form_nama_lokasi;


        // $tblGudang->user_create = $userid_login;
        $tblLokasi->user_update = $userid_login;
        $tblLokasi->save(); // doing save here..

        Session::flash('alert-success', 'Success Edit Data'); // kasih pesan success
        return redirect()->route('master.lokasi.index');
    }
    public function lokasiProsesDelete(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_oldid = $request->query('id_lokasi');
        $tblLokasi = MLokasi::findOrFail($form_oldid);

        $tblLokasi->delete();

        Session::flash('alert-success', 'Success Delete Data'); // kasih pesan success
        return redirect()->route('master.lokasi.index');
    }
}
