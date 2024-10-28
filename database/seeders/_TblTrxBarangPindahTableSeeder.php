<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class _TblTrxBarangPindahTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbl_trx_barang_pindah')->delete();
        
        \DB::table('tbl_trx_barang_pindah')->insert(array (
            0 => 
            array (
                'id_pindah' => 1,
                'kode_pindah' => 'MV#20230522103754002527',
                'ket' => '<br/><br/>MOVING BARANG #BRG08,BG01',
                'user_create' => NULL,
                'user_update' => NULL,
                'uid' => '808c21b1-921c-4c2e-be90-7a36b6f1c456',
                'created_at' => '2023-05-22 10:37:54',
                'updated_at' => '2023-05-22 10:37:54',
            ),
            1 => 
            array (
                'id_pindah' => 2,
                'kode_pindah' => 'MV#20230522103859713893',
                'ket' => '<br/><br/>MOVING BARANG #BRG08,BG01',
                'user_create' => NULL,
                'user_update' => NULL,
                'uid' => 'd88fe8c0-8f20-48b1-abff-56ac6ef8e763',
                'created_at' => '2023-05-22 10:38:59',
                'updated_at' => '2023-05-22 10:38:59',
            ),
            2 => 
            array (
                'id_pindah' => 3,
                'kode_pindah' => 'MV#20230522104011779570',
                'ket' => '<br/><br/>MOVING BARANG #BRG08,BG01',
                'user_create' => NULL,
                'user_update' => NULL,
                'uid' => '29ab7d03-0ddf-472c-9a9f-9be285ed7efd',
                'created_at' => '2023-05-22 10:40:11',
                'updated_at' => '2023-05-22 10:40:11',
            ),
            3 => 
            array (
                'id_pindah' => 4,
                'kode_pindah' => 'MV#20230522113721081127',
                'ket' => 'dipinjem untuk acara meeting<br/><br/>MOVING BARANG #PRY01',
                'user_create' => 'admin',
                'user_update' => NULL,
                'uid' => 'ab01314e-6a60-4586-9f38-f32a5c75c6f9',
                'created_at' => '2023-05-22 11:37:21',
                'updated_at' => '2023-05-22 11:37:21',
            ),
            4 => 
            array (
                'id_pindah' => 5,
                'kode_pindah' => 'MV#20230529020734782619',
                'ket' => 'minjem untuk meeting<br/><br/>MOVING BARANG #PRY01',
                'user_create' => NULL,
                'user_update' => NULL,
                'uid' => '275e5110-38ef-42dc-8176-3516fb060c34',
                'created_at' => '2023-05-29 02:07:34',
                'updated_at' => '2023-05-29 02:07:34',
            ),
            5 => 
            array (
                'id_pindah' => 6,
                'kode_pindah' => 'MV#20230529020932057501',
                'ket' => 'minjem untuk meeting<br/><br/>MOVING BARANG #PRY01',
                'user_create' => NULL,
                'user_update' => NULL,
                'uid' => '233c9a0d-41a3-4a47-a22d-f3d8b6d2daa3',
                'created_at' => '2023-05-29 02:09:32',
                'updated_at' => '2023-05-29 02:09:32',
            ),
        ));
        
        
    }
}