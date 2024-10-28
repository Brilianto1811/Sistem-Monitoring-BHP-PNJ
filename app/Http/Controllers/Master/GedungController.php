<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use App\Models\MGedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GedungController extends Controller
{
    //
    public function gedungShow(Request $request)
    {
        # code...
        $dataGedung = MGedung::all(); // narik semua dari db kirim ke view
        return view('master.gedung.index', ['dataGedung' => $dataGedung]);
    }
    public function gedungShowCreate(Request $request)
    {
        # code...
        return view('master.gedung.create');
    }
    public function gedungShowEdit(Request $request)
    {
        // -- ambil dari request id
        $form_id_gedung = $request->query('id_gedung', '');

        $dataGedung = MGedung::findOrFail($form_id_gedung);
        return view('master.gedung.edit', ['dataGedung' => $dataGedung]);
    }
    public function gedungShowDetail(Request $request)
    {
         // -- ambil dari request id
         $form_id_gedung = $request->query('id_gedung', '');

         $dataGedung = MGedung::find($form_id_gedung);
         return view('master.gedung.detail', ['dataGedung' => $dataGedung]);
    }
    public function gedungProsesAdd(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_kode_gedung = $request->post('kode_gedung');
        $form_nama_gedung = $request->post('nama_gedung');

        // -- set ke table
        $tblGedung = new MGedung();
        $tblGedung->kode_gedung = $form_kode_gedung;
        $tblGedung->nama_gedung = $form_nama_gedung;

        $tblGedung->user_create = $userid_login;
        // $tblGedung->user_update = $userid_login;
        $tblGedung->save(); // doing save here..

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('master.gedung.index');
    }
    public function gedungProsesEdit(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_oldid = $request->post('oldid');
        $form_kode_gedung = $request->post('kode_gedung');
        $form_nama_gedung = $request->post('nama_gedung');

        // -- set ke table
        $tblGedung = MGedung::findOrFail($form_oldid);
        $tblGedung->kode_gedung = $form_kode_gedung;
        $tblGedung->nama_gedung = $form_nama_gedung;

        // $tblGedung->user_create = $userid_login;
        $tblGedung->user_update = $userid_login;
        $tblGedung->save(); // doing save here..

        Session::flash('alert-success', 'Success Edit Data'); // kasih pesan success
        return redirect()->route('master.gedung.index');
    }
    public function gedungProsesDelete(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_oldid = $request->query('id_gedung');
        $tblGedung = MGedung::findOrFail($form_oldid);

        $tblGedung->delete();

        Session::flash('alert-success', 'Success Delete Data'); // kasih pesan success
        return redirect()->route('master.gedung.index');
    }
}
