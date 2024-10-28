<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MGedung extends Model
{
    use HasFactory, UuidTraits;

    protected $table = 'tbl_gedung';
    protected $primaryKey = 'id_gedung';
}
