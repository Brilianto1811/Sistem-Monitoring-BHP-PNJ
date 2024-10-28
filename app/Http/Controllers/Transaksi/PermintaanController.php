<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\MJurusan;
use App\Models\MProdi;
use App\Models\MKelas;
use App\Models\MBarang;
use App\Models\MMahasiswa;
use App\Models\MPaketPraktek;
use App\Models\MPaketPraktekDetail;
use App\Models\MPermintaanBarang;
use App\Models\MPermintaanBarangDetail;
use App\Models\MTrxBarang;
use App\Models\MTrxBarangDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;

class PermintaanController extends Controller
{

//  ▄▄▄▄▄▄▄▄▄▄▄  ▄▄▄▄▄▄▄▄▄▄   ▄▄       ▄▄  ▄▄▄▄▄▄▄▄▄▄▄  ▄▄        ▄
//  ▐░░░░░░░░░░░▌▐░░░░░░░░░░▌ ▐░░▌     ▐░░▌▐░░░░░░░░░░░▌▐░░▌      ▐░▌
//  ▐░█▀▀▀▀▀▀▀█░▌▐░█▀▀▀▀▀▀▀█░▌▐░▌░▌   ▐░▐░▌ ▀▀▀▀█░█▀▀▀▀ ▐░▌░▌     ▐░▌
//  ▐░▌       ▐░▌▐░▌       ▐░▌▐░▌▐░▌ ▐░▌▐░▌     ▐░▌     ▐░▌▐░▌    ▐░▌
//  ▐░█▄▄▄▄▄▄▄█░▌▐░▌       ▐░▌▐░▌ ▐░▐░▌ ▐░▌     ▐░▌     ▐░▌ ▐░▌   ▐░▌
//  ▐░░░░░░░░░░░▌▐░▌       ▐░▌▐░▌  ▐░▌  ▐░▌     ▐░▌     ▐░▌  ▐░▌  ▐░▌
//  ▐░█▀▀▀▀▀▀▀█░▌▐░▌       ▐░▌▐░▌   ▀   ▐░▌     ▐░▌     ▐░▌   ▐░▌ ▐░▌
//  ▐░▌       ▐░▌▐░▌       ▐░▌▐░▌       ▐░▌     ▐░▌     ▐░▌    ▐░▌▐░▌
//  ▐░▌       ▐░▌▐░█▄▄▄▄▄▄▄█░▌▐░▌       ▐░▌ ▄▄▄▄█░█▄▄▄▄ ▐░▌     ▐░▐░▌
//  ▐░▌       ▐░▌▐░░░░░░░░░░▌ ▐░▌       ▐░▌▐░░░░░░░░░░░▌▐░▌      ▐░░▌
//   ▀         ▀  ▀▀▀▀▀▀▀▀▀▀   ▀         ▀  ▀▀▀▀▀▀▀▀▀▀▀  ▀        ▀▀
    // -- Permintaan Terima Admin -- \\
    public function permintaanTerimaShow(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;

        $dataPermintaan = MPermintaanBarang::leftJoin('tbl_mahasiswa', 'tbl_permintaan_barang.id_mahasiswa', '=', 'tbl_mahasiswa.id_mahasiswa')
                                            ->leftJoin('tbl_jurusan', 'tbl_permintaan_barang.id_jurusan', '=', 'tbl_jurusan.id_jurusan')
                                            ->leftJoin('tbl_prodi', 'tbl_permintaan_barang.id_prodi', '=', 'tbl_prodi.id_prodi')
                                            ->leftJoin('tbl_kelas', 'tbl_permintaan_barang.id_kelas', '=', 'tbl_kelas.id_kelas')
                                            ->select('tbl_permintaan_barang.*')
                                            ->addSelect('tbl_jurusan.kode_jurusan', 'tbl_prodi.kode_prodi', 'tbl_kelas.kode_kelas', 'tbl_jurusan.nama_jurusan', 'tbl_prodi.nama_prodi', 'tbl_kelas.nama_kelas');
                                            // ->orderBy('created_at', 'desc')
                                            // // ->toSql();
                                            // ->get();
                                            // dd($dataPermintaan);
        if($user_level == 'operator') {
            $dataPermintaan->where('tbl_permintaan_barang.id_prodi', '=', $user_id_prodi_login);
        }
        $dataPermintaan = $dataPermintaan->orderBy('created_at', 'desc')->get();
        return view('transaksi.permintaan.terima.index', ['dataPermintaan' => $dataPermintaan]);
    }
    public function permintaanTerimaVerifikasiShow(Request $request)
    {
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_level = auth()->guard('karyawan')->user()->level ?? null;

        $form_id_permintaan = $request->query('id_trx', '');

        $dataPermintaan = MPermintaanBarang::findOrFail($form_id_permintaan);
        if($user_level == 'operator') {
            if($dataPermintaan->id_prodi != $user_id_prodi_login) {
                return abort(404);
            }
        }
        $dataPermintaanDetail = MPermintaanBarangDetail::where('id_permintaan', $dataPermintaan->id_permintaan)->get();
        return view('transaksi.permintaan.terima.verifikasi', ['dataPermintaan' => $dataPermintaan, 'dataPermintaanDetail' => $dataPermintaanDetail]);
    }
    public function permintaanTerimaProsesVerifikasi(Request $request)
    {
        $userid_login = auth()->guard('karyawan')->user()->userid ?? null;
        $user_id_prodi_login = auth()->guard('karyawan')->user()->user_id_prodi ?? null;
        $user_kode_prodi_login = auth()->guard('karyawan')->user()->user_kode_prodi ?? null;
        $user_nama_prodi_login = auth()->guard('karyawan')->user()->user_nama_prodi ?? null;

        $form_oldid = $request->oldid;
        $form_status = $request->status;

        $status = ($form_status == 'terima')? '1' : '2'; //  1: terima | 2: tolak

        $dataPermintaan = MPermintaanBarang::findOrFail($form_oldid);

        // jika sudah diverifikasi
        if(in_array($dataPermintaan->status_permintaan, ['1', '2'])) {
            Session::flash('alert-warning', 'Uppss Data Sudah di Verifikasi'); // kasih pesan
            return redirect()->route('transaksi.permintaan.terima.index');
        }

        // jika ditolak
        $dataPermintaan->user_update = $userid_login;
        if($status == '2') {
            $dataPermintaan->status_permintaan = $status;
            $dataPermintaan->save();
            Session::flash('alert-success', 'Success Verifikasi Data'); // kasih pesan
            return redirect()->route('transaksi.permintaan.terima.index');
        }

        // -- jika diterima kebawah sini sampe bawah
        $dataPermintaanDetail = MPermintaanBarangDetail::where('id_permintaan', $dataPermintaan->id_permintaan)->get();

        // setup stok dulu
        $dataStok = [];
        foreach($dataPermintaanDetail as $index => $value) {
            try{
                $dataStok[$value->id_barang] += intval($value->qty);
            }catch(\Throwable $th) {
                $dataStok[$value->id_barang] = intval($value->qty);
            }
        }
        // dd($dataStok);
        $dataStokBarang = [];
        foreach($dataStok as $index => $value) {
            $tblBarang = MBarang::findOrFail($index);
            $tblBarang->stok_sebelumnya = $tblBarang->stok_sekarang;
            $tblBarang->stok_sekarang = intval($tblBarang->stok_sekarang) - intval($value);
            $tblBarang->user_update = $userid_login;
            array_push($dataStokBarang, $tblBarang);
        }
        // foreach($dataStokBarang as $index => $value) {
        //     $value->save();
        // }


        // select semua data barang dulu dari db
        $dataBarang = [];
        foreach($dataPermintaanDetail as $index => $value) {
            $tblBarang = MBarang::findOrFail($value->id_barang);
            array_push($dataBarang, $tblBarang);
        }
        // dd($dataBarang);

        // update statusnya & kurangin stoknya satu satu
        $dataPermintaan->status_permintaan = $status;
        // foreach($dataPermintaanDetail as $index => $value) {
        //     $tblBarang = $dataBarang[$index];

        //     $stok_sekarang = intval($tblBarang->stok_sekarang) - intval($value->qty);
        //     $tblBarang->stok_sebelumnya = $tblBarang->stok_sekarang;
        //     $tblBarang->stok_sekarang = $stok_sekarang;
        //     // $tblBarang->user_update = $userid_login;
        // }

        // // -- BUAT TRX [CREATE] -- \\
        $uuidTrx = Uuid::uuid4()->toString();
        $dateKodeTrx = Carbon::now()->format('YmdHisu');
        $list_idBarang = collect($dataStokBarang)->pluck('id_barang')->toArray();
        $list_kodeBarang = collect($dataStokBarang)->pluck('kode_barang')->toArray();

        $tblTransaksi = new MTrxBarang();
        $tblTransaksi->kode_trx = 'SOM#'.$dateKodeTrx;
        $tblTransaksi->tipe_trx = 'STOK_OUT_MAHASISWA';
        $tblTransaksi->ket = 'STOK OUT MAHASISWA: #'.$dataPermintaan->noid.'|'.$dataPermintaan->id_mahasiswa.'|'.$dataPermintaan->nama.'<br/>BARANG: #'.implode(',', $list_kodeBarang ?? []);
        $tblTransaksi->id_mahasiswa = $dataPermintaan->id_mahasiswa;
        $tblTransaksi->nama_mahasiswa = $dataPermintaan->nama;
        $tblTransaksi->trxfrom = $dataPermintaan->id_permintaan;
        $tblTransaksi->trxfrom_ket = $dataPermintaan->informasi;

        $tblTransaksi->user_id_prodi = $user_id_prodi_login;
        $tblTransaksi->user_kode_prodi = $user_kode_prodi_login;
        $tblTransaksi->user_nama_prodi = $user_nama_prodi_login;

        $tblTransaksi->user_create = $userid_login;
        // $tblTransaksi->user_update = ;
        $tblTransaksi->uid = $uuidTrx;
        $tblTransaksi->save();

        $dataModelTrxBarangDetail = [];
        foreach($dataStokBarang as $nomor => $value) {
            $tblPermintaanDetail = $dataPermintaanDetail[$nomor];
            $tblBarang = $dataStokBarang[$nomor];
            // $tblTransaksi = MBarang::find($value->id_barang);
            $tblTransaksiDetail = new MTrxBarangDetail();
            $tblTransaksiDetail->id_trx = $tblTransaksi->id_trx;
            $tblTransaksiDetail->kode_trx = $tblTransaksi->kode_trx;
            $tblTransaksiDetail->norut = $nomor + 1;
            $tblTransaksiDetail->id_barang = $tblBarang->id_barang;
            $tblTransaksiDetail->kode_barang = $tblBarang->kode_barang;
            $tblTransaksiDetail->nama_barang = $tblBarang->nama_barang;
            $tblTransaksiDetail->stok = $dataStok[$tblBarang->id_barang];

            $tblTransaksiDetail->user_id_prodi = $user_id_prodi_login;
            $tblTransaksiDetail->user_kode_prodi = $user_kode_prodi_login;
            $tblTransaksiDetail->user_nama_prodi = $user_nama_prodi_login;

            array_push($dataModelTrxBarangDetail, $tblTransaksiDetail);
        }
        // dd($dataModelTrxBarangDetail);
        foreach($dataModelTrxBarangDetail as $index => $value) {
            $value->save();
        }

        // -- barangnya update -- \\
        $dataBarangDetail = [];
        foreach($dataStokBarang as $index => $value) {
            $value->id_trx_last = $tblTransaksi->id_trx;
            $value->kode_trx_last = $tblTransaksi->kode_trx;
            $value->tipe_trx_last = 'STOK_OUT_MAHASISWA';
            array_push($dataBarangDetail, $value);
        }
        foreach($dataBarangDetail as $index => $value) {
            $value->save();
        }
        $dataPermintaan->save();

        Session::flash('alert-success', 'Success Verifikasi Data'); // kasih pesan success
        return redirect()->route('transaksi.permintaan.terima.index');
    }


