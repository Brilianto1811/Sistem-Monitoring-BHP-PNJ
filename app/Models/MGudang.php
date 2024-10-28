<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MGudang extends Model
{
    use HasFactory, UuidTraits;

    protected $table = 'tbl_gudang';
    protected $primaryKey = 'id_gudang';
}
