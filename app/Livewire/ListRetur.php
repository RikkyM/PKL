<?php

namespace App\Livewire;

use App\Models\invoice;
use App\Models\Retur;
use App\Models\toko;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Bintang Suryasindo')]

class ListRetur extends Component
{
    public $search, $validasi, $pesan;
    public $getRetur;

    public function prosesValidation($id)
    {
        $this->validasi = $id;
    }

    public function deleteRetur()
    {
        $id = $this->validasi;
        Retur::find($id)->delete();
        $this->dispatch('pesan');
        $this->pesan = 'Data retur berhasil dihapus';

    }

    public function render()
    {
        if ($this->search != null) {
            $data = Retur::where('no_retur','like','%'.$this->search.'%')
            ->paginate();
        } else {
            $data = Retur::orderBy('id','asc')->paginate(1000);
        }

        foreach ($data as $item) {
            $item->id_toko = toko::find($item->id_toko)->nama_toko;
            $item->no_faktur = invoice::find($item->no_faktur)->no_faktur;
            $item->tanggal = Carbon::parse($item->tanggal)->format('d-M-Y');
        }

        return view('livewire.list-retur', ['list' => $data]);
    }
}
