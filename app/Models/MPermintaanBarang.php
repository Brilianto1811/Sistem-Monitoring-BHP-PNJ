<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MPermintaanBarang extends Model
{
    use HasFactory;
    // use HasFactory, UuidTraits;

    protected $table = 'tbl_permintaan_barang';
    protected $primaryKey = 'id_permintaan';
}
