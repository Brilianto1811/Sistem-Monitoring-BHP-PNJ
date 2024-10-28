<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MKelas extends Model
{
    use HasFactory, UuidTraits;

    protected $table = 'tbl_kelas';
    protected $primaryKey = 'id_kelas';
}
