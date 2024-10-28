<?php

namespace Database\Seeders;

use App\Models\Mlogin;
use App\Models\Mmahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class seedUserUjicoba extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Mmahasiswa::create([
            'nim' => '11111',
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
        ]);
        Mmahasiswa::create([
            'nim' => fake()->numerify('##########'),
            'password' => Hash::make('123'),
            'nama_mahasiswa' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telp' => fake()->numerify('##########'),
            'alamat' => fake()->address(),
        ]);

        Mlogin::create([
            'nip' => fake()->numerify('##########'),
            'userid' => 'admin',
            'password' => Hash::make('123'),
            'nama_user' => fake()->name(),
            'status_user' => 'aktif',
        ]);
        Mlogin::create([
            'nip' => fake()->numerify('##########'),
            'userid' => 'operator',
            'password' => Hash::make('123'),
            'nama_user' => fake()->name(),
            'level' => 'operator',
            'status_user' => 'aktif',
        ]);
    }
}
