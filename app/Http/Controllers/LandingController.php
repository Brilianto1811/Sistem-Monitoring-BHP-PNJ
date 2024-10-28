<?php

namespace App\Http\Controllers;

use App\Models\MBarang;
use App\Models\MPermintaanBarang;
use App\Models\MTrxBarang;
use App\Models\MTrxBarangPindah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\MKelas;
use App\Models\MJurusan;
use App\Models\MProdi;
use App\Models\MMahasiswa;
use App\Models\MLogin;

class LandingController extends Controller
{
    //
    public function index(Request $request) {
        $ldate = date('H:i:s');
        $tgl = Carbon::now()->translatedFormat('l, d F Y');
        $waktu = Carbon::now()->translatedFormat('H:i:s');
        return view('landing.index', ['waktu' => $waktu, 'tanggal' => $tgl]);
    }

    public function indexKaryawan(Request $request)
    {
        return view('landing.login-karyawan');
    }

    public function indexMahasiswa(Request $request)
    {
        return view('landing.login-mahasiswa');
    }

    public function dashboardKaryawan(Request $request)
    {
        $totalBarang = MBarang::select('id_barang')->where('status_barang', 'aktif')->count();
        $totalStokIN = MTrxBarang::select('id_trx')->where('tipe_trx', 'STOK_IN')->count();
        $totalStokOUT = MTrxBarang::select('id_trx')->where('tipe_trx', 'STOK_OUT')->count();
        $totalStokMOVING = MTrxBarangPindah::select('id_pindah')->count();

        $totalPermintaan = MPermintaanBarang::select('id_permintaan')->count();
        $totalPermintaanPending = MPermintaanBarang::select('id_permintaan')->where('status_permintaan', '0')->count();
        $totalPermintaanDiterima = MPermintaanBarang::select('id_permintaan')->where('status_permintaan', '1')->count();
        $totalPermintaanDitolak = MPermintaanBarang::select('id_permintaan')->where('status_permintaan', '2')->count();

        // dd($totalBarang);
        return view('landing.dashboard-karyawan', [
            'totalBarang' => $totalBarang,
            'totalStokIN' => $totalStokIN,
            'totalStokOUT' => $totalStokOUT,
            'totalStokMOVING' => $totalStokMOVING,
            'totalPermintaan' => $totalPermintaan,
            'totalPermintaanPending' => $totalPermintaanPending,
            'totalPermintaanDiterima' => $totalPermintaanDiterima,
            'totalPermintaanDitolak' => $totalPermintaanDitolak,
        ]);
    }

    public function dashboardMahasiswa(Request $request)
    {
        $userid_login = auth()->guard('mahasiswa')->user()->id_mahasiswa ?? null;

        $totalPermintaan = MPermintaanBarang::select('id_permintaan')->where('id_mahasiswa', $userid_login)->count();
        $totalPermintaanPending = MPermintaanBarang::select('id_permintaan')->where('status_permintaan', '0')->where('id_mahasiswa', $userid_login)->count();
        $totalPermintaanDiterima = MPermintaanBarang::select('id_permintaan')->where('status_permintaan', '1')->where('id_mahasiswa', $userid_login)->count();
        $totalPermintaanDitolak = MPermintaanBarang::select('id_permintaan')->where('status_permintaan', '2')->where('id_mahasiswa', $userid_login)->count();

        return view('landing.dashboard-mahasiswa', [
            'totalPermintaan' => $totalPermintaan,
            'totalPermintaanPending' => $totalPermintaanPending,
            'totalPermintaanDiterima' => $totalPermintaanDiterima,
            'totalPermintaanDitolak' => $totalPermintaanDitolak,
        ]);
    }

    public function loginKaryawan(Request $request)
    {
        $form_userid = $request->input('userid');
        $form_password = $request->input('password');
        if (auth()->guard('karyawan')->attempt(['userid' => $form_userid, 'password' => $form_password])) {
            $request->session()->regenerate();
            return redirect()->route('karyawan.dashboard');
        }
        return redirect()->back()->with('error', 'Username atau Password Salah');
    }

    public function loginMahasiswa(Request $request)
    {
        $form_nim = $request->input('nim');
        $form_password = $request->input('password');

        if (auth()->guard('mahasiswa')->attempt(['nim' => $form_nim, 'password' => $form_password])) {
            $request->session()->regenerate();
            return redirect()->route('mahasiswa.dashboard');
        }
        return redirect()->back()->with('error', 'NIM atau Password Salah');
    }

    public function logout(Request $request, $which = 'mahasiswa')
    {
        $viewRedirect = '/';
        if($which == 'mahasiswa') {
            Auth::guard('mahasiswa')->logout();
            $viewRedirect = 'mahasiswa.form-login';
        }
        if($which == 'karyawan') {
            Auth::guard('karyawan')->logout();
            $viewRedirect = 'karyawan.form-login';
        }
        $request->session()->regenerate();
        return redirect()->intended(route($viewRedirect));
    }

    public function profilMahasiswa(Request $request)
    {
        $form_id_mahasiswa = auth()->guard('mahasiswa')->user()->id_mahasiswa?? null;
        $dataMahasiswa = MMahasiswa::findOrFail($form_id_mahasiswa);
        $dataKelas = MKelas::find($dataMahasiswa->id_kelas);
        $dataProdi = MProdi::find($dataMahasiswa->id_prodi);
        $dataJurusan = MJurusan::find($dataMahasiswa->id_jurusan);
        return view('landing.profil-mahasiswa', ['dataMahasiswa' => $dataMahasiswa,'dataKelas' => $dataKelas, 'dataProdi' => $dataProdi, 'dataJurusan' => $dataJurusan]);
    }

    public function profilKaryawan(Request $request)
    {
        $form_id_login = auth()->guard('karyawan')->user()->id_login ?? null;
        $dataLogin = MLogin::findOrFail($form_id_login);
        return view('landing.profil-karyawan', ['dataLogin' => $dataLogin]);
    }
}
