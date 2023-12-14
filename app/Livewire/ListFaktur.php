<?php

namespace App\Livewire;

use App\Models\Barang;
use App\Models\BarangRetur;
use App\Models\BarangReturDetail;
use App\Models\invoice;
use App\Models\InvoiceDetail;
use App\Models\mobil;
use App\Models\Retur;
use App\Models\toko;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Bintang Suryasindo')]

class ListFaktur extends Component
{
    use WithPagination;

    public $search;
    public $pesan = '', $failed = '';
    public $validasi, $created;
    public $faktur, $toko, $note, $alasanRetur;
    public $getToko, $getBarang, $getFaktur, $getRetur;
    public $orderItems = [];
    public $getItems = [];

    public function edit($id) {
        $this->created = false;

        $data = invoice::where('id', $id)->get();
        foreach ($data as $arr) {
            $this->faktur = $arr->id;
            $this->toko = $arr->id_toko;
            $this->note = $arr->note;
        }

        $this->orderItems = [];
        $this->getItems = [];

        $details = InvoiceDetail::where('invoice_id', $id)->get();
        // dd($details);
        foreach ($details as $detail) {
            
            $this->orderItems[] = [
                'qty' => $detail->qty,
            ];
            $this->getItems[] = [
                'barang' => $detail->id_barang,
                'qty' => 0,
                'harga' => currency_IDR($detail->harga),
            ];
        }
    }

    public function save()
    {
        $this->validate([
            'faktur' => 'required|unique:returs,no_faktur|unique:barang_returs,no_faktur',
            'alasanRetur' => 'required',
            'getItems.*.qty' => 'gte:0|lte:orderItems.*.qty'
        ],[
            'faktur.unique' => 'Pengajuan barang retur sudah ada/dibuat',
            'alasanRetur' => 'Alasan retur perlu diisi',
            'getItems.*.qty.gte' => ':attribute tidak bisa kurang dari :value',
            'getItems.*.qty.lte' => ':attribute tidak bisa lebih dari :value'
        ], [
            'getItems.0.qty' => 'Barang nomor 1',
            'getItems.1.qty' => 'Barang nomor 2',
            'getItems.2.qty' => 'Barang nomor 3',
            'getItems.3.qty' => 'Barang nomor 4',
            'getItems.4.qty' => 'Barang nomor 5',
            'getItems.5.qty' => 'Barang nomor 6',
            'getItems.6.qty' => 'Barang nomor 7',
        ]);

        $retur = new BarangRetur();
        $retur->no_faktur = $this->faktur;
        $retur->id_toko = $this->toko;
        $retur->note = $this->note;
        $retur->alasan_retur = $this->alasanRetur;
        if ($retur->save()) {
            foreach($this->getItems as $item) {
                BarangReturDetail::create([
                    'barang_retur_id' => $retur->id,
                    'id_barang' => $item['barang'],
                    'qty' => $item['qty'],
                    'harga' => currencyIDRToNumeric($item['harga']),
                ]);
            }

            $this->dispatch('pesan');
            $this->pesan = 'Data barang retur berhasil dibuat';
            $this->dispatch('close-modal');
            $this->resetData();
        } else {
            $this->dispatch('failed');
            $this->failed = 'Maaf, terjadi kesalahan saat membuat retur';
        }
    }

    public function resetData()
    {
        $this->faktur = '';
        $this->toko = '';
        $this->note = '';
        $this->alasanRetur = '';
        $this->getItems = [];
    }

    public function prosesValidation($id)
    {
        $this->validasi = $id;
    }

    public function updateStatus()
    {
        $id = $this->validasi;
        $invoice = Invoice::find($id);

        if ($invoice->status == 'Proses') {
            $invoice->status = 'Selesai';
        }

        $invoice->save();
    }

    public function updateTagihan()
    {
        $id = $this->validasi;
        $invoice = Invoice::find($id);

        if ($invoice->tagihan == 'Belum Lunas') {
            $invoice->tagihan = 'Lunas';
        }
        $invoice->save();
    }

    public function deleteFaktur()
    {
        $id = $this->validasi;
        invoice::find($id)->delete();
        $this->dispatch('pesan');
        $this->pesan = 'Data faktur berhasil dihapus';
    }

    public function render()
    {
        if ($this->search != null) {
            $data = invoice::where('no_faktur','like','%'.$this->search.'%')
            ->orWhere('status', 'like','%'.$this->search.'%')
            ->paginate();
        } else {
            $data = invoice::orderBy('status','asc')
            ->paginate(1000); 
        }
        
        $this->getFaktur = invoice::all();
        $this->getToko = toko::all();
        $this->getBarang = InvoiceDetail::all();
        foreach($this->getBarang as $item) {
            $item->nama_barang = Barang::find($item->id_barang)->nama_barang;
        }

        foreach($data as $Items) {
                $retur = Retur::where('no_faktur', $Items->id)->first();
                $barangRetur = BarangRetur::where('no_faktur', $Items->id)->first();
                $Items->barangRetur = $barangRetur;
                $Items->retur = $retur->no_retur ?? null;
                $Items->toko = toko::find($Items->id_toko)->nama_toko;
                $Items->id_sopir = User::find($Items->id_sopir)->name;
                // dd($Items->id_sopir);
                $Items->mobil = mobil::find($Items->id_mobil)->nama;
                $Items->plat = mobil::find($Items->id_mobil)->plat;
                $Items->tanggal = Carbon::parse($Items->tanggal)->format('d-M-Y');
        }

        return view('livewire.list-faktur', ['list' => $data]);
    }
}
