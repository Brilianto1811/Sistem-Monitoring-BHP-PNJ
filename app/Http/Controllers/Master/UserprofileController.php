<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MLogin;
use App\Models\MProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserprofileController extends Controller
{
    //
    public function userprofileShow(Request $request)
    {
        # code...
        $dataUserprofile = MLogin::all(); // narik semua dari db kirim ke view
        return view('master.userprofile.index', ['dataUserprofile' => $dataUserprofile]);
    }
    public function userprofileShowCreate(Request $request)
    {
        # code...
        $dataProdi = MProdi::all();
        return view('master.userprofile.create', ['dataProdi' => $dataProdi]);

    }
    public function userprofileShowEdit(Request $request)
    {
        // -- ambil dari request id
        $form_id_login = $request->query('id_login', '');

        $dataLogin = MLogin::findOrFail($form_id_login);
        $dataProdi = MProdi::all();
        return view('master.userprofile.edit', ['dataLogin' => $dataLogin, 'dataProdi' => $dataProdi]);
    }
    public function userprofileShowDetail(Request $request)
    {
        // -- ambil dari request id
        $form_id_login = $request->query('id_login', '');

        $dataLogin = MLogin::findOrFail($form_id_login);
        return view('master.userprofile.detail', ['dataLogin' => $dataLogin]);
    }
    public function userprofileProsesAdd(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;


        // -- ambil dari form
        $form_userid = $request->post('userid');
        $form_password = $request->post('password');
        $form_nip = $request->post('nip');
        $form_nama = $request->post('nama');
        $form_level = $request->post('level');
        $form_prodi = $request->post('prodi');
        $form_status = $request->post('status');

        $dataProdi = MProdi::find($form_prodi);

        $password_hash = Hash::make($form_password);

        // -- set ke table
        $tblLogin = new MLogin();
        $tblLogin->userid = $form_userid;
        $tblLogin->password = $password_hash;
        $tblLogin->nip = $form_nip;
        $tblLogin->nama_user = $form_nama;
        $tblLogin->level = $form_level;
        $tblLogin->status_user = $form_status;
        $tblLogin->user_create = $userid_login;

        $tblLogin->user_id_prodi = $dataProdi->id_prodi ?? null;
        $tblLogin->user_kode_prodi = $dataProdi->kode_prodi ?? null;
        $tblLogin->user_nama_prodi = $dataProdi->nama_prodi ?? null;

        $tblLogin->save(); // doing save here..

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('master.userprofile.index');
    }
    public function userprofileProsesEdit(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_oldid = $request->post('oldid');
        $form_userid = $request->post('userid');
        $form_password = $request->post('password');
        $form_nip = $request->post('nip');
        $form_nama = $request->post('nama');
        $form_level = $request->post('level');
        $form_prodi = $request->post('prodi');
        $form_status = $request->post('status');

        $dataProdi = MProdi::find($form_prodi);

        $password_hash = Hash::make($form_password);

        // -- set ke table
        $tblLogin = MLogin::find($form_oldid);
        $tblLogin->userid = $form_userid;
        if($form_password != '') {
            $tblLogin->password = $password_hash;
        }
        $tblLogin->nip = $form_nip;
        $tblLogin->nama_user = $form_nama;
        $tblLogin->level = $form_level;
        $tblLogin->status_user = $form_status;
        // $tblLogin->user_create = $userid_login;
        $tblLogin->user_update = $userid_login;

        $tblLogin->user_id_prodi = $dataProdi->id_prodi ?? null;
        $tblLogin->user_kode_prodi = $dataProdi->kode_prodi ?? null;
        $tblLogin->user_nama_prodi = $dataProdi->nama_prodi ?? null;

        $tblLogin->save(); // doing save here..

        Session::flash('alert-success', 'Success Edit Data'); // kasih pesan success
        return redirect()->route('master.userprofile.index');
    }
    public function userprofileProsesDelete(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_oldid = $request->query('id_login');

        $tblLogin = MLogin::find($form_oldid);
        $tblLogin->delete();
        Session::flash('alert-success', 'Success Delete Data'); // kasih pesan success
        return redirect()->route('master.userprofile.index');
    }
}
