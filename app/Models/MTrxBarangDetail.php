<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MTrxBarangDetail extends Model
{
    use HasFactory, UuidTraits;

    protected $table = 'tbl_trx_barang_detail';
}
