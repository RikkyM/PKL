<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Retur;
use App\Models\ReturDetail;
use App\Models\toko;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class ReturController extends Controller
{
    public function index($id)
    {
        try {
            $encryptId = Crypt::decrypt($id);
            $retur = Retur::where('id', $encryptId)->get();
            foreach ($retur as $cn) {
                $cn->kode_tk = toko::find($cn->id_toko)->kode_toko;
                $cn->nama = toko::find($cn->id_toko)->nama_toko;
                $cn->alamat = toko::find($cn->id_toko)->alamat_toko;
            }
            $list = ReturDetail::where('id_retur', $encryptId)->get();
            foreach ($list as $item) {
                $item->kode_brg = Barang::find($item->id_barang)->kode_barang;
                $item->barang = Barang::find($item->id_barang)->nama_barang;
            }

            return view(
                'layout.retur',
                ['data' => $list],
                ['retur' => $retur]
            );
        } catch (DecryptException $e) {
            abort(401);
        }
    }
}