    // ▄▄       ▄▄  ▄▄▄▄▄▄▄▄▄▄▄  ▄         ▄  ▄▄▄▄▄▄▄▄▄▄▄  ▄▄▄▄▄▄▄▄▄▄▄  ▄▄▄▄▄▄▄▄▄▄▄  ▄▄▄▄▄▄▄▄▄▄▄  ▄         ▄  ▄▄▄▄▄▄▄▄▄▄▄
    // ▐░░▌     ▐░░▌▐░░░░░░░░░░░▌▐░▌       ▐░▌▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌▐░▌       ▐░▌▐░░░░░░░░░░░▌
    // ▐░▌░▌   ▐░▐░▌▐░█▀▀▀▀▀▀▀█░▌▐░▌       ▐░▌▐░█▀▀▀▀▀▀▀█░▌▐░█▀▀▀▀▀▀▀▀▀  ▀▀▀▀█░█▀▀▀▀ ▐░█▀▀▀▀▀▀▀▀▀ ▐░▌       ▐░▌▐░█▀▀▀▀▀▀▀█░▌
    // ▐░▌▐░▌ ▐░▌▐░▌▐░▌       ▐░▌▐░▌       ▐░▌▐░▌       ▐░▌▐░▌               ▐░▌     ▐░▌          ▐░▌       ▐░▌▐░▌       ▐░▌
    // ▐░▌ ▐░▐░▌ ▐░▌▐░█▄▄▄▄▄▄▄█░▌▐░█▄▄▄▄▄▄▄█░▌▐░█▄▄▄▄▄▄▄█░▌▐░█▄▄▄▄▄▄▄▄▄      ▐░▌     ▐░█▄▄▄▄▄▄▄▄▄ ▐░▌   ▄   ▐░▌▐░█▄▄▄▄▄▄▄█░▌
    // ▐░▌  ▐░▌  ▐░▌▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌     ▐░▌     ▐░░░░░░░░░░░▌▐░▌  ▐░▌  ▐░▌▐░░░░░░░░░░░▌
    // ▐░▌   ▀   ▐░▌▐░█▀▀▀▀▀▀▀█░▌▐░█▀▀▀▀▀▀▀█░▌▐░█▀▀▀▀▀▀▀█░▌ ▀▀▀▀▀▀▀▀▀█░▌     ▐░▌      ▀▀▀▀▀▀▀▀▀█░▌▐░▌ ▐░▌░▌ ▐░▌▐░█▀▀▀▀▀▀▀█░▌
    // ▐░▌       ▐░▌▐░▌       ▐░▌▐░▌       ▐░▌▐░▌       ▐░▌          ▐░▌     ▐░▌               ▐░▌▐░▌▐░▌ ▐░▌▐░▌▐░▌       ▐░▌
    // ▐░▌       ▐░▌▐░▌       ▐░▌▐░▌       ▐░▌▐░▌       ▐░▌ ▄▄▄▄▄▄▄▄▄█░▌ ▄▄▄▄█░█▄▄▄▄  ▄▄▄▄▄▄▄▄▄█░▌▐░▌░▌   ▐░▐░▌▐░▌       ▐░▌
    // ▐░▌       ▐░▌▐░▌       ▐░▌▐░▌       ▐░▌▐░▌       ▐░▌▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌▐░░▌     ▐░░▌▐░▌       ▐░▌
    //  ▀         ▀  ▀         ▀  ▀         ▀  ▀         ▀  ▀▀▀▀▀▀▀▀▀▀▀  ▀▀▀▀▀▀▀▀▀▀▀  ▀▀▀▀▀▀▀▀▀▀▀  ▀▀       ▀▀  ▀         ▀
    // -- Permintaan Terima Mahasiswa -- \\
    public function permintaanShow(Request $request) // index/ table lu
    {
        $userid_login = auth()->guard('mahasiswa')->user()->id_mahasiswa ?? null;
        // dd($userid_login);

        $dataPermintaan = MPermintaanBarang::where('id_mahasiswa', $userid_login)->orderBy('created_at', 'desc')->get();
        // if(count($dataPermintaan) == 0) {
        //     return abort(404);
        // }
        return view('transaksi.permintaan.index', ['dataPermintaan' => $dataPermintaan]);
    }

