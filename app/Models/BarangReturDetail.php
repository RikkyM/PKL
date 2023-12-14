<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangReturDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_retur_id','id_barang','qty','harga'
    ];
}
