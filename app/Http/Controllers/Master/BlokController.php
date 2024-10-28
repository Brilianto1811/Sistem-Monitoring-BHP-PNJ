<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use App\Models\MBlok;
use App\Models\MGedung;
use App\Models\MGudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlokController extends Controller
{
    //
    public function blokShow(Request $request)
    {
        $dataBlok = MBlok::leftJoin('tbl_gudang', 'tbl_blok.id_gudang', '=', 'tbl_gudang.id_gudang')
                            ->leftJoin('tbl_gedung', 'tbl_blok.id_gedung', '=', 'tbl_gedung.id_gedung')
                            ->select('tbl_blok.*', 'tbl_gedung.nama_gedung', 'tbl_gudang.nama_gudang')
                            ->get(); // narik semua dari db kirim ke view
        return view('master.blok.index' , ['dataBlok' => $dataBlok]);
    }
    public function blokShowCreate(Request $request)
    {
        $dataGedung = MGedung::all(); // narik semua dari db kirim ke view
        $dataGudang = MGudang::all(); // narik semua dari db kirim ke view
        return view('master.blok.create', ['dataGedung' => $dataGedung, 'dataGudang' => $dataGudang]);

    }
    public function blokShowEdit(Request $request)
    {
        // -- ambil dari request id
        $form_id_blok = $request->query('id_blok', '');

        $dataBlok = MBlok::findOrFail($form_id_blok);
        // dd($dataBlok);
        $dataGudang = MGudang::all();
        $dataGedung = MGedung::all();
        return view('master.blok.edit', ['dataBlok' => $dataBlok, 'dataGedung' => $dataGedung, 'dataGudang' => $dataGudang]);
    }
    public function blokShowDetail(Request $request)
    {
        // -- ambil dari request id
       $form_id_blok = $request->query('id_blok', '');

       $dataBlok = MBlok::find($form_id_blok);
       $dataGedung = MGedung::find($dataBlok->id_gedung);
       $dataGudang = MGudang::find($dataBlok->id_gudang);

       return view('master.blok.detail', ['dataGudang' => $dataGudang, 'dataGedung' => $dataGedung, 'dataBlok' => $dataBlok]);
    }
    public function blokProsesAdd(Request $request)
    {
        # code...

        $form_kode_blok = $request->post('kode_blok');
        $form_nama_blok = $request->post('nama_blok');
        $form_id_gedung = $request->post('id_gedung');
        $form_id_gudang = $request->post('id_gudang');

        // -- tarik data lagi ke table
        $tblGedung = MGedung::find($form_id_gedung);
        $tblGudang = MGudang::find($form_id_gudang);

        // -- set ke table
        $tblBlok = new MBlok();
        $tblBlok->kode_gedung = $tblGedung->kode_gedung;
        $tblBlok->id_gedung = $tblGedung->id_gedung;

        $tblBlok->kode_gudang = $tblGudang->kode_gudang;
        $tblBlok->id_gudang = $tblGudang->id_gudang;

        $tblBlok->kode_blok = $form_kode_blok;
        $tblBlok->nama_blok = $form_nama_blok;

        $tblBlok->save(); // doing save here..

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('master.blok.index');
    }
    public function blokProsesEdit(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        $form_oldid = $request->post('oldid');

        // -- ambil dari form
        $form_kode_blok = $request->post('kode_blok');
        $form_nama_blok = $request->post('nama_blok');
        $form_id_gudang = $request->post('id_gudang');
        $form_id_gedung = $request->post('id_gedung');

        // -- tarik data lagi ke table
        $tblGudang = MGudang::find($form_id_gudang);
        $tblGedung = MGedung::find($form_id_gedung);

        // -- set ke table
        $tblBlok = MBlok::find($form_oldid);
        $tblBlok->kode_gudang = $tblGudang->kode_gudang;
        $tblBlok->id_gudang = $tblGudang->id_gudang;
        $tblBlok->kode_gedung = $tblGedung->kode_gedung;
        $tblBlok->id_gedung = $tblGedung->id_gedung;
        $tblBlok->kode_blok = $form_kode_blok;
        $tblBlok->nama_blok = $form_nama_blok;


        // $tblGudang->user_create = $userid_login;
        $tblBlok->user_update = $userid_login;
        $tblBlok->save(); // doing save here..

        Session::flash('alert-success', 'Success Edit Data'); // kasih pesan success
        return redirect()->route('master.blok.index');
    }
    public function blokProsesDelete(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_oldid = $request->query('id_blok');
        $tblBlok = MBlok::findOrFail($form_oldid);

        $tblBlok->delete();

        Session::flash('alert-success', 'Success Delete Data'); // kasih pesan success
        return redirect()->route('master.blok.index');
    }
}
