<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MBarangDelete extends Model
{
    use HasFactory, UuidTraits;

    protected $table = 'tbl_barang_delete';
    protected $primaryKey = 'id_barang_delete';
}
