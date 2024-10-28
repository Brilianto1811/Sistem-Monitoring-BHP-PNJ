<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestingLoginController extends Controller
{
    public function indexKaryawan(Request $request)
    {
        return view('ujicoba.login_karyawan');
    }

    public function indexMahasiswa(Request $request)
    {
        return view('ujicoba.login_mahasiswa');
    }

    public function dashboardKaryawan(Request $request)
    {
        return view('ujicoba.karyawan.index_karyawan');
    }

    public function dashboardMahasiswa(Request $request)
    {
        return view('ujicoba.mahasiswa.index_mahasiswa');
    }

    public function loginKaryawan(Request $request)
    {
        $form_userid = $request->input('userid');
        $form_password = $request->input('password');
        if (auth()->guard('karyawan')->attempt(['userid' => $form_userid, 'password' => $form_password])) {
            $request->session()->regenerate();
            return redirect()->route('karyawan.dashboard');
        } else {
            dd('Username dan Password salah!');
        }
    }

    public function loginMahasiswa(Request $request)
    {
        $form_nim = $request->input('nim');
        $form_password = $request->input('password');

        if (auth()->guard('mahasiswa')->attempt(['nim' => $form_nim, 'password' => $form_password])) {
            $request->session()->regenerate();
            return redirect()->route('mahasiswa.dashboard');
        } else {
            dd('Username dan Password salah!');
        }
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
}
