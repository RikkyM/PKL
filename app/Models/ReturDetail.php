<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_retur','id_barang','harga','qty'
    ];
}
