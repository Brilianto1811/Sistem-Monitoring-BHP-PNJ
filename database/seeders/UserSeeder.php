<?php

namespace Database\Seeders;

use App\Models\MLogin;
use App\Models\MMahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MMahasiswa::create([
            'nim' => '11111',
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
        ]);
        MMahasiswa::create([
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
            'user_create' => '-- system --',
        ]);

        MLogin::create([
            'nip' => fake()->numerify('##########'),
            'userid' => 'admin',
            'password' => Hash::make('123'),
            'nama_user' => fake()->name(),
            'level' => 'admin',
            'status_user' => 'aktif',
            'user_create' => '-- system --',
        ]);
        MLogin::create([
            'nip' => fake()->numerify('##########'),
            'userid' => 'operator',
            'password' => Hash::make('123'),
            'nama_user' => fake()->name(),
            'level' => 'operator',
            'status_user' => 'aktif',
            'user_create' => '-- system --',
        ]);
    }
}
