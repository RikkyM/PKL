<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangRetur extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_faktur','id_toko','note','alasan_retur'
    ];
}
