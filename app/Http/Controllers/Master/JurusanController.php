<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use App\Models\MJurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JurusanController extends Controller
{
    //
    public function jurusanShow(Request $request)
    {
        # code...
        $dataJurusan = MJurusan::all(); // narik semua dari db kirim ke view
        return view('master.jurusan.index' , ['dataJurusan' => $dataJurusan]);
    }
    public function jurusanShowCreate(Request $request)
    {
        # code...
        return view('master.jurusan.create');
    }
    public function jurusanShowEdit(Request $request)
    {
        // -- ambil dari request id
        $form_id_jurusan = $request->query('id_jurusan', '');
        $dataJurusan = MJurusan::findOrFail($form_id_jurusan);
        return view('master.jurusan.edit', ['dataJurusan' => $dataJurusan]);
    }
    public function jurusanShowDetail(Request $request)
    {
        // -- ambil dari request id
        $form_id_jurusan = $request->query('id_jurusan', '');

        $dataJurusan = MJurusan::find($form_id_jurusan);
        return view('master.jurusan.detail', ['dataJurusan' => $dataJurusan]);
    }
    public function jurusanProsesAdd(Request $request)
    {
        # code...

        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_kode_jurusan = $request->post('kode_jurusan');
        $form_nama_jurusan = $request->post('nama_jurusan');

        
        // -- set ke table
        $tblJurusan = new MJurusan();
        $tblJurusan->kode_jurusan = $form_kode_jurusan;
        $tblJurusan->nama_jurusan = $form_nama_jurusan;

        $tblJurusan->user_create = $userid_login;
        // $tblJurusan->user_update = $userid_login;
        $tblJurusan->save(); // doing save here..

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('master.jurusan.index');
    }
    public function jurusanProsesEdit(Request $request)
    {
     
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;
        
        // -- ambil dari form
        $form_oldid = $request->post('oldid');
        $form_kode_jurusan = $request->post('kode_jurusan');
        $form_nama_jurusan = $request->post('nama_jurusan');

        // -- set ke table
        $tblJurusan = MJurusan::findOrFail($form_oldid);
        $tblJurusan->kode_jurusan = $form_kode_jurusan;
        $tblJurusan->nama_jurusan = $form_nama_jurusan;

        //$tblJurusan->user_create = $userid_login;
        $tblJurusan->user_update = $userid_login;

        $tblJurusan->save(); // doing save here..
        Session::flash('alert-success', 'Success Edit Data'); // kasih pesan success
        return redirect()->route('master.jurusan.index');
    }
    public function jurusanProsesDelete(Request $request)
    {
         // -- ambil dari form
         $form_oldid = $request->query('id_jurusan');
         $tblJurusan = MJurusan::findOrFail($form_oldid);
 
         $tblJurusan->delete();
 
         Session::flash('alert-success', 'Success Delete Data'); // kasih pesan success
         return redirect()->route('master.jurusan.index');
    }
}
