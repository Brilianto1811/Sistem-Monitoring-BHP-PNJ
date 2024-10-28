<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\MBarang;
use App\Models\MGedung;
use App\Models\MJurusan;
use App\Models\MTrxBarang;
use App\Models\MTrxBarangDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;

class StokController extends Controller
{

    // ▄▄▄▄▄▄▄▄▄▄▄  ▄▄▄▄▄▄▄▄▄▄▄  ▄▄▄▄▄▄▄▄▄▄▄  ▄    ▄       ▄▄▄▄▄▄▄▄▄▄▄  ▄▄        ▄
    // ▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌▐░▌  ▐░▌     ▐░░░░░░░░░░░▌▐░░▌      ▐░▌
    // ▐░█▀▀▀▀▀▀▀▀▀  ▀▀▀▀█░█▀▀▀▀ ▐░█▀▀▀▀▀▀▀█░▌▐░▌ ▐░▌       ▀▀▀▀█░█▀▀▀▀ ▐░▌░▌     ▐░▌
    // ▐░▌               ▐░▌     ▐░▌       ▐░▌▐░▌▐░▌            ▐░▌     ▐░▌▐░▌    ▐░▌
    // ▐░█▄▄▄▄▄▄▄▄▄      ▐░▌     ▐░▌       ▐░▌▐░▌░▌             ▐░▌     ▐░▌ ▐░▌   ▐░▌
    // ▐░░░░░░░░░░░▌     ▐░▌     ▐░▌       ▐░▌▐░░▌              ▐░▌     ▐░▌  ▐░▌  ▐░▌
    //  ▀▀▀▀▀▀▀▀▀█░▌     ▐░▌     ▐░▌       ▐░▌▐░▌░▌             ▐░▌     ▐░▌   ▐░▌ ▐░▌
    //           ▐░▌     ▐░▌     ▐░▌       ▐░▌▐░▌▐░▌            ▐░▌     ▐░▌    ▐░▌▐░▌
    //  ▄▄▄▄▄▄▄▄▄█░▌     ▐░▌     ▐░█▄▄▄▄▄▄▄█░▌▐░▌ ▐░▌       ▄▄▄▄█░█▄▄▄▄ ▐░▌     ▐░▐░▌
    // ▐░░░░░░░░░░░▌     ▐░▌     ▐░░░░░░░░░░░▌▐░▌  ▐░▌     ▐░░░░░░░░░░░▌▐░▌      ▐░░▌
    //  ▀▀▀▀▀▀▀▀▀▀▀       ▀       ▀▀▀▀▀▀▀▀▀▀▀  ▀    ▀       ▀▀▀▀▀▀▀▀▀▀▀  ▀        ▀▀
    public function stokInShow(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;

        $dataTransaksi = MTrxBarang::where('tipe_trx', 'STOK_IN');
        if($user_level == 'operator') {
            $dataTransaksi->where('user_id_prodi', '=', $user_id_prodi_login);
        }

        $dataTransaksi = $dataTransaksi->orderBy('id_trx', 'DESC')->offset(0)->limit(100)->get();
        return view('transaksi.stok.in.index', ['dataTransaksi' => $dataTransaksi]);
    }
    public function stokInShowCreate(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;

        $dataBarang = MBarang::all();
        if($user_level == 'operator') {
            $dataBarang = MBarang::where('user_id_prodi', '=', $user_id_prodi_login)->get();
        }
        return view('transaksi.stok.in.create', ['dataBarang' => $dataBarang]);
    }
    public function stokInShowEdit(Request $request)
    {
        # code...
        // return view('transaksi.stokIn.edit');
    }
    public function stokInShowDetail(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;
        $form_id_trx = $request->query('id_trx', '');

        $dataTransaksi = MTrxBarang::findOrFail($form_id_trx);
        if($user_level == 'operator') {
            if($dataTransaksi->user_id_prodi != $user_id_prodi_login) {
                return abort(404);
            }
        }
        $dataTransaksiDetail = MTrxBarangDetail::where('id_trx', $dataTransaksi->id_trx)->get();
        return view('transaksi.stok.in.detail', ['dataTransaksi' => $dataTransaksi, 'dataTransaksiDetail' => $dataTransaksiDetail]);
    }
    public function stokInProsesAdd(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_kode_prodi_login = auth()->guard('karyawan')->user()->user_kode_prodi ?? null;
        $user_nama_prodi_login = auth()->guard('karyawan')->user()->user_nama_prodi ?? null;

        // -- ambil dari form
        // $form_kode_barang = $request->post('kode_barang');
        $form_barang = $request->post('barang');
        $form_stok = $request->post('stok');
        $form_keterangan = $request->post('keterangan');
        // dd($form_stok);
        // dd($request);
        // var_dump($form_barang);
        $patokanBarang = [];
        $detailBarang = [];
        $data = [];
        foreach($form_barang as $index => $value) {
            $dataBarang = MBarang::find($value); // id_barang
            $dataStok = $form_stok[$index];
            // print_r($dataBarang);
            // var_dump($value);
            // var_dump(in_array($value, $data));
            print_r($dataStok);
            echo '<br/>';
            $patokanBarang[$value] = $dataBarang;
            // print_r($data);
            // echo '<hr/>';
            // if(isset($value, $data, true)) { // jika baru awal set dari db
                //     $data[$value] = $dataStok + $dataBarang->stok_sekarang;
                // }else {
                    //     $data[$value] += $dataStok;
                    // }
            // if(!in_array($value, $data)) {
            //     $data[$value] = intval($dataStok);
            // }else {
            // }
            // [BUG] kalau baru awal di set, kalo setelah itu di++
            try {
                $data[$value] += $dataStok;
            } catch (\Throwable $th) {
                $data[$value] = $dataStok;
            }
            array_push($detailBarang, $dataBarang);
        }
        // print_r($patokanBarang);
        // print_r($data);
        // echo '<hr/>';

        //
        foreach($patokanBarang as $index => $value) {
            $data[$value->id_barang] += intval($value->stok_sekarang);
            // var_dump($value->stok_sekarang);
            // var_dump($data[$value->id_barang]);
            // echo '<hr/>';
            // $data[$value->id_barang] = $data[$value->id_barang] + $value->stok_sekarang;
        }
        print_r($data);
        // dd($patokanBarang);
        // dd(1);
        // $form_nama_barang = $request->post('nama_barang');

        // $form_unit = $request->post('unit');
        // $form_stok_awal = $request->post('stok_awal');
        // $form_lokasi_sekarang = $request->post('lokasi_sekarang');

        // $dataLokasi = MLokasi::find($form_lokasi_sekarang);
        $dataModelBarang = [];
        foreach($patokanBarang as $index => $value) {
            $tblBarang = MBarang::find($index);
            // dd($value);
            $tblBarang->stok_sebelumnya = $value->stok_sekarang;
            $tblBarang->stok_sekarang = $data[$value->id_barang];
            $tblBarang->user_update = $userid_login;
            array_push($dataModelBarang, $tblBarang);
            // if($index == 2) {
            //     dd($dataModelBarang);
            // }
        }
        // dd($dataModelBarang);
        // foreach($dataModelBarang as $index => $value) {
        //     $value->save();
        // }

        // // -- set ke table

        // // -- BUAT TRX [CREATE] -- \\
        $uuidTrx = Uuid::uuid4()->toString();
        $dateKodeTrx = Carbon::now()->format('YmdHisu');
        $list_idBarang = collect($dataModelBarang)->pluck('id_barang')->toArray();
        $list_kodeBarang = collect($dataModelBarang)->pluck('kode_barang')->toArray();

        $tblTransaksi = new MTrxBarang();
        $tblTransaksi->kode_trx = 'SI#'.$dateKodeTrx;
        $tblTransaksi->tipe_trx = 'STOK_IN';
        $tblTransaksi->ket = $form_keterangan.'<br/><br/>STOK IN BARANG #'.implode(',', $list_kodeBarang ?? []);
        $tblTransaksi->user_create = $userid_login;

        $tblTransaksi->user_id_prodi = $user_id_prodi_login;
        $tblTransaksi->user_kode_prodi = $user_kode_prodi_login;
        $tblTransaksi->user_nama_prodi = $user_nama_prodi_login;

        // $tblTransaksi->user_update = ;
        $tblTransaksi->uid = $uuidTrx;
        $tblTransaksi->save();

        $dataModelTrxBarangDetail = [];
        foreach($detailBarang as $nomor => $value) {
            // $tblTransaksi = MBarang::find($value->id_barang);
            $tblTransaksiDetail = new MTrxBarangDetail();
            $tblTransaksiDetail->id_trx = $tblTransaksi->id_trx;
            $tblTransaksiDetail->kode_trx = $tblTransaksi->kode_trx;
            $tblTransaksiDetail->norut = $nomor + 1;
            $tblTransaksiDetail->id_barang = $value->id_barang;
            $tblTransaksiDetail->kode_barang = $value->kode_barang;
            $tblTransaksiDetail->nama_barang = $value->nama_barang;
            $tblTransaksiDetail->stok = $form_stok[$nomor];

            $tblTransaksiDetail->user_id_prodi = $user_id_prodi_login;
            $tblTransaksiDetail->user_kode_prodi = $user_kode_prodi_login;
            $tblTransaksiDetail->user_nama_prodi = $user_nama_prodi_login;

            array_push($dataModelTrxBarangDetail, $tblTransaksiDetail);
        }
        foreach($dataModelTrxBarangDetail as $index => $value) {
            $value->save();
        }

        // -- barangnya update -- \\
        $dataBarangDetail = [];
        foreach($dataModelBarang as $index => $value) {
            $value->id_trx_last = $tblTransaksi->id_trx;
            $value->kode_trx_last = $tblTransaksi->kode_trx;
            $value->tipe_trx_last = 'STOK_IN';
            array_push($dataBarangDetail, $value);
        }
        foreach($dataBarangDetail as $index => $value) {
            $value->save();
        }

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('transaksi.stok.in.index');
    }
    public function stokInProsesEdit(Request $request)
    {
        # code...
        // return view('transaksi.stokIn.proses-edit');
    }
    public function stokInProsesDelete(Request $request)
    {
        # code...
        // return view('transaksi.stokIn.proses-delete');
    }

