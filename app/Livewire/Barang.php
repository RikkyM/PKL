<?php

namespace App\Livewire;

use App\Models\Barang as ModelsBarang;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Bintang Suryasindo')]


class Barang extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $nama_barang;
    public $stock;
    public $search;
    public $dropdown;

    public $message = '';

    public function tambahBarang() {

        $rules = ([
            'nama_barang' => 'required',
            'stock' => 'required|regex:/([0-9+])$/',
        ]);
        $message = ([
            'nama_barang.required' => 'Barang perlu di isi',
            'stock.required' => 'Jumlah barang perlu di isi',
            'stock.regex' => 'Stock barang hanya boleh di isi dengan angka'
        ]);

        $validated = $this->validate($rules, $message);
        $barang = ModelsBarang::find($this->nama_barang);
        $barang->stock += $this->stock;
        $barang->touch();
        
        if($barang->save($validated)) {
            $this->message = 'Stock berhasil ditambah';
            $this->reset('nama_barang','stock');
            $this->dispatch('close-modal');
            $this->dispatch('success');
        } else {
            $this->message = 'terjadi kesalahan saat menyimpan data';
            $this->dispatch('error');
        }
    }

    public function resetSearch()
    {
        $this->search = '';
    }

    public function resetData() {
        $this->nama_barang = '';
        $this->stock = '';
    }

    public function render()
    {
        if($this->search != null) {
            $data = ModelsBarang::where('nama_barang','like','%'.$this->search.'%')
            ->orWhere('kode_barang','like','%'.$this->search.'%')->paginate();
        } else {
            $data = ModelsBarang::orderBy('id','asc')->paginate(100);
        }

        $this->dropdown = ModelsBarang::all();
        

        return view('livewire.barang', ['table' => $data]);
    }
}
