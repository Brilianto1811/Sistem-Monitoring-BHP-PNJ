<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use App\Models\MKelas;
use App\Models\MJurusan;
use App\Models\MProdi;
use App\Models\MMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    //
    public function mahasiswaShow(Request $request)
    {
        # code...
        $dataMahasiswa = MMahasiswa::leftJoin('tbl_prodi', 'tbl_mahasiswa.id_prodi', '=', 'tbl_prodi.id_prodi')
                            ->leftJoin('tbl_jurusan', 'tbl_mahasiswa.id_jurusan', '=', 'tbl_jurusan.id_jurusan')
                            ->leftJoin('tbl_kelas', 'tbl_mahasiswa.id_kelas', '=', 'tbl_kelas.id_kelas')
                            ->select('tbl_mahasiswa.*', 'tbl_jurusan.nama_jurusan', 'tbl_prodi.nama_prodi', 'tbl_kelas.nama_kelas')

                            ->get(); // narik semua dari db kirim ke view
        return view('master.mahasiswa.index' , ['dataMahasiswa' => $dataMahasiswa]);
    }
    public function mahasiswaShowCreate(Request $request)
    {
        # code...
        $dataJurusan = MJurusan::all(); // narik semua dari db kirim ke view
        $dataProdi = MProdi::all(); // narik semua dari db kirim ke view
        $dataKelas = MKelas::all(); // narik semua dari db kirim ke view
        return view('master.mahasiswa.create', ['dataJurusan' => $dataJurusan, 'dataProdi' => $dataProdi, 'dataKelas' => $dataKelas]);
    }
    public function mahasiswaShowEdit(Request $request)
    {
         // -- ambil dari request id
         $form_id_mahasiswa = $request->query('id_mahasiswa', '');
         $dataMahasiswa = MMahasiswa::findOrFail($form_id_mahasiswa);
         $dataKelas = MKelas::all();
         $dataProdi = MProdi::all();
         $dataJurusan = MJurusan::all();
         return view('master.mahasiswa.edit', ['dataMahasiswa' => $dataMahasiswa,'dataKelas' => $dataKelas, 'dataProdi' => $dataProdi, 'dataJurusan' => $dataJurusan]);
    }
    public function mahasiswaShowDetail(Request $request)
    {
        $form_id_mahasiswa = $request->query('id_mahasiswa', '');
        $dataMahasiswa = MMahasiswa::find($form_id_mahasiswa);
        $dataKelas = MKelas::find($dataMahasiswa->id_kelas);
        $dataProdi = MProdi::find($dataMahasiswa->id_prodi);
        $dataJurusan = MJurusan::find($dataMahasiswa->id_jurusan);
        return view('master.mahasiswa.detail', ['dataMahasiswa' => $dataMahasiswa,'dataKelas' => $dataKelas, 'dataProdi' => $dataProdi, 'dataJurusan' => $dataJurusan]);
    }
    public function mahasiswaProsesAdd(Request $request)
    {
        # code...

        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;

        $form_nama_nim = $request->post('nama_nim');
        $form_nama_password = $request->post('nama_password');
        $form_nama_mahasiswa = $request->post('nama_mahasiswa');
        $form_nomor_telp = $request->post('nomor_telp');
        $form_nama_alamat = $request->post('nama_alamat');
        $form_nama_email = $request->post('nama_email');
        $form_id_jurusan = $request->post('id_jurusan');
        $form_id_prodi = $request->post('id_prodi');
        $form_id_kelas = $request->post('id_kelas');

        // -- tarik data lagi ke table
        $tblJurusan = MJurusan::find($form_id_jurusan);
        $tblProdi = MProdi::find($form_id_prodi);
        $tblKelas = MKelas::find($form_id_kelas);

        $nama_password_hash = Hash::make($form_nama_password);

        // -- set ke table
        $tblMahasiswa = new MMahasiswa();
        $tblMahasiswa->kode_jurusan = $tblJurusan->kode_jurusan;
        $tblMahasiswa->id_jurusan = $tblJurusan->id_jurusan;
        $tblMahasiswa->kode_prodi = $tblProdi->kode_prodi;
        $tblMahasiswa->id_prodi = $tblProdi->id_prodi;
        $tblMahasiswa->kode_kelas = $tblKelas->kode_kelas;
        $tblMahasiswa->id_kelas = $tblKelas->id_kelas;
        $tblMahasiswa->nim = $form_nama_nim;
        $tblMahasiswa->password = $nama_password_hash;
        $tblMahasiswa->nama_mahasiswa = $form_nama_mahasiswa;
        $tblMahasiswa->telp = $form_nomor_telp;
        $tblMahasiswa->alamat = $form_nama_alamat;
        $tblMahasiswa->email = $form_nama_email;

        $tblMahasiswa->user_create = $userid_login;
        // $tblMahasiswa->user_update = $userid_login;
        $tblMahasiswa->save(); // doing save here..

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('master.mahasiswa.index');
    }
    public function mahasiswaProsesEdit(Request $request)
    {
         # code...

         $userid_login = auth()->guard('karyawan')->user()->userid ?? null;
         $form_oldid = $request->post('oldid');

         $form_nama_nim = $request->post('nama_nim');
         $form_nama_password = $request->post('nama_password');
         $form_nama_mahasiswa = $request->post('nama_mahasiswa');
         $form_nomor_telp = $request->post('nomor_telp');
         $form_nama_alamat = $request->post('nama_alamat');
         $form_nama_email = $request->post('nama_email');
         $form_id_jurusan = $request->post('id_jurusan');
         $form_id_prodi = $request->post('id_prodi');
         $form_id_kelas = $request->post('id_kelas');

         // -- tarik data lagi ke table
         $tblJurusan = MJurusan::find($form_id_jurusan);
         $tblProdi = MProdi::find($form_id_prodi);
         $tblKelas = MKelas::find($form_id_kelas);

         $nama_password_hash = Hash::make($form_nama_password);

         // -- set ke table
         $tblMahasiswa = MMahasiswa::findOrFail($form_oldid);
         $tblMahasiswa->kode_jurusan = $tblJurusan->kode_jurusan;
         $tblMahasiswa->id_jurusan = $tblJurusan->id_jurusan;
         $tblMahasiswa->kode_prodi = $tblProdi->kode_prodi;
         $tblMahasiswa->id_prodi = $tblProdi->id_prodi;
         $tblMahasiswa->kode_kelas = $tblKelas->kode_kelas;
         $tblMahasiswa->id_kelas = $tblKelas->id_kelas;
         $tblMahasiswa->nim = $form_nama_nim;
         if($form_nama_password != '') { // jika dia mau ganti password maka kita update passwordnya
             $tblMahasiswa->password = $nama_password_hash;
         }
         $tblMahasiswa->nama_mahasiswa = $form_nama_mahasiswa;
         $tblMahasiswa->telp = $form_nomor_telp;
         $tblMahasiswa->alamat = $form_nama_alamat;
         $tblMahasiswa->email = $form_nama_email;

         //$tblMahasiswa->user_create = $userid_login;
         $tblMahasiswa->user_update = $userid_login;
         $tblMahasiswa->save(); // doing save here..

         Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
         return redirect()->route('master.mahasiswa.index');
    }
    public function mahasiswaProsesDelete(Request $request)
    {
        // -- ambil dari form
        $form_oldid = $request->query('id_mahasiswa');
        $tblMahasiswa = MMahasiswa::findOrFail($form_oldid);

        $tblMahasiswa->delete();

        Session::flash('alert-success', 'Success Delete Data'); // kasih pesan success
        return redirect()->route('master.mahasiswa.index');
    }
}
