<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use App\Models\MKelas;
use App\Models\MJurusan;
use App\Models\MProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
{
    //
    public function kelasShow(Request $request)
    {
        # code...
        // $dataKelas = MKelas::leftJoin('tbl_jurusan', 'tbl_kelas.id_jurusan', '=', 'tbl_jurusan.id_jurusan')
        //                     ->select('tbl_kelas.*', 'tbl_jurusan.*')
        //                     ->get(); // narik semua dari db kirim ke view
        $dataKelas = MKelas::leftJoin('tbl_prodi', 'tbl_kelas.id_prodi', '=', 'tbl_prodi.id_prodi')
                            ->leftJoin('tbl_jurusan', 'tbl_kelas.id_jurusan', '=', 'tbl_jurusan.id_jurusan')
                            ->select('tbl_kelas.*', 'tbl_jurusan.nama_jurusan', 'tbl_prodi.nama_prodi')

                            ->get(); // narik semua dari db kirim ke view
        return view('master.kelas.index' , ['dataKelas' => $dataKelas]);
    }
    public function kelasShowCreate(Request $request)
    {
        $dataJurusan = MJurusan::all(); // narik semua dari db kirim ke view
        $dataProdi = MProdi::all(); // narik semua dari db kirim ke view
        return view('master.kelas.create', ['dataJurusan' => $dataJurusan, 'dataProdi' => $dataProdi]);
    }
    public function kelasShowEdit(Request $request)
    {
        // -- ambil dari request id
        $form_id_kelas = $request->query('id_kelas', '');
        $dataKelas = MKelas::findOrFail($form_id_kelas);
        $dataProdi = MProdi::all();
        $dataJurusan = MJurusan::all();
        return view('master.kelas.edit', ['dataKelas' => $dataKelas, 'dataProdi' => $dataProdi, 'dataJurusan' => $dataJurusan]);
    }
    public function kelasShowDetail(Request $request)
    {
        $form_id_kelas = $request->query('id_kelas', '');
        $dataKelas = MKelas::find($form_id_kelas);
        $dataProdi = MProdi::find($dataKelas->id_prodi);
        $dataJurusan = MJurusan::find($dataKelas->id_jurusan);
        return view('master.kelas.detail', ['dataKelas' => $dataKelas, 'dataProdi' => $dataProdi, 'dataJurusan' => $dataJurusan]);
    }
    public function kelasProsesAdd(Request $request)
    {
        # code...

        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        // -- ambil dari form
        $form_kode_kelas = $request->post('kode_kelas');
        $form_nama_kelas = $request->post('nama_kelas');
        $form_id_jurusan = $request->post('id_jurusan');
        $form_id_prodi = $request->post('id_prodi');

        // -- tarik data lagi ke table
        $tblJurusan = MJurusan::find($form_id_jurusan);
        $tblProdi = MProdi::find($form_id_prodi);

        // -- set ke table
        $tblKelas = new MKelas();
        $tblKelas->kode_jurusan = $tblJurusan->kode_jurusan;
        $tblKelas->id_jurusan = $tblJurusan->id_jurusan;
        $tblKelas->kode_prodi = $tblProdi->kode_prodi;
        $tblKelas->id_prodi = $tblProdi->id_prodi;
        $tblKelas->kode_kelas = $form_kode_kelas;
        $tblKelas->nama_kelas = $form_nama_kelas;

        $tblKelas->user_create = $userid_login;
        // $tblKelas->user_update = $userid_login;
        $tblKelas->save(); // doing save here..

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('master.kelas.index');
    }
    public function kelasProsesEdit(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;
        $form_oldid = $request->post('oldid');

        // -- ambil dari form
        $form_kode_kelas = $request->post('kode_kelas');
        $form_nama_kelas = $request->post('nama_kelas');
        $form_id_jurusan = $request->post('id_jurusan');
        $form_id_prodi = $request->post('id_prodi');

        // -- tarik data lagi ke table
        $tblJurusan = MJurusan::find($form_id_jurusan);
        $tblProdi = MProdi::find($form_id_prodi);

        // -- set ke table
        $tblKelas = MKelas::findOrFail($form_oldid);
        $tblKelas->kode_jurusan = $tblJurusan->kode_jurusan;
        $tblKelas->id_jurusan = $tblJurusan->id_jurusan;
        $tblKelas->kode_prodi = $tblProdi->kode_prodi;
        $tblKelas->id_prodi = $tblProdi->id_prodi;
        $tblKelas->kode_kelas = $form_kode_kelas;
        $tblKelas->nama_kelas = $form_nama_kelas;

        //$tblKelas->user_create = $userid_login;
        $tblKelas->user_update = $userid_login;
        $tblKelas->save(); // doing save here..

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('master.kelas.index');
    }
    public function kelasProsesDelete(Request $request)
    {
        // -- ambil dari form
        $form_oldid = $request->query('id_kelas');
        $tblKelas = MKelas::findOrFail($form_oldid);

        $tblKelas->delete();

        Session::flash('alert-success', 'Success Delete Data'); // kasih pesan success
        return redirect()->route('master.kelas.index');
    }
}
