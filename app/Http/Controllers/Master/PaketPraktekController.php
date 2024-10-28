<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MBarang;
use App\Models\MPaketPraktek;
use App\Models\MPaketPraktekDetail;
use App\Models\MTrxBarang;
use App\Models\MTrxBarangDetail;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;

class PaketPraktekController extends Controller
{
    //
    public function paketPraktekShow(Request $request)
    {
        # code...
        $dataPaketPraktek = MPaketPraktek::all();
        return view('master.paket_praktek.index', ['dataPaketPraktek' => $dataPaketPraktek]);
    }
    public function paketPraktekShowCreate(Request $request)
    {
        # code...
        $dataBarang = MBarang::all();
        return view('master.paket_praktek.create', ['dataBarang' => $dataBarang]);
    }
    public function paketPraktekShowEdit(Request $request)
    {
        // -- ambil dari request id
        $form_id_praktek = $request->query('id_praktek', '');

        $dataPaketPraktek = MPaketPraktek::findOrFail($form_id_praktek);
        $dataPaketPraktekDetail = MPaketPraktekDetail::where('id_praktek', '=', $form_id_praktek)->get();
        $dataBarang = MBarang::all();
        return view('master.paket_praktek.edit', ['dataBarang' => $dataBarang, 'dataPaketPraktek' => $dataPaketPraktek, 'dataPaketPraktekDetail' => $dataPaketPraktekDetail]);
    }
    public function paketPraktekShowDetail(Request $request)
    {
        // -- ambil dari request id
        $form_id_praktek = $request->query('id_praktek', '');

        $dataPaketPraktek = MPaketPraktek::findOrFail($form_id_praktek);
        $dataPaketPraktekDetail = MPaketPraktekDetail::where('id_praktek', '=', $form_id_praktek)->get();
        return view('master.paket_praktek.detail', ['dataPaketPraktek' => $dataPaketPraktek, 'dataPaketPraktekDetail' => $dataPaketPraktekDetail]);
    }
    public function paketPraktekProsesAdd(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_kode_prodi_login = auth()->guard('karyawan')->user()->user_kode_prodi ?? null;
        $user_nama_prodi_login = auth()->guard('karyawan')->user()->user_nama_prodi ?? null;

        // -- ambil dari form
        // $form_kode_barang = $request->post('kode_barang');
        $form_kode_praktek = $request->post('kode_praktek');
        $form_nama_praktek = $request->post('nama_praktek');
        $form_barang = $request->post('barang');
        $form_stok = $request->post('stok');

        $dataPaketPraktek = new MPaketPraktek();
        $dataPaketPraktek->kode_praktek = $form_kode_praktek;
        // $dataPaketPraktek->tipe_praktek = 0;
        $dataPaketPraktek->nama_praktek = $form_nama_praktek;
        // $dataPaketPraktek->ket = 0;
        $dataPaketPraktek->user_id_prodi = $user_id_prodi_login;
        $dataPaketPraktek->user_kode_prodi = $user_kode_prodi_login;
        $dataPaketPraktek->user_nama_prodi = $user_nama_prodi_login;
        $dataPaketPraktek->user_create = $userid_login;
        // $dataPaketPraktek->user_update = 0;
        $dataPaketPraktek->save();

        $dataPaketPraktekDetail = [];
        foreach($form_barang as $index => $value) {
            $dataBarang = MBarang::find($value);
            // dd($dataBarang);
            $tmpDataPaketPraktekDetail = new MPaketPraktekDetail();
            $tmpDataPaketPraktekDetail->id_praktek = $dataPaketPraktek->id_praktek;
            $tmpDataPaketPraktekDetail->norut = $index + 1;
            $tmpDataPaketPraktekDetail->id_barang = $dataBarang->id_barang;
            $tmpDataPaketPraktekDetail->kode_barang = $dataBarang->kode_barang;
            $tmpDataPaketPraktekDetail->nama_barang = $dataBarang->nama_barang;
            $tmpDataPaketPraktekDetail->qty = $form_stok[$index];
            // $tmpDataPaketPraktekDetail->nama_praktek_detail = 0;
            // $tmpDataPaketPraktekDetail->ket = 0;
            $tmpDataPaketPraktekDetail->user_id_prodi = $user_id_prodi_login;
            $tmpDataPaketPraktekDetail->user_kode_prodi = $user_kode_prodi_login;
            $tmpDataPaketPraktekDetail->user_nama_prodi = $user_nama_prodi_login;
            $tmpDataPaketPraktekDetail->user_create = $userid_login;
            // $tmpDataPaketPraktekDetail->user_update = 0;
            array_push($dataPaketPraktekDetail, $tmpDataPaketPraktekDetail);
        }
        // dd($dataPaketPraktekDetail);

        foreach($dataPaketPraktekDetail as $index => $value) {
            $value->save();
        }

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('master.paket-praktek.index');
    }
    public function paketPraktekProsesEdit(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_kode_prodi_login = auth()->guard('karyawan')->user()->user_kode_prodi ?? null;
        $user_nama_prodi_login = auth()->guard('karyawan')->user()->user_nama_prodi ?? null;

        // -- ambil dari form
        $form_oldid = $request->post('oldid');
        // $form_kode_barang = $request->post('kode_barang');
        $form_kode_praktek = $request->post('kode_praktek');
        $form_nama_praktek = $request->post('nama_praktek');
        $form_barang = $request->post('barang');
        $form_stok = $request->post('stok');

        $dataPaketPraktek = MPaketPraktek::findOrFail($form_oldid);
        $dataPaketPraktek->kode_praktek = $form_kode_praktek;
        // $dataPaketPraktek->tipe_praktek = 0;
        $dataPaketPraktek->nama_praktek = $form_nama_praktek;
        // $dataPaketPraktek->ket = 0;
        $dataPaketPraktek->user_id_prodi = $user_id_prodi_login;
        $dataPaketPraktek->user_kode_prodi = $user_kode_prodi_login;
        $dataPaketPraktek->user_nama_prodi = $user_nama_prodi_login;
        // $dataPaketPraktek->user_create = $userid_login;
        $dataPaketPraktek->user_update = $userid_login;
        $dataPaketPraktek->save();

        $dataPaketPraktekDetail = [];
        foreach($form_barang as $index => $value) {
            $dataBarang = MBarang::find($value);
            // dd($dataBarang);
            $tmpDataPaketPraktekDetail = new MPaketPraktekDetail();
            $tmpDataPaketPraktekDetail->id_praktek = $dataPaketPraktek->id_praktek;
            $tmpDataPaketPraktekDetail->norut = $index + 1;
            $tmpDataPaketPraktekDetail->id_barang = $dataBarang->id_barang;
            $tmpDataPaketPraktekDetail->kode_barang = $dataBarang->kode_barang;
            $tmpDataPaketPraktekDetail->nama_barang = $dataBarang->nama_barang;
            $tmpDataPaketPraktekDetail->qty = $form_stok[$index];
            // $tmpDataPaketPraktekDetail->nama_praktek_detail = 0;
            // $tmpDataPaketPraktekDetail->ket = 0;
            $tmpDataPaketPraktekDetail->user_id_prodi = $user_id_prodi_login;
            $tmpDataPaketPraktekDetail->user_kode_prodi = $user_kode_prodi_login;
            $tmpDataPaketPraktekDetail->user_nama_prodi = $user_nama_prodi_login;
            $tmpDataPaketPraktekDetail->user_create = $userid_login;
            // $tmpDataPaketPraktekDetail->user_update = 0;
            array_push($dataPaketPraktekDetail, $tmpDataPaketPraktekDetail);
        }
        // dd($dataPaketPraktekDetail);

        MPaketPraktekDetail::where('id_praktek', '=', $form_oldid)->each(function ($val, $key) {
            $val->delete();
        });
        foreach($dataPaketPraktekDetail as $index => $value) {
            $value->save();
        }

        Session::flash('alert-success', 'Success Edit Data'); // kasih pesan success
        return redirect()->route('master.paket-praktek.index');
    }
    public function paketPraktekProsesDelete(Request $request)
    {
         // -- ambil dari form
         $form_oldid = $request->query('id_praktek');
         $tbl = MPaketPraktek::findOrFail($form_oldid);

         $tbl->delete();

         Session::flash('alert-success', 'Success Delete Data'); // kasih pesan success
         return redirect()->route('master.paket-praktek.index');
    }
}
