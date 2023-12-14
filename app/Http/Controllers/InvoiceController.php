<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\invoice;
use App\Models\InvoiceDetail;
use App\Models\toko;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class InvoiceController extends Controller
{
    public function index($id)
    {
        try {
            $encryptId = Crypt::decrypt($id);
            $faktur = invoice::where('id', $encryptId)->get();
            foreach($faktur as $invoice) {
                $invoice->kode_tk = toko::find($invoice->id_toko)->kode_toko;
                $invoice->nama = toko::find($invoice->id_toko)->nama_toko;
                $invoice->alamat = toko::find($invoice->id_toko)->alamat_toko;
            }

            $list = InvoiceDetail::where('invoice_id',$encryptId)->get();
            foreach($list as $item) {
                $item->kode_brg = Barang::find($item->id_barang)->kode_barang;
                $item->barang = Barang::find($item->id_barang)->nama_barang;
            }

            return view('layout.invoice',
            ['data' => $list],
            ['faktur' => $faktur]);

        } catch (DecryptException $e) {
            abort(401);
        }
    }
}
