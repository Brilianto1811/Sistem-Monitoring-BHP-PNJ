<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\UuidTraits;

class MLogin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use UuidTraits;

    protected $table = 'tbl_login';
    protected $primaryKey = 'id_login';

    protected $hidden = [
        'password',
    ];
}
