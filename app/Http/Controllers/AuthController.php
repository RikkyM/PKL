<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() {
        return view('layout.login');
    }

    public function login(Request $req) {
        $req->validate([
            'username' => 'exists:users,username'
        ], [
            'username.exists' => 'Username tidak ditemukan.'
        ]);


        $user = User::where('username', $req->username)->first();
        if (Hash::check($req->password, $user->password)) {
            Auth::attempt(['username' => $req->username, 'password' => $req->password]);
            if (auth()->user()->role != 'sopir') {
                return redirect('/dashboard');
            } elseif (auth()->user()->role == 'sopir') {
                return redirect('/list-faktur');
            }
        } else {
            return redirect()->back()->withErrors(['password'=>'Password yang Anda masukkan salah']);
        }

    }

    public function logout() {
        Auth::logout();

        return redirect('/login');
    }
}
