<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Bintang Suryasindo')]

class Sopir extends Component
{
    use WithPagination;
    public $user_id, $name, $username, $password, $password_confirmation, $status, $search, $message = '';
    public $update = false;
    public $resetPassword = false;

    public function tambahSopir()
    {
        $rules = [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
        ];
        $message = ([
            'name.required' => 'Nama perlu di isi',
            'username.required' => 'Nama pengguna perlu di isi',
            'username.unique' => 'Nama pengguna sudah digunakan',
            'password.required' => 'Password perlu di isi'
        ]);

        $validated = $this->validate($rules, $message);
        if (User::create($validated))
        {
            $this->message = 'tambah data berhasil';
            $this->dispatch('close-modal');
            $this->resetData();
            $this->dispatch('success');

        } else {
            $this->message = 'terjadi kesalahan saat menambahkan data';
            $this->dispatch('error');
        }
    }

    public function resetData() {
        $this->name = '';
        $this->username = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->update = false;
    }

    public function edit($id) {
        $data = User::find($id);
        $this->user_id = $id;
        $this->name = $data->name;
        $this->username = $data->username;
        $this->status = $data->status;
        $this->update = true;
    }

    public function updateSopir() {
        $rules = [
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$this->user_id,
            'status' => 'required',
        ];
        $message = ([
            'name.required' => 'Nama perlu di isi',
            'username.required' => 'Nama pengguna perlu di isi',
            'username.unique' => 'Nama pengguna sudah digunakan',
            'status.required' => 'Status perlu di isi',
        ]);
        $validated = $this->validate($rules, $message);
        $data = User::find($this->user_id);
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

    public function rst($id) {
        User::find($id);
        $this->user_id = $id;
        $this->resetPassword = true;
    }

    public function updatePassword() {
        $rules = [
            'password' => 'required|confirmed|min:6',
        ];
        $validated = $this->validate($rules);
        $user = User::find($this->user_id);
        $user->password = Hash::make($this->password);

        if($user->update($validated)) {
            $this->message = 'berhasil reset password';
            $this->dispatch('reset-close');
            $this->dispatch('success');
        } else {
            $this->message = 'terjadi kesalahan saat reset password';
            $this->dispatch('error');
        }

        $this->reset(['password','password_confirmation']);
    }

    public function resetSearch()
    {
        $this->search = '';
    }

    public function render()
    {
        if($this->search != null) {
            $data = User::where('role', 'sopir')
            ->when($this->search, function ($query) {
                $query->where(function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere(function($query) {
                        $query->where('username', 'like', '%' . $this->search . '%')
                        ->whereNotIn('username', ['admlog', 'adminv']);
                        });
                });
            })->whereNotIn('name', ['admin logistik', 'admin fakturis'])
            ->paginate(100);
        } else {   
            $data = User::where('role', 'sopir')->paginate();
        }

        return view('livewire.sopir',['table' => $data]);
    }
}
