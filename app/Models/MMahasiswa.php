<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\UuidTraits;
use Ramsey\Uuid\Uuid;

class MMahasiswa extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use UuidTraits;

    protected $table = 'tbl_mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $hidden = [
        'password',
    ];
}