    // ▄▄▄▄▄▄▄▄▄▄▄  ▄▄▄▄▄▄▄▄▄▄▄  ▄▄▄▄▄▄▄▄▄▄▄  ▄    ▄       ▄▄▄▄▄▄▄▄▄▄▄  ▄         ▄  ▄▄▄▄▄▄▄▄▄▄▄
    // ▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌▐░▌  ▐░▌     ▐░░░░░░░░░░░▌▐░▌       ▐░▌▐░░░░░░░░░░░▌
    // ▐░█▀▀▀▀▀▀▀▀▀  ▀▀▀▀█░█▀▀▀▀ ▐░█▀▀▀▀▀▀▀█░▌▐░▌ ▐░▌      ▐░█▀▀▀▀▀▀▀█░▌▐░▌       ▐░▌ ▀▀▀▀█░█▀▀▀▀
    // ▐░▌               ▐░▌     ▐░▌       ▐░▌▐░▌▐░▌       ▐░▌       ▐░▌▐░▌       ▐░▌     ▐░▌
    // ▐░█▄▄▄▄▄▄▄▄▄      ▐░▌     ▐░▌       ▐░▌▐░▌░▌        ▐░▌       ▐░▌▐░▌       ▐░▌     ▐░▌
    // ▐░░░░░░░░░░░▌     ▐░▌     ▐░▌       ▐░▌▐░░▌         ▐░▌       ▐░▌▐░▌       ▐░▌     ▐░▌
    //  ▀▀▀▀▀▀▀▀▀█░▌     ▐░▌     ▐░▌       ▐░▌▐░▌░▌        ▐░▌       ▐░▌▐░▌       ▐░▌     ▐░▌
    //           ▐░▌     ▐░▌     ▐░▌       ▐░▌▐░▌▐░▌       ▐░▌       ▐░▌▐░▌       ▐░▌     ▐░▌
    //  ▄▄▄▄▄▄▄▄▄█░▌     ▐░▌     ▐░█▄▄▄▄▄▄▄█░▌▐░▌ ▐░▌      ▐░█▄▄▄▄▄▄▄█░▌▐░█▄▄▄▄▄▄▄█░▌     ▐░▌
    // ▐░░░░░░░░░░░▌     ▐░▌     ▐░░░░░░░░░░░▌▐░▌  ▐░▌     ▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌     ▐░▌
    //  ▀▀▀▀▀▀▀▀▀▀▀       ▀       ▀▀▀▀▀▀▀▀▀▀▀  ▀    ▀       ▀▀▀▀▀▀▀▀▀▀▀  ▀▀▀▀▀▀▀▀▀▀▀       ▀
    public function stokOutShow(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;

        $dataTransaksi = MTrxBarang::whereIn('tipe_trx', ['STOK_OUT', 'STOK_OUT_MAHASISWA']);
        if($user_level == 'operator') {
            $dataTransaksi->where('user_id_prodi', '=', $user_id_prodi_login);
        }

        $dataTransaksi = $dataTransaksi->orderBy('id_trx', 'DESC')->offset(0)->limit(100)->get();
        return view('transaksi.stok.out.index', ['dataTransaksi' => $dataTransaksi]);
    }
    public function stokOutShowCreate(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;

        $dataBarang = MBarang::all();
        if($user_level == 'operator') {
            $dataBarang = MBarang::where('user_id_prodi', '=', $user_id_prodi_login)->get();
        }
        return view('transaksi.stok.out.create', ['dataBarang' => $dataBarang]);
    }
    public function stokOutShowEdit(Request $request)
    {
        # code...
        // return view('transaksi.stokOut.edit');
    }
    public function stokOutShowDetail(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;
        $form_id_trx = $request->query('id_trx', '');

        $dataTransaksi = MTrxBarang::findOrFail($form_id_trx);
        if($user_level == 'operator') {
            if($dataTransaksi->user_id_prodi != $user_id_prodi_login) {
                return abort(404);
            }
        }
        $dataTransaksiDetail = MTrxBarangDetail::where('id_trx', $dataTransaksi->id_trx)->get();
        // MBlok::leftJoin('tbl_gudang', 'tbl_blok.id_gudang', '=', 'tbl_gudang.id_gudang')
        // ->leftJoin('tbl_gedung', 'tbl_blok.id_gedung', '=', 'tbl_gedung.id_gedung')
        // ->select('tbl_blok.*', 'tbl_gedung.nama_gedung', 'tbl_gudang.nama_gudang')
        // ->get();
        $dataTrxReqMhs = MTrxBarang::leftJoin('tbl_permintaan_barang', 'tbl_trx_barang.trxfrom', '=', 'tbl_permintaan_barang.id_permintaan')
                        ->select('tbl_trx_barang.*', 'tbl_permintaan_barang.kode_permintaan')->where('id_permintaan', $dataTransaksi->trxfrom)->latest()->first();
        return view('transaksi.stok.out.detail', ['dataTransaksi' => $dataTransaksi, 'dataTransaksiDetail' => $dataTransaksiDetail, 'dataTrxReqMhs' => $dataTrxReqMhs]);
    }
    public function stokOutProsesAdd(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_kode_prodi_login = auth()->guard('karyawan')->user()->user_kode_prodi ?? null;
        $user_nama_prodi_login = auth()->guard('karyawan')->user()->user_nama_prodi ?? null;

        // -- ambil dari form
        // $form_kode_barang = $request->post('kode_barang');
        $form_barang = $request->post('barang');
        $form_stok = $request->post('stok');
        $form_keterangan = $request->post('keterangan');
        // dd($form_stok);
        // dd($request);
        // var_dump($form_barang);
        $patokanBarang = [];
        $detailBarang = [];
        $data = [];
        foreach($form_barang as $index => $value) {
            $dataBarang = MBarang::find($value); // id_barang
            $dataStok = $form_stok[$index];
            // print_r($dataBarang);
            // var_dump($value);
            // var_dump(in_array($value, $data));
            // print_r($dataStok);
            // echo '<br/>';
            $patokanBarang[$value] = $dataBarang;
            // print_r($data);
            // echo '<hr/>';
            // if(isset($value, $data, true)) { // jika baru awal set dari db
                //     $data[$value] = $dataStok + $dataBarang->stok_sekarang;
                // }else {
                    //     $data[$value] += $dataStok;
                    // }
            // if(!in_array($value, $data)) {
            //     $data[$value] = intval($dataStok);
            // }else {
            // }
            // [BUG] kalau baru awal di set, kalo setelah itu di++
            try {
                $data[$value] += $dataStok;
            } catch (\Throwable $th) {
                $data[$value] = $dataStok;
            }
            array_push($detailBarang, $dataBarang);
        }
        // print_r($patokanBarang);
        // print_r($data);
        // echo '<hr/>';

        //
        foreach($patokanBarang as $index => $value) {
            $data[$value->id_barang] = intval($value->stok_sekarang) - $data[$value->id_barang];
            // var_dump($value->stok_sekarang);
            // var_dump($data[$value->id_barang]);
            // echo '<hr/>';
            // $data[$value->id_barang] = $data[$value->id_barang] + $value->stok_sekarang;
        }
        // print_r($data);
        // dd($patokanBarang);
        // dd(1);
        // $form_nama_barang = $request->post('nama_barang');

        // $form_unit = $request->post('unit');
        // $form_stok_awal = $request->post('stok_awal');
        // $form_lokasi_sekarang = $request->post('lokasi_sekarang');

        // $dataLokasi = MLokasi::find($form_lokasi_sekarang);
        $dataModelBarang = [];
        foreach($patokanBarang as $index => $value) {
            $tblBarang = MBarang::find($index);
            // dd($value);
            $tblBarang->stok_sebelumnya = $value->stok_sekarang;
            $tblBarang->stok_sekarang = $data[$value->id_barang];
            $tblBarang->user_update = $userid_login;
            array_push($dataModelBarang, $tblBarang);
            // if($index == 2) {
            //     dd($dataModelBarang);
            // }
        }
        // dd($dataModelBarang);
        foreach($dataModelBarang as $index => $value) {
            $value->save();
        }

        // // -- set ke table

        // // -- BUAT TRX [CREATE] -- \\
        $uuidTrx = Uuid::uuid4()->toString();
        $dateKodeTrx = Carbon::now()->format('YmdHisu');
        $list_idBarang = collect($dataModelBarang)->pluck('id_barang')->toArray();
        $list_kodeBarang = collect($dataModelBarang)->pluck('kode_barang')->toArray();

        $tblTransaksi = new MTrxBarang();
        $tblTransaksi->kode_trx = 'SO#'.$dateKodeTrx;
        $tblTransaksi->tipe_trx = 'STOK_OUT';
        $tblTransaksi->ket = $form_keterangan.'<br/><br/>STOK OUT BARANG #'.implode(',', $list_kodeBarang ?? []);

        $tblTransaksi->user_id_prodi = $user_id_prodi_login;
        $tblTransaksi->user_kode_prodi = $user_kode_prodi_login;
        $tblTransaksi->user_nama_prodi = $user_nama_prodi_login;

        $tblTransaksi->user_create = $userid_login;
        // $tblTransaksi->user_update = ;
        $tblTransaksi->uid = $uuidTrx;
        $tblTransaksi->save();

        $dataModelTrxBarangDetail = [];
        foreach($detailBarang as $nomor => $value) {
            // $tblTransaksi = MBarang::find($value->id_barang);
            $tblTransaksiDetail = new MTrxBarangDetail();
            $tblTransaksiDetail->id_trx = $tblTransaksi->id_trx;
            $tblTransaksiDetail->kode_trx = $tblTransaksi->kode_trx;
            $tblTransaksiDetail->norut = $nomor + 1;
            $tblTransaksiDetail->id_barang = $value->id_barang;
            $tblTransaksiDetail->kode_barang = $value->kode_barang;
            $tblTransaksiDetail->nama_barang = $value->nama_barang;
            $tblTransaksiDetail->stok = $form_stok[$nomor];

            $tblTransaksiDetail->user_id_prodi = $user_id_prodi_login;
            $tblTransaksiDetail->user_kode_prodi = $user_kode_prodi_login;
            $tblTransaksiDetail->user_nama_prodi = $user_nama_prodi_login;

            array_push($dataModelTrxBarangDetail, $tblTransaksiDetail);
        }
        foreach($dataModelTrxBarangDetail as $index => $value) {
            $value->save();
        }

        // -- barangnya update -- \\
        $dataBarangDetail = [];
        foreach($dataModelBarang as $index => $value) {
            $value->id_trx_last = $tblTransaksi->id_trx;
            $value->kode_trx_last = $tblTransaksi->kode_trx;
            $value->tipe_trx_last = 'STOK_OUT';
            array_push($dataBarangDetail, $value);
        }
        foreach($dataBarangDetail as $index => $value) {
            $value->save();
        }

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('transaksi.stok.out.index');
    }
    public function stokOutProsesEdit(Request $request)
    {
        # code...
        // return view('transaksi.stokOut.proses-edit');
    }
    public function stokOutProsesDelete(Request $request)
    {
        # code...
        // return view('transaksi.stokOut.proses-delete');
    }
}
