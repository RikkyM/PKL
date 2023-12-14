<?php

namespace App\Livewire;

use App\Models\Barang;
use App\Models\BarangRetur;
use App\Models\BarangReturDetail;
use App\Models\invoice;
use App\Models\Retur as ModelsRetur;
use App\Models\ReturDetail;
use App\Models\toko;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Bintang Suryasindo')]

class Retur extends Component
{
    public $toko, $barang, $retur, $faktur, $tanggal, $total, $note, $kembali;
    public $getToko, $getFaktur, $getBarang, $pesan = '', $error = '';
    public $orderItems = [];

    public function mount()
    {
        $this->tanggal = now()->toDateString();
        $this->retur();
    }

    public function updated()
    {
        if (!empty($this->faktur)) {
            $invoice = BarangRetur::find($this->faktur);
            if ($invoice) {
                $this->orderItems = [];
                
                $this->toko = $invoice->id_toko;
                // dd($this->toko);     
                $this->kembali = $invoice->alasan_retur;
                $this->note = $invoice->note;

                $details = BarangReturDetail::where('barang_retur_id', $this->faktur)->get();
                foreach ($details as $detail) {
                    $this->orderItems[] = [
                        'barang' => $detail->id_barang,
                        'qty' => $detail->qty,
                        'harga' => currency_IDR($detail->harga),
                    ];
                }
            }
        } else {
            $this->orderItems = [];
            $this->toko = '';
            $this->kembali = '';
            $this->note = ''; 
        }

        $this->Total();
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

        $this->getBarang = BarangReturDetail::all();
        foreach($this->getBarang as $item) {
            $item->nama_barang = Barang::find($item->id_barang)->nama_barang;
        }

        $this->getToko = toko::where('status', 'Active')->get();
        $this->getFaktur = BarangRetur::all();
        foreach ($this->getFaktur as $item) {
            $item->no_faktur = invoice::find($item->no_faktur)->no_faktur;
        }

        return view('livewire.retur');
    }

    public function save()
    {
        $this->validate([
            'faktur' => 'required|unique:returs,no_faktur'
        ]);

        $invoices = BarangRetur::find($this->faktur);
        // dd($this->faktur);

        $retur = ModelsRetur::create([
            'no_faktur' => $invoices->no_faktur,
            'no_retur' => $this->retur,
            'id_toko' => $this->toko,
            'tanggal' => $this->tanggal,
            'note' => $this->note,
            'alasan_retur' => $this->kembali,
            'total' => $this->total
        ]);

        foreach($this->orderItems as $item) {
            ReturDetail::create([
                'id_retur' => $retur->id,
                'id_barang' => $item['barang'],
                'qty' => $item['qty'],
                'harga' => currencyIDRToNumeric($item['harga']),
            ]);
        }

        if($retur) {
            $this->dispatch('success');
            $this->pesan = 'Retur berhasil dibuat';
            BarangRetur::find($this->faktur)->delete();
            
            $this->resetButton();
        } else {
            $this->dispatch('failed');
            $this->error = 'Maaf, terjadi kesalahan saat membuat retur';
        }
        $this->retur();
        $this->tanggal= now()->toDateString();
    }

    public function resetButton()
    {
        $this->faktur = '';
        $this->toko = '';
        $this->note = '';
        $this->kembali = '';
        $this->total = currencyIDRToNumeric(0);
        $this->orderItems = [];
        $this->retur();
        $this->tanggal = now()->toDateString();
    }

    public function addBarang()
    {
        $this->orderItems[] =  [
                    'barang' => '',
                    'qty' => 0,
                    'harga' => 0
                ];
    }

    public function retur()
    {
        $noRetur = ModelsRetur::latest()->first();
        $bulanTahun = substr(date('Y'), -1) . substr(date('m'), -2);

        if ($noRetur == null) {
            $nomor = "001";
        } else {
            $nomor = (int)substr($noRetur->no_retur, 8, 3) + 1;

            $nomorRetur = $bulanTahun . '/' . "BSS" . '/' . str_pad($nomor, 3, '0', STR_PAD_LEFT);
        }
        $nomorRetur = $bulanTahun . '/' . "BSS" . '/' . str_pad($nomor, 3, '0', STR_PAD_LEFT);

        $this->retur = $nomorRetur;
    }

    public function Total()
    {
        $this->total = 0;
        foreach($this->orderItems as $item) {
            $this->total += intval(currencyIDRToNumeric($item['harga'])) * intval($item['qty']);
        }
        return $this->total;
    }
}
