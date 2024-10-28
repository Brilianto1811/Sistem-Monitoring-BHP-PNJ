<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class _TblPermintaanBarangDetailTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbl_permintaan_barang_detail')->delete();
        
        \DB::table('tbl_permintaan_barang_detail')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_permintaan' => 1,
                'kode_permintaan' => 'REQ#001',
                'norut' => 1,
                'id_pindah_sebelumnya' => NULL,
                'id_barang' => 11,
                'kode_barang' => 'PRY01',
                'nama_barang' => 'Proyektor BenQ',
                'qty' => '5',
                'ket' => 'minta dibawa pulang',
                'lokasi_sebelumnya' => NULL,
                'lokasi_sekarang' => NULL,
                'id_gedung' => NULL,
                'id_gudang' => NULL,
                'id_blok' => NULL,
                'id_lokasi' => NULL,
                'uid' => 'sadsad',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'id_permintaan' => 1,
                'kode_permintaan' => 'REQ#001',
                'norut' => 2,
                'id_pindah_sebelumnya' => NULL,
                'id_barang' => 2,
                'kode_barang' => 'BRG08',
                'nama_barang' => 'KOMPUTER',
                'qty' => '3',
                'ket' => 'curi',
                'lokasi_sebelumnya' => NULL,
                'lokasi_sekarang' => NULL,
                'id_gedung' => NULL,
                'id_gudang' => NULL,
                'id_blok' => NULL,
                'id_lokasi' => NULL,
                'uid' => 'xcxcxc',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'id_permintaan' => 2,
                'kode_permintaan' => 'ROM#20230527154019294277',
                'norut' => 1,
                'id_pindah_sebelumnya' => NULL,
                'id_barang' => 2,
                'kode_barang' => 'BRG08',
                'nama_barang' => 'KOMPUTER',
                'qty' => '4',
                'ket' => NULL,
                'lokasi_sebelumnya' => NULL,
                'lokasi_sekarang' => NULL,
                'id_gedung' => NULL,
                'id_gudang' => NULL,
                'id_blok' => NULL,
                'id_lokasi' => NULL,
                'uid' => '3d4cb88f-6f61-4e9b-b87a-45af7d918700',
                'created_at' => '2023-05-27 15:40:19',
                'updated_at' => '2023-05-27 15:40:19',
            ),
            3 => 
            array (
                'id' => 4,
                'id_permintaan' => 2,
                'kode_permintaan' => 'ROM#20230527154019294277',
                'norut' => 2,
                'id_pindah_sebelumnya' => NULL,
                'id_barang' => 2,
                'kode_barang' => 'BRG08',
                'nama_barang' => 'KOMPUTER',
                'qty' => '2',
                'ket' => NULL,
                'lokasi_sebelumnya' => NULL,
                'lokasi_sekarang' => NULL,
                'id_gedung' => NULL,
                'id_gudang' => NULL,
                'id_blok' => NULL,
                'id_lokasi' => NULL,
                'uid' => '6b05e1f4-88f6-41e0-9c9b-ee27b5ebf662',
                'created_at' => '2023-05-27 15:40:19',
                'updated_at' => '2023-05-27 15:40:19',
            ),
            4 => 
            array (
                'id' => 5,
                'id_permintaan' => 2,
                'kode_permintaan' => 'ROM#20230527154019294277',
                'norut' => 3,
                'id_pindah_sebelumnya' => NULL,
                'id_barang' => 11,
                'kode_barang' => 'PRY01',
                'nama_barang' => 'Proyektor BenQ',
                'qty' => '2',
                'ket' => NULL,
                'lokasi_sebelumnya' => NULL,
                'lokasi_sekarang' => NULL,
                'id_gedung' => NULL,
                'id_gudang' => NULL,
                'id_blok' => NULL,
                'id_lokasi' => NULL,
                'uid' => '25f7edc8-127b-4858-9ce9-eddefc69622e',
                'created_at' => '2023-05-27 15:40:19',
                'updated_at' => '2023-05-27 15:40:19',
            ),
            5 => 
            array (
                'id' => 6,
                'id_permintaan' => 2,
                'kode_permintaan' => 'ROM#20230527154019294277',
                'norut' => 4,
                'id_pindah_sebelumnya' => NULL,
                'id_barang' => 2,
                'kode_barang' => 'BRG08',
                'nama_barang' => 'KOMPUTER',
                'qty' => '2',
                'ket' => NULL,
                'lokasi_sebelumnya' => NULL,
                'lokasi_sekarang' => NULL,
                'id_gedung' => NULL,
                'id_gudang' => NULL,
                'id_blok' => NULL,
                'id_lokasi' => NULL,
                'uid' => 'dea39229-1543-4151-9cca-3bd69bf508f7',
                'created_at' => '2023-05-27 15:40:19',
                'updated_at' => '2023-05-27 15:40:19',
            ),
            6 => 
            array (
                'id' => 7,
                'id_permintaan' => 3,
                'kode_permintaan' => 'ROM#20230531012358201544',
                'norut' => 1,
                'id_pindah_sebelumnya' => NULL,
                'id_barang' => 2,
                'kode_barang' => 'BRG08',
                'nama_barang' => 'KOMPUTER',
                'qty' => '2',
                'ket' => NULL,
                'lokasi_sebelumnya' => NULL,
                'lokasi_sekarang' => NULL,
                'id_gedung' => NULL,
                'id_gudang' => NULL,
                'id_blok' => NULL,
                'id_lokasi' => NULL,
                'uid' => '523c5c85-6256-41b6-ba10-8f16551d2f18',
                'created_at' => '2023-05-31 01:23:58',
                'updated_at' => '2023-05-31 01:23:58',
            ),
            7 => 
            array (
                'id' => 8,
                'id_permintaan' => 3,
                'kode_permintaan' => 'ROM#20230531012358201544',
                'norut' => 2,
                'id_pindah_sebelumnya' => NULL,
                'id_barang' => 11,
                'kode_barang' => 'PRY01',
                'nama_barang' => 'Proyektor BenQ',
                'qty' => '1',
                'ket' => NULL,
                'lokasi_sebelumnya' => NULL,
                'lokasi_sekarang' => NULL,
                'id_gedung' => NULL,
                'id_gudang' => NULL,
                'id_blok' => NULL,
                'id_lokasi' => NULL,
                'uid' => 'f6f8491d-7245-4e31-b5f9-721eaf27924b',
                'created_at' => '2023-05-31 01:23:58',
                'updated_at' => '2023-05-31 01:23:58',
            ),
        ));
        
        
    }
}