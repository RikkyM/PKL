<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_faktur','id_toko','tanggal','id_sopir','total','id_mobil','note','status', 'tagihan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'sopir');
    }
}
