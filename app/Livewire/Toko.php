<?php

namespace App\Livewire;

use App\Models\toko as ModelsToko;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Bintang Suryasindo')]

class Toko extends Component
{
    use WithPagination;

    public $search;
    public $nama_toko;
    public $kode_toko;
    public $alamat_toko;
    public $no_hp;
    public $id_toko;
    public $status;
    public $update = false;

    public $showNotification = false;

    public $message = '';

    public function tambahToko()
    {
        $this->validate([
            'nama_toko' => 'required|unique:tokos,nama_toko',
            'kode_toko' => 'required|unique:tokos,kode_toko',
            'alamat_toko' => 'required|max:70',
            'no_hp' => 'required|min:10|max:13'
        ], [
            'nama_toko.required' => 'Nama toko perlu di isi',
            'kode_toko.required' => 'Kode toko perlu di isi',
            'nama_toko.unique' => 'Nama toko sudah ada',
            'kode_toko.unique' => 'Kode toko sudah ada',
            'alamat_toko.required' => 'Alamat toko perlu di isi'
        ]);

        $toko = new ModelsToko();
        $toko->nama_toko = $this->nama_toko;
        $toko->kode_toko = $this->kode_toko;
        $toko->alamat_toko = $this->alamat_toko;
        $toko->no_hp = nomorHp($this->no_hp);

        if ($toko->save()) {
            $this->reset(['nama_toko', 'kode_toko', 'alamat_toko', 'no_hp']);
            $this->message = 'tambah data berhasil';
            $this->dispatch('close-modal');
            $this->dispatch('success');
        } else {
            $this->message = 'terjadi kesalahan saat menambahkan data';
            $this->dispatch('error');
        }
    }

    public function edit($id)
    {
        $data = ModelsToko::find($id);
        $this->id_toko = $id;
        $this->nama_toko = $data->nama_toko;
        $this->kode_toko = $data->kode_toko;
        $this->no_hp = $data->no_hp;
        $this->alamat_toko = $data->alamat_toko;
        $this->status = $data->status;
        $this->update = true;
    }

    public function updateToko()
    {
        $rules = [
            'nama_toko' => 'required|unique:tokos,nama_toko,' . $this->id_toko,
            'kode_toko' => 'required|unique:tokos,kode_toko,' . $this->id_toko,
            'alamat_toko' => 'required',
            'no_hp' => 'required',
            'status' => 'required'
        ];
        $message = ([
            'nama_toko.required' => 'Nama toko perlu di isi',
            'kode_toko.required' => 'Kode toko perlu di isi',
            'nama_toko.unique' => 'Nama toko sudah digunakan',
            'kode_toko.unique' => 'Kode toko sudah digunakan',
            'alamat_toko.required' => 'Alamat toko perlu di isi',
            'status.required' => 'Status perlu perlu di isi'
        ]);
        $validated = $this->validate($rules, $message);
        $data = ModelsToko::find($this->id_toko);
        if ($data->update($validated)) {
            $this->resetData();
            $this->message = 'update data berhasil';
            $this->dispatch('close-modal');
            $this->dispatch('success');
        } else {
            $this->message = 'terjadi kesalahan saat update data';
            $this->dispatch('error');
        }
    }

    public function resetSearch()
    {
        $this->search = '';
    }

    public function resetData()
    {
        $this->nama_toko = '';
        $this->kode_toko = '';
        $this->alamat_toko = '';
        $this->no_hp = '';
        $this->status = '';
        $this->id_toko = '';
        $this->update = false;
    }

    public function render()
    {
        if ($this->search != null) {
            $data = ModelsToko::where('nama_toko', 'like', '%' . $this->search . '%')
                ->orWhere('kode_toko', 'like', '%' . $this->search . '%')->paginate();
        } else {
            $data = ModelsToko::orderBy('id', 'desc')->paginate(100);
        }

        return view('livewire.toko', ['toko' => $data]);
    }
}