    public function permintaanShowCreate(Request $request)
    {
        $dataJurusan = MJurusan::all();
        $dataProdi = MProdi::all();
        $dataKelas = MKelas::all();
        $dataBarang = MBarang::where('status_barang', '=', 'aktif')->get();
        $dataPaketPraktek = MPaketPraktek::all();
        $dataPaketPraktekDetail = MPaketPraktekDetail::all();

        $kirimKeView = [
            'dataJurusan' => $dataJurusan,
            'dataProdi' => $dataProdi,
            'dataKelas' => $dataKelas,
            'dataBarang' => $dataBarang,
            'dataPaketPraktek' => $dataPaketPraktek,
            'dataPaketPraktekDetail' => $dataPaketPraktekDetail
        ];

        return view('transaksi.permintaan.create', $kirimKeView);
    }
    public function permintaanShowEdit(Request $request)
    {
        return view('transaksi.permintaan.index');
    }
    public function permintaanShowDetail(Request $request)
    {
        $userid_login = auth()->guard('mahasiswa')->user()->id_mahasiswa ?? null;
        $form_id_permintaan = $request->query('id_trx', '');

        $dataPermintaan = MPermintaanBarang::findOrFail($form_id_permintaan);

        // kalo ada hekel bypass di url
        if($dataPermintaan->id_mahasiswa != $userid_login) {
            return abort(404);
        }
        $dataPermintaanDetail = MPermintaanBarangDetail::where('id_permintaan', $dataPermintaan->id_permintaan)->get();
        return view('transaksi.permintaan.detail', ['dataPermintaan' => $dataPermintaan, 'dataPermintaanDetail' => $dataPermintaanDetail]);
    }
    public function permintaanProsesAdd(Request $request)
    {
        $userid_login = auth()->guard('mahasiswa')->user()->nim ?? null;
        $userid_idmhs = auth()->guard('mahasiswa')->user()->id_mahasiswa ?? null;
        // dd($userid_login);

        // -- ambil dari form
        // $form_kode_barang = $request->post('kode_barang');
        $form_nim = $request->post('nim');
        $form_nama = $request->post('nama');
        $form_jurusan = $request->post('jurusan');
        $form_prodi = $request->post('prodi');
        $form_kelas = $request->post('kelas');
        $form_info = $request->post('info');
        $form_barang = $request->post('barang');
        $form_stok = $request->post('stok');

        // get data dulu
        $tblMahasiswa = MMahasiswa::where('id_mahasiswa', $userid_idmhs)->latest()->first();
        $tblJurusan = MJurusan::findOrFail($form_jurusan);
        $tblProdi = MProdi::findOrFail($form_prodi);
        $tblKelas = MKelas::findOrFail($form_kelas);

        // -- set ke table
        $uuidTrx = Uuid::uuid4()->toString();
        $dateKodeTrx = Carbon::now()->format('YmdHisu');

        $tblPermintaan = new MPermintaanBarang();
        // $tblPermintaan-> = ;
        // $tblPermintaan-> = ;
        // $tblPermintaan-> = $form_jurusan;
        // $tblPermintaan-> = $form_prodi;
        // $tblPermintaan-> = $form_kelas;
        // $tblPermintaan-> = $form_info;
        $tblPermintaan->kode_permintaan = 'ROM#'.$dateKodeTrx;
        $tblPermintaan->id_mahasiswa = $tblMahasiswa->id_mahasiswa;
        $tblPermintaan->noid = $form_nim;
        $tblPermintaan->nama = $form_nama;
        $tblPermintaan->id_jurusan = $tblJurusan->id_jurusan;
        $tblPermintaan->kode_jurusan = $tblJurusan->kode_jurusan;;
        $tblPermintaan->id_prodi = $tblProdi->id_prodi;
        $tblPermintaan->kode_prodi = $tblProdi->kode_prodi;;
        $tblPermintaan->id_kelas = $tblKelas->id_kelas;
        $tblPermintaan->kode_kelas = $tblKelas->kode_kelas;;
        $tblPermintaan->informasi = $form_info;
        $tblPermintaan->status_permintaan = '0';
        $tblPermintaan->user_create = $tblMahasiswa->nim;
        // $tblPermintaan->user_update = 0;
        $tblPermintaan->uid = $uuidTrx;
        $tblPermintaan->save();
        // dd($tblPermintaan);
        // dd($form_stok);
        // dd($request);
        // var_dump($form_barang);
        $dataPermintaaDetail = [];
        // $patokanBarang = [];
        // $detailBarang = [];
        // $data = [];
        foreach($form_barang as $index => $value) {
            $tblBarang = MBarang::find($value); // id_barang
            $tblPermintaanDetail = new MPermintaanBarangDetail();
            $tblPermintaanDetail->id_permintaan = $tblPermintaan->id_permintaan;
            $tblPermintaanDetail->kode_permintaan = $tblPermintaan->kode_permintaan;
            $tblPermintaanDetail->norut = $index+1;
            // $tblPermintaanDetail->id_pindah_sebelumnya = 0;
            $tblPermintaanDetail->id_barang = $tblBarang->id_barang;
            $tblPermintaanDetail->kode_barang = $tblBarang->kode_barang;
            $tblPermintaanDetail->nama_barang = $tblBarang->nama_barang;
            $tblPermintaanDetail->qty = intval($form_stok[$index]);
            array_push($dataPermintaaDetail, $tblPermintaanDetail);
            // $tblPermintaanDetail->ket = 0;
            // $tblPermintaanDetail->lokasi_sebelumnya = 0;
            // $tblPermintaanDetail->lokasi_sekarang = 0;
            // $tblPermintaanDetail->id_gedung = 0;
            // $tblPermintaanDetail->id_gudang = 0;
            // $tblPermintaanDetail->id_blok = 0;
            // $tblPermintaanDetail->id_lokasi = 0;
            // $patokanBarang[$value] = $tblBarang;
            // array_push($detailBarang, $tblBarang);
        }
        foreach($dataPermintaaDetail as $index => $value) {
            $value->save();
        }
        // // print_r($patokanBarang);
        // // print_r($data);
        // // echo '<hr/>';

        // //
        // foreach($patokanBarang as $index => $value) {
        //     $data[$value->id_barang] += intval($value->stok_sekarang);
        //     // var_dump($value->stok_sekarang);
        //     // var_dump($data[$value->id_barang]);
        //     // echo '<hr/>';
        //     // $data[$value->id_barang] = $data[$value->id_barang] + $value->stok_sekarang;
        // }
        // print_r($data);
        // dd($patokanBarang);
        // dd(1);
        // $form_nama_barang = $request->post('nama_barang');

        // $form_unit = $request->post('unit');
        // $form_stok_awal = $request->post('stok_awal');
        // $form_lokasi_sekarang = $request->post('lokasi_sekarang');

        // $dataLokasi = MLokasi::find($form_lokasi_sekarang);
        // $dataModelBarang = [];
        // foreach($patokanBarang as $index => $value) {
        //     $tblBarang = MBarang::find($index);
        //     // dd($value);
        //     $tblBarang->stok_sebelumnya = $value->stok_sekarang;
        //     $tblBarang->stok_sekarang = $data[$value->id_barang];
        //     $tblBarang->user_update = $userid_login;
        //     array_push($dataModelBarang, $tblBarang);
        //     // if($index == 2) {
        //     //     dd($dataModelBarang);
        //     // }
        // }
        // dd($dataModelBarang);
        // foreach($dataModelBarang as $index => $value) {
        //     $value->save();
        // }

        // // -- set ke table

        // // -- BUAT TRX [CREATE] -- \\
        // $uuidTrx = Uuid::uuid4()->toString();
        // $dateKodeTrx = Carbon::now()->format('YmdHisu');
        // $list_idBarang = collect($dataModelBarang)->pluck('id_barang')->toArray();
        // $list_kodeBarang = collect($dataModelBarang)->pluck('kode_barang')->toArray();

        // $tblTransaksi = new MTrxBarang();
        // $tblTransaksi->kode_trx = 'SI#'.$dateKodeTrx;
        // $tblTransaksi->tipe_trx = 'STOK_IN';
        // $tblTransaksi->ket = $form_keterangan.'<br/><br/>STOK IN BARANG #'.implode(',', $list_kodeBarang ?? []);
        // $tblTransaksi->user_create = $userid_login;
        // // $tblTransaksi->user_update = ;
        // $tblTransaksi->uid = $uuidTrx;
        // $tblTransaksi->save();

        // $dataModelTrxBarangDetail = [];
        // foreach($detailBarang as $nomor => $value) {
        //     // $tblTransaksi = MBarang::find($value->id_barang);
        //     $tblTransaksiDetail = new MTrxBarangDetail();
        //     $tblTransaksiDetail->id_trx = $tblTransaksi->id_trx;
        //     $tblTransaksiDetail->kode_trx = $tblTransaksi->kode_trx;
        //     $tblTransaksiDetail->norut = $nomor + 1;
        //     $tblTransaksiDetail->id_barang = $value->id_barang;
        //     $tblTransaksiDetail->kode_barang = $value->kode_barang;
        //     $tblTransaksiDetail->nama_barang = $value->nama_barang;
        //     $tblTransaksiDetail->stok = $form_stok[$nomor];
        //     array_push($dataModelTrxBarangDetail, $tblTransaksiDetail);
        // }
        // foreach($dataModelTrxBarangDetail as $index => $value) {
        //     $value->save();
        // }

        // // -- barangnya update -- \\
        // $dataBarangDetail = [];
        // foreach($dataModelBarang as $index => $value) {
        //     $value->id_trx_last = $tblTransaksi->id_trx;
        //     $value->kode_trx_last = $tblTransaksi->kode_trx;
        //     $value->tipe_trx_last = 'STOK_IN';
        //     array_push($dataBarangDetail, $value);
        // }
        // foreach($dataBarangDetail as $index => $value) {
        //     $value->save();
        // }

        Session::flash('alert-success', 'Success Add Data'); // kasih pesan success
        return redirect()->route('transaksi.permintaan.index');
    }
    public function permintaanProsesEdit(Request $request)
    {
        return view('transaksi.permintaan.index');
    }
    public function permintaanProsesDelete(Request $request)
    {
        return view('transaksi.permintaan.index');
    }
}
