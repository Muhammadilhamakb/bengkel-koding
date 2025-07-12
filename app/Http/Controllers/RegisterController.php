<?php

namespace App\Http\Controllers;

use App\Models\pasienModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function formRegister()
    {
        return view('layouts.register');
    }
    public function register(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|string|max:225',
                'email' => 'required|string|email|max:225|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'alamat' => 'required|string|max:20',
                'no_hp' => 'required|numeric|digits_between:12,13', // Validasi nomor telepon dengan panjang 12 atau 13 digit
                'no_ktp' => 'required|numeric|digits:16'
            ],
            [

                'no_hp.digits_between' => 'Nomer Hp harus terdiri dari 12 atau 13 digit',
                'no_hp.numeric' => 'Nomer Hp harus angka!',
                'email.unique' => 'Email Sudah Digunakan,Silahkan Gunakan Email yang Lain!',
                'password.min' => 'Password minimal harus 8 karakter',
                'password.confirmed' => 'Password tidak sama!,Sesuaikan dengan password di atas',
                'no_ktp.digits' => 'Nomer KTP harus terdiri dari 16 digit',
                'no_ktp.numeric' => 'Nomer KTP harus angka!',
            ]
        );

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pasien',
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,

        ]);
        $No_RM = pasienModel::generateNoRM();
        pasienModel::firstOrCreate([
            'user_id' => $user->id,
            'no_ktp' => $request->no_ktp,
            'no_rm' => $No_RM,
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
