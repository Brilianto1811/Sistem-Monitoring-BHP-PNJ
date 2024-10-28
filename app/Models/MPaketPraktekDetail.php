<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPaketPraktekDetail extends Model
{
    // use HasFactory;
    use HasFactory, UuidTraits;

    protected $table = 'tbl_praktek_mahasiswa_detail';
    protected $primaryKey = 'id_praktek_detail';
}
