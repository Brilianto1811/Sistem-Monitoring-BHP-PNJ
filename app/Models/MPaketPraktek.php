<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPaketPraktek extends Model
{
    // use HasFactory;
    use HasFactory, UuidTraits;

    protected $table = 'tbl_praktek_mahasiswa';
    protected $primaryKey = 'id_praktek';
}
