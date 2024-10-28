<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MJurusan extends Model
{
    use HasFactory, UuidTraits;

    protected $table = 'tbl_jurusan';
    protected $primaryKey = 'id_jurusan';
}
