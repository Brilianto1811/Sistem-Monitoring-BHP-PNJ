<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MPermintaanBarangDetail extends Model
{
    use HasFactory, UuidTraits;

    protected $table = 'tbl_permintaan_barang_detail';
}
