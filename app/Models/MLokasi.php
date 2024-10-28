<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MLokasi extends Model
{
    use HasFactory, UuidTraits;

    protected $table = 'tbl_lokasi';
    protected $primaryKey = 'id_lokasi';
}
