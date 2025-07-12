<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\periksa;
use Carbon\Carbon;
use App\Models\pasienModel;

class AuthSocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $noKtp = str_pad(random_int(1000000000000000, 9999999999999999), 16, '0', STR_PAD_LEFT);
        $SosialUser = Socialite::driver('google')->user();
        $registeredUser = User::where('google_id', $SosialUser->id)->first();

        if (!$registeredUser) {
            $newUser = User::updateOrCreate([
                'google_id' => $SosialUser->id,
            ], [
                'nama' => $SosialUser->name,
                'email' => $SosialUser->email,
                'password' => Hash::make('password'),
                'google_token' => $SosialUser->token,
                'google_refresh_token' => $SosialUser->refreshToken,
                'no_hp' => '-',
                'role' => 'pasien',
                'alamat' => '-',
                'photo' => '',
                'cover_photo' => '',
            ]);
            // Buat data pasien
            pasienModel::firstOrCreate(
                [
                    'user_id' => $newUser->id,
                ],
                [
                    'no_ktp' => $noKtp,
                    'no_rm' => now()->format('YmdHis'),
                ]
            );
            
            Auth::login($newUser);

            return redirect('/dokter');
        }

        Auth::login($registeredUser);

        return redirect('/dokter');
    }
}
