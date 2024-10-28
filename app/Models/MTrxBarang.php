<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MTrxBarang extends Model
{
    // use HasFactory, UuidTraits;
    use HasFactory;

    protected $table = 'tbl_trx_barang';
    protected $primaryKey = 'id_trx';
}
