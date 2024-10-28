<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MBarang extends Model
{
    use HasFactory, UuidTraits;

    protected $table = 'tbl_barang';
    protected $primaryKey = 'id_barang';
}
