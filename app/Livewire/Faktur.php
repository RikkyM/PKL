<?php

namespace App\Livewire;

use App\Models\Barang;
use App\Models\invoice;
use App\Models\InvoiceDetail;
use App\Models\mobil;
use App\Models\toko;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Bintang Suryasindo')]

class Faktur extends Component
{

    public $getToko, $getSopir, $getMobil;
    public $pesan = '', $error = '';
    public $faktur, $barang, $harga, $total, $tanggal, $toko, $sopir, $mobil, $note;
    public $orderItems = [];
    public $getItems = [];

    public function mount()
    {
        $this->tanggal= now()->toDateString();
        $this->faktur();
    }

    public function updated()
    {
        foreach($this->orderItems as $v => $key){
            if(!empty($this->orderItems[$v]['barang'])) {
                $barangId = $this->orderItems[$v]['barang'];
                $harga = Barang::find($barangId);
                $this->orderItems[$v]['harga'] = currency_IDR($harga->harga_barang);
            } else {
                $this->orderItems[$v]['qty'] = 0;
                $this->orderItems[$v]['harga'] = (0);
            }
        }

        $this->getItems = [];
        foreach ($this->orderItems as $index) {
            $barang = Barang::where('id', $index['barang'])->get();
            foreach ($barang as $item) {
                $this->getItems[] = [
                    'stock' => $item->stock
                ];
            }
        }

        $this->Total();
    }

    public function faktur()
    {
        $noFaktur = Invoice::latest()->first();
        $bulanTahun = substr(date('Y'), -1) . substr(date('m'), -2);

        if ($noFaktur == null) {
            $nomor = "001";
        } else {
            $nomor = (int)substr($noFaktur->no_faktur, 8, 3) + 1;

            $nomorfaktur = $bulanTahun . '/' . "BSS" . '/' . str_pad($nomor, 3, '0', STR_PAD_LEFT);
        }
        $nomorfaktur = $bulanTahun . '/' . "BSS" . '/' . str_pad($nomor, 3, '0', STR_PAD_LEFT);
        
        $this->faktur = $nomorfaktur;
    }

    public function addBarang()
    {
        $this->orderItems[] = [
            'barang' => '',
            'qty' => 0,
            'harga' => 'Rp. 0',
        ];
    }

    public function save()
    {
        $this->validate([
            'toko' => 'required',
            'tanggal' => 'required',
            'sopir' => 'required',
            'total' => 'required',
            'mobil' => 'required',
            'note' => 'nullable|min:5',
            'orderItems.*.barang' => 'required',
            'orderItems.*.qty' => 'required|numeric|min:1|regex:/^[1-9][0-9]*$/|lte:getItems.*.stock',
        ],[
            'toko.required' => 'Data toko perlu di isi',
            'tanggal.required' => 'Tanggal perlu di isi',
            'sopir.required' => 'Data sopir perlu di isi',
            'mobil.required' => 'Data mobil perlu di isi',
            'note.min' => 'Note harus minimal 5 huruf',
            'orderItems.*.qty.min' => ':attribute minimal pembelian 1',
            'orderItems.*.qty.gte' => ':attribute tidak bisa kurang dari :value',
            'orderItems.*.qty.lte' => ':attribute tidak bisa lebih dari :value'
        ],[
            'orderItems.0.qty' => 'Barang nomor 1',
            'orderItems.1.qty' => 'Barang nomor 2',
            'orderItems.2.qty' => 'Barang nomor 3',
            'orderItems.3.qty' => 'Barang nomor 4',
            'orderItems.4.qty' => 'Barang nomor 5',
            'orderItems.5.qty' => 'Barang nomor 6',
            'orderItems.6.qty' => 'Barang nomor 7',
        ]);

        foreach ($this->orderItems as $orderItem) {
            if (!empty($orderItem['barang'])) {
                $stok = Barang::where('id', $orderItem['barang'])->first();
                if ($stok && $stok->stock >= $orderItem['qty']) {
                    $stok->stock -= $orderItem['qty'];
                    $stok->save();
                    $invoiceItems[] = [
                        'id_barang' => $orderItem['barang'],
                        'harga' => currencyIDRToNumeric($orderItem['harga']),
                        'qty' => $orderItem['qty'],
                    ];
                }
            }
        }

        $invoice = Invoice::create([
            'no_faktur' => $this->faktur,
            'id_toko' => $this->toko,
            'id_sopir' => $this->sopir,
            'id_mobil' => $this->mobil,
            'tanggal' => Carbon::parse($this->tanggal)->format('Y-m-d'),
            'total' => $this->total,
            'note' => $this->note
        ]);
        foreach ($this->orderItems as $item) {
            InvoiceDetail::create([
                'invoice_id' => $invoice->id,
                'id_barang' => $item['barang'],
                'harga' => currencyIDRToNumeric($item['harga']),
                'qty' => $item['qty'],
            ]);
        }
        if($invoice) {
            $this->dispatch('success');
            $this->pesan = 'Faktur berhasil dibuat';
            $this->resetButton();
        } else {
            $this->dispatch('failed');
            $this->error = 'Maaf, terjadi kesalahan saat membuat faktur';
        }
        $this->faktur();
        $this->tanggal= now()->toDateString();
    }

    public function deleteBarang($index)
    {
        unset($this->orderItems[$index]);
        $this->orderItems = array_values($this->orderItems);
    }

    public function Total()
    {

        $this->total = 0;
        foreach($this->orderItems as $item) {
            $this->total += intval(currencyIDRToNumeric($item['harga'])) * intval($item['qty']);
        }
        return $this->total;
    }

    public function resetButton()
    {
        $this->toko = '';
        $this->sopir = '';
        $this->total = currencyIDRToNumeric(0);
        $this->mobil = '';
        $this->note = '';
        $this->orderItems = [];
    }
    
    public function render()
    {
        if(count($this->orderItems) == 0) {
            $this->orderItems[] = [
                'barang' => '',
                'qty' => 0,
                'harga' => 'Rp. 0',
            ];
        }
        
        $this->getToko = toko::where('status', 'Active')->get();
        $this->barang = Barang::all();

        $this->getSopir = User::where('role', 'sopir')->where('status', 'Active')->get();
        $this->getMobil = mobil::all();
        return view('livewire.faktur');
    }
}
