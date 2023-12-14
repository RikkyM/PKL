<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toko extends Model
{
    use HasFactory;

    protected $fillable = ['nama_toko', 'kode_toko', 'alamat_toko', 'no_hp', 'status'];
}
