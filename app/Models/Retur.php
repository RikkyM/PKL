<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_retur','id_toko','tanggal','alasan_retur','no_faktur','note','total'
    ];
}
