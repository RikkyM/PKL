<?php

namespace App\Livewire;

use App\Models\mobil as ModelsMobil;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Bintang Suryasindo')]

class Mobil extends Component
{
    use WithPagination;
    public $search, $nama, $plat, $id_mobil, $message;
    public $update = false;

    public function render()
    {
        if ($this->search != null) {
            $data = ModelsMobil::where('nama','like','%'.$this->search.'%')
            ->orWhere('plat','like','%'.$this->search.'%')
            ->paginate();
        } else {
            $data = ModelsMobil::orderBy('id', 'asc')->paginate();
        }
        
        return view('livewire.mobil', ['data' => $data]);
    }

    public function tambahMobil()
    {
        $rules = [
            'nama' => 'required',
            'plat' => 'required|unique:mobils,plat'
        ];
        $message = [
            'nama.required' => 'nama perlu di isi',
            'plat.required' => 'nomor polisi perlu di isi'
        ];
        $validated = $this->validate($rules, $message);
        if (ModelsMobil::create($validated)) {
            $this->message = 'tambah data berhasil';
            $this->dispatch('close-modal');
            $this->dispatch('success');
            $this->resetData();
        } else {
            $this->message = 'terjadi kesalahan saat menambahkan data';
            $this->dispatch('error');
        }
    }
    
    public function updateMobil()
    {
        $rules = [
            'nama' => 'required',
            'plat' => 'required|unique:mobils,plat',
        ];
        $message = [
            'nama.required' => 'nama perlu di isi',
            'plat.required' => 'nomor polisi perlu di isi'
        ];
        $validated = $this->validate($rules, $message);
        $data = ModelsMobil::find($this->id_mobil);
        if($data->update($validated)) {
            $this->resetData();
            $this->message = 'update data berhasil';
            $this->dispatch('close-modal');
            $this->dispatch('success');
        } else {
            $this->message = 'terjadi kesalahan saat mengubah data';
            $this->dispatch('error');
        }
    }

    public function edit($id)
    {
        $data = ModelsMobil::find($id);
        $this->id_mobil = $id;
        $this->nama = $data->nama;
        $this->plat = $data->plat;
        $this->update = true;
    }

    public function resetSearch()
    {
        $this->search = '';
    }

    public function resetData()
    {
        $this->nama = '';
        $this->plat = '';
        $this->update = false;
    }
}
