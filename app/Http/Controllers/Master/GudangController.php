<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use App\Models\MGudang;
use App\Models\MGedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GudangController extends Controller
{
    //
    public function gudangShow(Request $request)
    {
         # code...
        //  Modelnya dijoin ke tbl_b, patokannya tbl_a.apa = tbl_b.apa
         $dataGudang = MGudang::leftJoin('tbl_gedung', 'tbl_gudang.id_gedung', '=', 'tbl_gedung.id_gedung')
                            ->select('tbl_gudang.*', 'tbl_gedung.*')
                            ->get(); // narik semua dari db kirim ke view
        return view('master.gudang.index' , ['dataGudang' => $dataGudang]);
    }
    public function gudangShowCreate(Request $request)
    {
        # code...
        $dataGedung = MGedung::all(); // narik semua dari db kirim ke view
        return view('master.gudang.create', ['dataGedung' => $dataGedung]);
    }
    public function gudangShowEdit(Request $request)
    {
        // -- ambil dari request id
        $form_id_gudang = $request->query('id_gudang', '');

        $dataGudang = MGudang::findOrFail($form_id_gudang);
        $dataGedung = MGedung::all();
        return view('master.gudang.edit', ['dataGudang' => $dataGudang, 'dataGedung' => $dataGedung]);
    }
    public function gudangShowDetail(Request $request)
    {
       // -- ambil dari request id
       $form_id_gudang = $request->query('id_gudang', '');

       $dataGudang = MGudang::find($form_id_gudang);
       $dataGedung = MGedung::find($dataGudang->id_gedung);
       return view('master.gudang.detail', ['dataGudang' => $dataGudang, 'dataGedung' => $dataGedung]);
    }
    public function gudangProsesAdd(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_kode_gudang = $request->post('kode_gudang');
        $form_nama_gudang = $request->post('nama_gudang');
        $form_id_gedung = $request->post('id_gedung');

        // -- tarik data lagi ke table
        $tblGedung = MGedung::find($form_id_gedung);

        // -- set ke table
        $tblGudang = new MGudang();
        $tblGudang->kode_gedung = $tblGedung->kode_gedung;
        $tblGudang->id_gedung = $tblGedung->id_gedung;
        $tblGudang->kode_gudang = $form_kode_gudang;
        $tblGudang->nama_gudang = $form_nama_gudang;
        
        $tblGudang->user_create = $userid_login;
        // $tblGudang->user_update = $userid_login;
        $tblGudang->save(); // doing save here..

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('master.gudang.index');
    }
    public function gudangProsesEdit(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        $form_oldid = $request->post('oldid');

        // -- ambil dari form
        $form_kode_gudang = $request->post('kode_gudang');
        $form_nama_gudang = $request->post('nama_gudang');
        $form_id_gedung = $request->post('id_gedung');

        // -- tarik data lagi ke table
        $tblGedung = MGedung::find($form_id_gedung);

        // -- set ke table
        $tblGudang = MGudang::find($form_oldid);
        $tblGudang->kode_gedung = $tblGedung->kode_gedung;
        $tblGudang->id_gedung = $tblGedung->id_gedung;
        $tblGudang->kode_gudang = $form_kode_gudang;
        $tblGudang->nama_gudang = $form_nama_gudang;
        
        // $tblGudang->user_create = $userid_login;
        $tblGudang->user_update = $userid_login;
        $tblGudang->save(); // doing save here..

        Session::flash('alert-success', 'Success Edit Data'); // kasih pesan success
        return redirect()->route('master.gudang.index');
    }
    public function gudangProsesEditXXX(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_oldid = $request->post('oldid');  // tambah ini

        $form_kode_gudang = $request->post('kode_gudang');
        $form_nama_gudang = $request->post('nama_gudang');
        $form_id_gedung = $request->post('id_gedung');

        // -- tarik data lagi ke table
        $tblGedung = MGedung::find($form_id_gedung);

        // -- set ke table
        $tblGudang = MGudang::find($form_oldid); // ini
        $tblGudang->kode_gedung = $tblGedung->kode_gedung;
        $tblGudang->id_gedung = $tblGedung->id_gedung;
        $tblGudang->kode_gudang = $form_kode_gudang;
        $tblGudang->nama_gudang = $form_nama_gudang;
        
        // $tblGudang->user_create = $userid_login; // di proses add ini nyala
        $tblGudang->user_update = $userid_login; // di proses edit ini nyala
        $tblGudang->save(); // doing save here..

        Session::flash('alert-success', 'Success Edit Data'); // kasih pesan success [edit disini]
        return redirect()->route('master.gudang.index');
    }
    public function gudangProsesDelete(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_oldid = $request->query('id_gudang');
        $tblGudang = MGudang::findOrFail($form_oldid);

        $tblGudang->delete();

        Session::flash('alert-success', 'Success Delete Data'); // kasih pesan success
        return redirect()->route('master.gudang.index');
    }
}
