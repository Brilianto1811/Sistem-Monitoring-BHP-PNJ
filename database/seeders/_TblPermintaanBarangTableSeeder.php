<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class _TblPermintaanBarangTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbl_permintaan_barang')->delete();
        
        \DB::table('tbl_permintaan_barang')->insert(array (
            0 => 
            array (
                'id_permintaan' => 1,
                'kode_permintaan' => 'REQ#001',
                'id_mahasiswa' => 8,
                'noid' => '123213213',
                'nama' => 'BAYU',
                'id_jurusan' => 1,
                'kode_jurusan' => 'ASDSAD',
                'id_prodi' => 1,
                'kode_prodi' => 'ASDASD',
                'id_kelas' => 1,
                'kode_kelas' => 'ASDSAD',
                'informasi' => 'MUINTA DONG',
                'status_permintaan' => '2',
                'user_create' => 'BAYU',
                'user_update' => 'admin',
                'uid' => 'ASDASDASDASDASDASD',
                'created_at' => NULL,
                'updated_at' => '2023-05-27 10:35:56',
            ),
            1 => 
            array (
                'id_permintaan' => 2,
                'kode_permintaan' => 'ROM#20230527154019294277',
                'id_mahasiswa' => 10,
                'noid' => '123',
                'nama' => 'BAYU',
                'id_jurusan' => 3,
                'kode_jurusan' => 'TM',
                'id_prodi' => 1,
                'kode_prodi' => 'PJJ',
                'id_kelas' => 1,
                'kode_kelas' => 'GSG',
                'informasi' => 'dicuri',
                'status_permintaan' => '1',
                'user_create' => '123',
                'user_update' => 'admin',
                'uid' => 'cb7c737e-9f17-40ac-be02-317a2f7ec046',
                'created_at' => '2023-05-27 15:40:19',
                'updated_at' => '2023-05-27 17:49:23',
            ),
            2 => 
            array (
                'id_permintaan' => 3,
                'kode_permintaan' => 'ROM#20230531012358201544',
                'id_mahasiswa' => 11,
                'noid' => '5',
                'nama' => 'hh',
                'id_jurusan' => 3,
                'kode_jurusan' => 'TM',
                'id_prodi' => 3,
                'kode_prodi' => 'LL',
                'id_kelas' => 5,
                'kode_kelas' => 'B1',
                'informasi' => 'Bbbb',
                'status_permintaan' => '0',
                'user_create' => '4',
                'user_update' => NULL,
                'uid' => '92afddeb-6cb5-4ad0-85eb-bac22a5fb49d',
                'created_at' => '2023-05-31 01:23:58',
                'updated_at' => '2023-05-31 01:23:58',
            ),
        ));
        
        
    }
}