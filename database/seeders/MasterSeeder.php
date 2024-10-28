<?php

namespace Database\Seeders;

use App\Models\MBlok;
use App\Models\MGedung;
use App\Models\MGudang;
use App\Models\MJurusan;
use App\Models\MKelas;
use App\Models\MLokasi;
use App\Models\MProdi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\MMahasiswa;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // -- MASTER LOKASI -- \\
        // Gedung
        $gedung1 = MGedung::create([
            'kode_gedung' => 'G01',
            'nama_gedung' => 'Gedung AA',
            'user_create' => 'admin',
        ]);
        $gedung2 = MGedung::create([
            'kode_gedung' => 'G02',
            'nama_gedung' => 'Gedung Serba Guna GSG',
            'user_create' => 'admin',
        ]);

        // Gudang
        $gudang1 = MGudang::create([
            'kode_gudang' => 'RAA01',
            'id_gedung' => $gedung1->id_gedung,
            'kode_gedung' => $gedung1->kode_gedung,
            'nama_gudang' => 'Ruang AA Lantai 1',
            'user_create' => 'admin',
        ]);
        $gudang2 = MGudang::create([
            'kode_gudang' => 'RAA02',
            'id_gedung' => $gedung1->id_gedung,
            'kode_gedung' => $gedung1->kode_gedung,
            'nama_gudang' => 'Ruang AA Lantai 2',
            'user_create' => 'admin',
        ]);
        $gudang3 = MGudang::create([
            'kode_gudang' => 'RK01',
            'id_gedung' => $gedung2->id_gedung,
            'kode_gedung' => $gedung2->kode_gedung,
            'nama_gudang' => 'Ruang Kelas Lantai 1',
            'user_create' => 'admin',
        ]);
        $gudang4 = MGudang::create([
            'kode_gudang' => 'RK02',
            'id_gedung' => $gedung2->id_gedung,
            'kode_gedung' => $gedung2->kode_gedung,
            'nama_gudang' => 'Ruang Kelas Lantai 2',
            'user_create' => 'admin',
        ]);

        // Blok
        $blok1 = MBlok::create([
            'kode_blok' => 'B01',
            'id_gudang' => $gudang1->id_gudang,
            'kode_gudang' => $gudang1->kode_gudang,
            'id_gedung' => $gudang1->id_gedung,
            'kode_gedung' => $gudang1->kode_gedung,
            'nama_blok' => 'Lemari Besar 1',
            'user_create' => 'admin',
        ]);
        $blok2 = MBlok::create([
            'kode_blok' => 'B02',
            'id_gudang' => $gudang1->id_gudang,
            'kode_gudang' => $gudang1->kode_gudang,
            'id_gedung' => $gudang1->id_gedung,
            'kode_gedung' => $gudang1->kode_gedung,
            'nama_blok' => 'Lemari Kecil 1',
            'user_create' => 'admin',
        ]);

        $blok3 = MBlok::create([
            'kode_blok' => 'B03',
            'id_gudang' => $gudang2->id_gudang,
            'kode_gudang' => $gudang2->kode_gudang,
            'id_gedung' => $gudang2->id_gedung,
            'kode_gedung' => $gudang2->kode_gedung,
            'nama_blok' => 'Lemari Besar 2',
            'user_create' => 'admin',
        ]);
        $blok4 = MBlok::create([
            'kode_blok' => 'B04',
            'id_gudang' => $gudang2->id_gudang,
            'kode_gudang' => $gudang2->kode_gudang,
            'id_gedung' => $gudang2->id_gedung,
            'kode_gedung' => $gudang2->kode_gedung,
            'nama_blok' => 'Lemari Kecil 2',
            'user_create' => 'admin',
        ]);

        $blok5 = MBlok::create([
            'kode_blok' => 'B05',
            'id_gudang' => $gudang3->id_gudang,
            'kode_gudang' => $gudang3->kode_gudang,
            'id_gedung' => $gudang3->id_gedung,
            'kode_gedung' => $gudang3->kode_gedung,
            'nama_blok' => 'Lemari Besar 3',
            'user_create' => 'admin',
        ]);
        $blok6 = MBlok::create([
            'kode_blok' => 'B06',
            'id_gudang' => $gudang3->id_gudang,
            'kode_gudang' => $gudang3->kode_gudang,
            'id_gedung' => $gudang3->id_gedung,
            'kode_gedung' => $gudang3->kode_gedung,
            'nama_blok' => 'Lemari Kecil 3',
            'user_create' => 'admin',
        ]);

        $blok7 = MBlok::create([
            'kode_blok' => 'B07',
            'id_gudang' => $gudang4->id_gudang,
            'kode_gudang' => $gudang4->kode_gudang,
            'id_gedung' => $gudang4->id_gedung,
            'kode_gedung' => $gudang4->kode_gedung,
            'nama_blok' => 'Lemari Besar 4',
            'user_create' => 'admin',
        ]);
        $blok8 = MBlok::create([
            'kode_blok' => 'B08',
            'id_gudang' => $gudang4->id_gudang,
            'kode_gudang' => $gudang4->kode_gudang,
            'id_gedung' => $gudang4->id_gedung,
            'kode_gedung' => $gudang4->kode_gedung,
            'nama_blok' => 'Lemari Kecil 4',
            'user_create' => 'admin',
        ]);

        // // Lokasi
        $lokasi1 = MLokasi::create([
            'id_gedung' => $blok1->id_gedung,
            'kode_gedung' => $blok1->kode_gedung,
            'id_gudang' => $blok1->id_gudang,
            'kode_gudang' => $blok1->kode_gudang,
            'id_blok' => $blok1->id_blok,
            'kode_blok' => $blok1->kode_blok,
            'kode_lokasi' => 'L01',
            'nama_lokasi' => 'Lemari Besar Tingkat 1',
            'user_create' => 'admin',
        ]);
        $lokasi2 = MLokasi::create([
            'id_gedung' => $blok1->id_gedung,
            'kode_gedung' => $blok1->kode_gedung,
            'id_gudang' => $blok1->id_gudang,
            'kode_gudang' => $blok1->kode_gudang,
            'id_blok' => $blok1->id_blok,
            'kode_blok' => $blok1->kode_blok,
            'kode_lokasi' => 'L02',
            'nama_lokasi' => 'Lemari Kecil Tingkat 1',
            'user_create' => 'admin',
        ]);
        $lokasi3 = MLokasi::create([
            'id_gedung' => $blok2->id_gedung,
            'kode_gedung' => $blok2->kode_gedung,
            'id_gudang' => $blok2->id_gudang,
            'kode_gudang' => $blok2->kode_gudang,
            'id_blok' => $blok2->id_blok,
            'kode_blok' => $blok2->kode_blok,
            'kode_lokasi' => 'L03',
            'nama_lokasi' => 'Lemari Besar Tingkat 2',
            'user_create' => 'admin',
        ]);
        $lokasi4 = MLokasi::create([
            'id_gedung' => $blok2->id_gedung,
            'kode_gedung' => $blok2->kode_gedung,
            'id_gudang' => $blok2->id_gudang,
            'kode_gudang' => $blok2->kode_gudang,
            'id_blok' => $blok2->id_blok,
            'kode_blok' => $blok2->kode_blok,
            'kode_lokasi' => 'L04',
            'nama_lokasi' => 'Lemari Kecil Kecil 2',
            'user_create' => 'admin',
        ]);
        $lokasi5 = MLokasi::create([
            'id_gedung' => $blok3->id_gedung,
            'kode_gedung' => $blok3->kode_gedung,
            'id_gudang' => $blok3->id_gudang,
            'kode_gudang' => $blok3->kode_gudang,
            'id_blok' => $blok3->id_blok,
            'kode_blok' => $blok3->kode_blok,
            'kode_lokasi' => 'L05',
            'nama_lokasi' => 'Lemari Besar Tingkat 3',
            'user_create' => 'admin',
        ]);
        $lokasi6 = MLokasi::create([
            'id_gedung' => $blok3->id_gedung,
            'kode_gedung' => $blok3->kode_gedung,
            'id_gudang' => $blok3->id_gudang,
            'kode_gudang' => $blok3->kode_gudang,
            'id_blok' => $blok3->id_blok,
            'kode_blok' => $blok3->kode_blok,
            'kode_lokasi' => 'L06',
            'nama_lokasi' => 'Lemari Kecil Kecil 3',
            'user_create' => 'admin',
        ]);
        $lokasi7 = MLokasi::create([
            'id_gedung' => $blok4->id_gedung,
            'kode_gedung' => $blok4->kode_gedung,
            'id_gudang' => $blok4->id_gudang,
            'kode_gudang' => $blok4->kode_gudang,
            'id_blok' => $blok4->id_blok,
            'kode_blok' => $blok4->kode_blok,
            'kode_lokasi' => 'L07',
            'nama_lokasi' => 'Lemari Besar Tingkat 4',
            'user_create' => 'admin',
        ]);
        $lokasi8 = MLokasi::create([
            'id_gedung' => $blok4->id_gedung,
            'kode_gedung' => $blok4->kode_gedung,
            'id_gudang' => $blok4->id_gudang,
            'kode_gudang' => $blok4->kode_gudang,
            'id_blok' => $blok4->id_blok,
            'kode_blok' => $blok4->kode_blok,
            'kode_lokasi' => 'L08',
            'nama_lokasi' => 'Lemari Kecil Kecil 4',
            'user_create' => 'admin',
        ]);
        $lokasi9 = MLokasi::create([
            'id_gedung' => $blok5->id_gedung,
            'kode_gedung' => $blok5->kode_gedung,
            'id_gudang' => $blok5->id_gudang,
            'kode_gudang' => $blok5->kode_gudang,
            'id_blok' => $blok5->id_blok,
            'kode_blok' => $blok5->kode_blok,
            'kode_lokasi' => 'L09',
            'nama_lokasi' => 'Lemari Besar Tingkat 5',
            'user_create' => 'admin',
        ]);
        $lokasi10 = MLokasi::create([
            'id_gedung' => $blok5->id_gedung,
            'kode_gedung' => $blok5->kode_gedung,
            'id_gudang' => $blok5->id_gudang,
            'kode_gudang' => $blok5->kode_gudang,
            'id_blok' => $blok5->id_blok,
            'kode_blok' => $blok5->kode_blok,
            'kode_lokasi' => 'L10',
            'nama_lokasi' => 'Lemari Kecil Kecil 5',
            'user_create' => 'admin',
        ]);
        $lokasi11 = MLokasi::create([
            'id_gedung' => $blok6->id_gedung,
            'kode_gedung' => $blok6->kode_gedung,
            'id_gudang' => $blok6->id_gudang,
            'kode_gudang' => $blok6->kode_gudang,
            'id_blok' => $blok6->id_blok,
            'kode_blok' => $blok6->kode_blok,
            'kode_lokasi' => 'L11',
            'nama_lokasi' => 'Lemari Besar Tingkat 6',
            'user_create' => 'admin',
        ]);
        $lokasi12 = MLokasi::create([
            'id_gedung' => $blok6->id_gedung,
            'kode_gedung' => $blok6->kode_gedung,
            'id_gudang' => $blok6->id_gudang,
            'kode_gudang' => $blok6->kode_gudang,
            'id_blok' => $blok6->id_blok,
            'kode_blok' => $blok6->kode_blok,
            'kode_lokasi' => 'L12',
            'nama_lokasi' => 'Lemari Kecil Kecil 6',
            'user_create' => 'admin',
        ]);
        $lokasi13 = MLokasi::create([
            'id_gedung' => $blok7->id_gedung,
            'kode_gedung' => $blok7->kode_gedung,
            'id_gudang' => $blok7->id_gudang,
            'kode_gudang' => $blok7->kode_gudang,
            'id_blok' => $blok7->id_blok,
            'kode_blok' => $blok7->kode_blok,
            'kode_lokasi' => 'L13',
            'nama_lokasi' => 'Lemari Besar Tingkat 7',
            'user_create' => 'admin',
        ]);
        $lokasi14 = MLokasi::create([
            'id_gedung' => $blok7->id_gedung,
            'kode_gedung' => $blok7->kode_gedung,
            'id_gudang' => $blok7->id_gudang,
            'kode_gudang' => $blok7->kode_gudang,
            'id_blok' => $blok7->id_blok,
            'kode_blok' => $blok7->kode_blok,
            'kode_lokasi' => 'L14',
            'nama_lokasi' => 'Lemari Kecil Kecil 7',
            'user_create' => 'admin',
        ]);
        $lokasi15 = MLokasi::create([
            'id_gedung' => $blok8->id_gedung,
            'kode_gedung' => $blok8->kode_gedung,
            'id_gudang' => $blok8->id_gudang,
            'kode_gudang' => $blok8->kode_gudang,
            'id_blok' => $blok8->id_blok,
            'kode_blok' => $blok8->kode_blok,
            'kode_lokasi' => 'L15',
            'nama_lokasi' => 'Lemari Besar Tingkat 8',
            'user_create' => 'admin',
        ]);
        $lokasi16 = MLokasi::create([
            'id_gedung' => $blok8->id_gedung,
            'kode_gedung' => $blok8->kode_gedung,
            'id_gudang' => $blok8->id_gudang,
            'kode_gudang' => $blok8->kode_gudang,
            'id_blok' => $blok8->id_blok,
            'kode_blok' => $blok8->kode_blok,
            'kode_lokasi' => 'L16',
            'nama_lokasi' => 'Lemari Kecil Kecil 8',
            'user_create' => 'admin',
        ]);


         // -- MASTER LOKASI -- \\
        // gedung Jurusan
        $jurusan1 = MJurusan::create([
            'kode_jurusan' => 'TS',
            'nama_jurusan' => 'Teknik Sipil',
            'user_create' => 'admin',
        ]);
        $jurusan2 = MJurusan::create([
            'kode_jurusan' => 'TM',
            'nama_jurusan' => 'Teknik Mesin',
            'user_create' => 'admin',
        ]);

        // gudang Prodi
        $prodi1 = MProdi::create([
            'kode_prodi' => 'PJJ',
            'id_jurusan' => $jurusan1->id_jurusan,
            'kode_jurusan' => $jurusan1->kode_jurusan,
            'nama_prodi' => 'Pembangunan Jalan dan Jembatan',
            'user_create' => 'admin',
        ]);
        $prodi2 = MProdi::create([
            'kode_prodi' => 'MJ',
            'id_jurusan' => $jurusan1->id_jurusan,
            'kode_jurusan' => $jurusan1->kode_jurusan,
            'nama_prodi' => 'Mengaspal Jalan',
            'user_create' => 'admin',
        ]);
        $prodi3 = MProdi::create([
            'kode_prodi' => 'MB',
            'id_jurusan' => $jurusan2->id_jurusan,
            'kode_jurusan' => $jurusan2->kode_jurusan,
            'nama_prodi' => 'Motong Besi',
            'user_create' => 'admin',
        ]);
        $prodi4 = MProdi::create([
            'kode_prodi' => 'LL',
            'id_jurusan' => $jurusan2->id_jurusan,
            'kode_jurusan' => $jurusan2->kode_jurusan,
            'nama_prodi' => 'Las Lasan',
            'user_create' => 'admin',
        ]);

        // Blok Kelas
        $kelas1 = MKelas::create([
            'kode_Kelas' => 'A01',
            'id_prodi' => $prodi1->id_prodi,
            'kode_prodi' => $prodi1->kode_prodi,
            'id_jurusan' => $prodi1->id_jurusan,
            'kode_jurusan' => $prodi1->kode_jurusan,
            'nama_Kelas' => 'Gedung A Kelas 01',
            'user_create' => 'admin',
        ]);
        $kelas2 = MKelas::create([
            'kode_Kelas' => 'A02',
            'id_prodi' => $prodi1->id_prodi,
            'kode_prodi' => $prodi1->kode_prodi,
            'id_jurusan' => $prodi1->id_jurusan,
            'kode_jurusan' => $prodi1->kode_jurusan,
            'nama_Kelas' => 'Gedung A Kelas 02',
            'user_create' => 'admin',
        ]);

        $kelas3 = MKelas::create([
            'kode_Kelas' => 'A03',
            'id_prodi' => $prodi2->id_prodi,
            'kode_prodi' => $prodi2->kode_prodi,
            'id_jurusan' => $prodi2->id_jurusan,
            'kode_jurusan' => $prodi2->kode_jurusan,
            'nama_Kelas' => 'Gedung A Kelas 03',
            'user_create' => 'admin',
        ]);
        $kelas4 = MKelas::create([
            'kode_Kelas' => 'A04',
            'id_prodi' => $prodi2->id_prodi,
            'kode_prodi' => $prodi2->kode_prodi,
            'id_jurusan' => $prodi2->id_jurusan,
            'kode_jurusan' => $prodi2->kode_jurusan,
            'nama_Kelas' => 'Gedung A Kelas 04',
            'user_create' => 'admin',
        ]);

        $kelas5 = MKelas::create([
            'kode_Kelas' => 'A05',
            'id_prodi' => $prodi3->id_prodi,
            'kode_prodi' => $prodi3->kode_prodi,
            'id_jurusan' => $prodi3->id_jurusan,
            'kode_jurusan' => $prodi3->kode_jurusan,
            'nama_Kelas' => 'Gedung A Kelas 05',
            'user_create' => 'admin',
        ]);
        $kelas6 = MKelas::create([
            'kode_Kelas' => 'A06',
            'id_prodi' => $prodi3->id_prodi,
            'kode_prodi' => $prodi3->kode_prodi,
            'id_jurusan' => $prodi3->id_jurusan,
            'kode_jurusan' => $prodi3->kode_jurusan,
            'nama_Kelas' => 'Gedung A Kelas 06',
            'user_create' => 'admin',
        ]);

        $kelas7 = MKelas::create([
            'kode_Kelas' => 'A07',
            'id_prodi' => $prodi4->id_prodi,
            'kode_prodi' => $prodi4->kode_prodi,
            'id_jurusan' => $prodi4->id_jurusan,
            'kode_jurusan' => $prodi4->kode_jurusan,
            'nama_Kelas' => 'Gedung A Kelas 07',
            'user_create' => 'admin',
        ]);
        $kelas8 = MKelas::create([
            'kode_Kelas' => 'A08',
            'id_prodi' => $prodi4->id_prodi,
            'kode_prodi' => $prodi4->kode_prodi,
            'id_jurusan' => $prodi4->id_jurusan,
            'kode_jurusan' => $prodi4->kode_jurusan,
            'nama_Kelas' => 'Gedung A Kelas 08',
            'user_create' => 'admin',
        ]);

        $mahasiswa1 = MMahasiswa::create([
            'id_jurusan' => $kelas1->id_jurusan,
            'kode_jurusan' => $kelas1->kode_jurusan,
            'id_prodi' => $kelas1->id_prodi,
            'kode_prodi' => $kelas1->kode_prodi,
            'id_kelas' => $kelas1->id_kelas,
            'kode_kelas' => $kelas1->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);
        $mahasiswa2 = MMahasiswa::create([
            'id_jurusan' => $kelas1->id_jurusan,
            'kode_jurusan' => $kelas1->kode_jurusan,
            'id_prodi' => $kelas1->id_prodi,
            'kode_prodi' => $kelas1->kode_prodi,
            'id_kelas' => $kelas1->id_kelas,
            'kode_kelas' => $kelas1->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);

        $mahasiswa3 = MMahasiswa::create([
            'id_jurusan' => $kelas2->id_jurusan,
            'kode_jurusan' => $kelas2->kode_jurusan,
            'id_prodi' => $kelas2->id_prodi,
            'kode_prodi' => $kelas2->kode_prodi,
            'id_kelas' => $kelas2->id_kelas,
            'kode_kelas' => $kelas2->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);
        $mahasiswa4 = MMahasiswa::create([
            'id_jurusan' => $kelas2->id_jurusan,
            'kode_jurusan' => $kelas2->kode_jurusan,
            'id_prodi' => $kelas2->id_prodi,
            'kode_prodi' => $kelas2->kode_prodi,
            'id_kelas' => $kelas2->id_kelas,
            'kode_kelas' => $kelas2->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);

        $mahasiswa5 = MMahasiswa::create([
            'id_jurusan' => $kelas3->id_jurusan,
            'kode_jurusan' => $kelas3->kode_jurusan,
            'id_prodi' => $kelas3->id_prodi,
            'kode_prodi' => $kelas3->kode_prodi,
            'id_kelas' => $kelas3->id_kelas,
            'kode_kelas' => $kelas3->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);
        $mahasiswa6 = MMahasiswa::create([
            'id_jurusan' => $kelas3->id_jurusan,
            'kode_jurusan' => $kelas3->kode_jurusan,
            'id_prodi' => $kelas3->id_prodi,
            'kode_prodi' => $kelas3->kode_prodi,
            'id_kelas' => $kelas3->id_kelas,
            'kode_kelas' => $kelas3->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);

        $mahasiswa7 = MMahasiswa::create([
            'id_jurusan' => $kelas4->id_jurusan,
            'kode_jurusan' => $kelas4->kode_jurusan,
            'id_prodi' => $kelas4->id_prodi,
            'kode_prodi' => $kelas4->kode_prodi,
            'id_kelas' => $kelas4->id_kelas,
            'kode_kelas' => $kelas4->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);
        $mahasiswa8 = MMahasiswa::create([
            'id_jurusan' => $kelas4->id_jurusan,
            'kode_jurusan' => $kelas4->kode_jurusan,
            'id_prodi' => $kelas4->id_prodi,
            'kode_prodi' => $kelas4->kode_prodi,
            'id_kelas' => $kelas4->id_kelas,
            'kode_kelas' => $kelas4->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);

        $mahasiswa9 = MMahasiswa::create([
            'id_jurusan' => $kelas5->id_jurusan,
            'kode_jurusan' => $kelas5->kode_jurusan,
            'id_prodi' => $kelas5->id_prodi,
            'kode_prodi' => $kelas5->kode_prodi,
            'id_kelas' => $kelas5->id_kelas,
            'kode_kelas' => $kelas5->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);
        $mahasiswa10 = MMahasiswa::create([
            'id_jurusan' => $kelas5->id_jurusan,
            'kode_jurusan' => $kelas5->kode_jurusan,
            'id_prodi' => $kelas5->id_prodi,
            'kode_prodi' => $kelas5->kode_prodi,
            'id_kelas' => $kelas5->id_kelas,
            'kode_kelas' => $kelas5->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);
        $mahasiswa11 = MMahasiswa::create([
            'id_jurusan' => $kelas6->id_jurusan,
            'kode_jurusan' => $kelas6->kode_jurusan,
            'id_prodi' => $kelas6->id_prodi,
            'kode_prodi' => $kelas6->kode_prodi,
            'id_kelas' => $kelas6->id_kelas,
            'kode_kelas' => $kelas6->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);
        $mahasiswa12 = MMahasiswa::create([
            'id_jurusan' => $kelas6->id_jurusan,
            'kode_jurusan' => $kelas6->kode_jurusan,
            'id_prodi' => $kelas6->id_prodi,
            'kode_prodi' => $kelas6->kode_prodi,
            'id_kelas' => $kelas6->id_kelas,
            'kode_kelas' => $kelas6->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);
        $mahasiswa13 = MMahasiswa::create([
            'id_jurusan' => $kelas7->id_jurusan,
            'kode_jurusan' => $kelas7->kode_jurusan,
            'id_prodi' => $kelas7->id_prodi,
            'kode_prodi' => $kelas7->kode_prodi,
            'id_kelas' => $kelas7->id_kelas,
            'kode_kelas' => $kelas7->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);
        $mahasiswa14 = MMahasiswa::create([
            'id_jurusan' => $kelas7->id_jurusan,
            'kode_jurusan' => $kelas7->kode_jurusan,
            'id_prodi' => $kelas7->id_prodi,
            'kode_prodi' => $kelas7->kode_prodi,
            'id_kelas' => $kelas7->id_kelas,
            'kode_kelas' => $kelas7->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);
        $mahasiswa15 = MMahasiswa::create([
            'id_jurusan' => $kelas8->id_jurusan,
            'kode_jurusan' => $kelas8->kode_jurusan,
            'id_prodi' => $kelas8->id_prodi,
            'kode_prodi' => $kelas8->kode_prodi,
            'id_kelas' => $kelas8->id_kelas,
            'kode_kelas' => $kelas8->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);
        $mahasiswa16 = MMahasiswa::create([
            'id_jurusan' => $kelas8->id_jurusan,
            'kode_jurusan' => $kelas8->kode_jurusan,
            'id_prodi' => $kelas8->id_prodi,
            'kode_prodi' => $kelas8->kode_prodi,
            'id_kelas' => $kelas8->id_kelas,
            'kode_kelas' => $kelas8->kode_kelas,
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
            'uid' => fake()->uuid(),
        ]);

        // MLokasi::create([
        //     'kode_lokasi' => 'L01',
        //     'kode_blok' => 'LM01',
        //     'kode_gudang' => 'GAA01',
        //     'kode_gedung' => 'G01',
        //     'nama_lokasi' => 'Lemari Besar Tingkat 1',
        //     'user_create' => 'admin',
        // ]);
        // MLokasi::create([
        //     'kode_lokasi' => 'L02',
        //     'kode_blok' => 'LM02',
        //     'kode_gudang' => 'RAA02',
        //     'kode_gedung' => 'G01',
        //     'nama_lokasi' => 'Lemari Kecil Tingkat 1',
        //     'user_create' => 'admin',
        // ]);
        // MLokasi::create([
        //     'kode_lokasi' => 'RAK01',
        //     'kode_blok' => 'R01',
        //     'kode_gudang' => 'RK01',
        //     'kode_gedung' => 'G02',
        //     'nama_lokasi' => 'Rak 1 Laci 1',
        //     'user_create' => 'admin',
        // ]);
        // MLokasi::create([
        //     'kode_lokasi' => 'RAK02',
        //     'kode_blok' => 'R02',
        //     'kode_gudang' => 'RK02',
        //     'kode_gedung' => 'G02',
        //     'nama_lokasi' => 'Rak 2 Laci 1',
        //     'user_create' => 'admin',
        // ]);
        // // -- [END] MASTER LOKASI -- \\

        // // -- MASTER PENGGUNA -- \\
        // // Jurusan
        // MJurusan::create([
        //     'kode_jurusan' => 'TIK',
        //     'nama_jurusan' => 'Teknik Informatika & Komputer',
        //     'user_create' => 'admin',
        // ]);
        // MJurusan::create([
        //     'kode_jurusan' => 'TM',
        //     'nama_jurusan' => 'Teknik Mesin',
        //     'user_create' => 'admin',
        // ]);

        // // Prodi
        // MProdi::create([
        //     'kode_prodi' => 'TI',
        //     'kode_jurusan' => 'TIK',
        //     'nama_prodi' => 'Teknik Informatika',
        //     'user_create' => 'admin',
        // ]);
        // MProdi::create([
        //     'kode_prodi' => 'TMD',
        //     'kode_jurusan' => 'TIK',
        //     'nama_prodi' => 'Teknik Multimedia Digital',
        //     'user_create' => 'admin',
        // ]);

        // // Kelas
        // MKelas::create([
        //     'kode_kelas' => 'CCIT',
        //     'kode_prodi' => 'TI',
        //     'kode_jurusan' => 'TIK',
        //     'nama_kelas' => 'TI CCIT 6',
        //     'user_create' => 'admin',
        // ]);
        // MKelas::create([
        //     'kode_kelas' => 'CCIT',
        //     'kode_prodi' => 'TI',
        //     'kode_jurusan' => 'TIK',
        //     'nama_kelas' => 'TI CCIT 7',
        //     'user_create' => 'admin',
        // ]);

        // -- [END] MASTER PENGGUNA -- \\

    }
}
