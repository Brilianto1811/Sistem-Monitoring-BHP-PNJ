<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use App\Models\MJurusan;
use App\Models\MProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProdiController extends Controller
{
    //
    public function prodiShow(Request $request)
    {
        # code...
        // $dataProdi = MProdi::all(); // narik semua dari db kirim ke view
        $dataProdi = MProdi::leftJoin('tbl_jurusan', 'tbl_prodi.id_jurusan', '=', 'tbl_jurusan.id_jurusan')
                            ->select('tbl_prodi.*', 'tbl_jurusan.*')
                            ->get(); // narik semua dari db kirim ke view
        return view('master.prodi.index' , ['dataProdi' => $dataProdi]);
    }
    public function prodiShowCreate(Request $request)
    {
        # code...
        $dataJurusan = MJurusan::all(); // narik semua dari db kirim ke view
        return view('master.prodi.create', ['dataJurusan' => $dataJurusan,]);
    }
    public function prodiShowEdit(Request $request)
    {
         // -- ambil dari request id
         $form_id_prodi = $request->query('id_prodi', '');
         $dataProdi = MProdi::findOrFail($form_id_prodi);
         $dataJurusan = MJurusan::all();
         return view('master.prodi.edit', ['dataProdi' => $dataProdi, 'dataJurusan' => $dataJurusan]);
    }
    public function prodiShowDetail(Request $request)
    {
        $form_id_prodi = $request->query('id_prodi', '');
        $dataProdi = MProdi::find($form_id_prodi);
        $dataJurusan = MJurusan::find($dataProdi->id_jurusan);
        return view('master.prodi.detail', ['dataProdi' => $dataProdi, 'dataJurusan' => $dataJurusan]);
    }
    public function prodiProsesAdd(Request $request)
    {
        # code...

        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_kode_prodi = $request->post('kode_prodi');
        $form_nama_prodi = $request->post('nama_prodi');
        $form_id_jurusan = $request->post('id_jurusan');

        // -- tarik data lagi ke table
        $tblJurusan = MJurusan::find($form_id_jurusan);

        // -- set ke table
        $tblProdi = new MProdi();
        $tblProdi->kode_jurusan = $tblJurusan->kode_jurusan;
        $tblProdi->id_jurusan = $tblJurusan->id_jurusan;
        $tblProdi->kode_prodi = $form_kode_prodi;
        $tblProdi->nama_prodi = $form_nama_prodi;

        $tblProdi->user_create = $userid_login;
        // $tblProdi->user_update = $userid_login;
        $tblProdi->save(); // doing save here..

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('master.prodi.index');
    }
    public function prodiProsesEdit(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
         $form_oldid = $request->post('oldid');
         $form_kode_prodi = $request->post('kode_prodi');
         $form_nama_prodi = $request->post('nama_prodi');
         $form_id_jurusan = $request->post('id_jurusan');

         // -- tarik data lagi ke table
         $tblJurusan = MJurusan::find($form_id_jurusan);

         // -- set ke table
         $tblProdi = MProdi::findOrFail($form_oldid);
         $tblProdi->kode_jurusan = $tblJurusan->kode_jurusan;
         $tblProdi->id_jurusan = $tblJurusan->id_jurusan;
         $tblProdi->kode_prodi = $form_kode_prodi;
         $tblProdi->nama_prodi = $form_nama_prodi;

        //$tblProdi->user_create = $userid_login;
        $tblProdi->user_update = $userid_login;

         $tblProdi->save(); // doing save here..
         Session::flash('alert-success', 'Success Edit Data'); // kasih pesan success
         return redirect()->route('master.prodi.index');
    }
    public function prodiProsesDelete(Request $request)
    {
        // -- ambil dari form
        $form_oldid = $request->query('id_prodi');
        $tblKelas = MProdi::findOrFail($form_oldid);

        $tblKelas->delete();

        Session::flash('alert-success', 'Success Delete Data'); // kasih pesan success
        return redirect()->route('master.prodi.index');
    }
}
