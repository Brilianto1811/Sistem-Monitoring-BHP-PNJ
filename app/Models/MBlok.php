<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MBlok extends Model
{
    use HasFactory, UuidTraits;

    protected $table = 'tbl_blok';
    protected $primaryKey = 'id_blok';
}
