<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{

    public $name, $username, $password, $old_password, $password_confirmation, $pesan;
    
    public function render()
    {
        $this->name = Auth::user()->name;
        $this->username = Auth::user()->username;
        return view('livewire.profile');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'nullable|confirmed|min:5',
            'old_password' => 'nullable|min:5',
        ]);

        $pengguna = Auth::user();
        

        if ($this->password) {
            if (Hash::check($this->old_password, $pengguna->password)) {
                $pengguna->password = Hash::make($this->password);
                $pengguna->save();
                $this->resetData();
                $this->dispatch('success');
                $this->pesan = 'proses berhasil';
            } else {
                $this->addError('old_password', 'password lama yang anda masukkan salah');
            }
        } else if ($this->name && $this->username) {
            $pengguna->name = $this->name;
            $pengguna->username = $this->username;
            $pengguna->save();
            $this->resetData();
            $this->dispatch('success');
            $this->pesan = 'proses berhasil';
        }
    }

    public function resetData()
    {
        $this->old_password = '';
        $this->password = '';
        $this->password_confirmation = '';
    }
}
