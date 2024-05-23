<?php

namespace App\Services\Auth;

use Log;
use Alert;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthService
{
    public function error($kalimat){
        Alert::error('Maaf', $kalimat);
        return redirect()->back()->withInput();
    }
    
    // public function loginIndex()
    // {
        // return Socialite::driver('keycloak')->scopes(['profile'])->redirect();
    // }

    public function login(Request $request)
    {
        try {

            // $response   = Socialite::driver('keycloak')->stateless()->user();
            
            // $data       = $response->getRaw()['info'];

            // $user       = User::updateOrCreate(
            // ['NIP' => $data['NIP']],
            // [
            //     'fullname'  => $data['NamaLengkap'],
            //     'NIP'       => $data['NIP'],
            //     'new_NIP'   => $data['NIPBaru'],
            //     'email'     => $data['Email'],
            //     'unit'      => $data['NamaUnitKerja'],
            // ]);

            // Auth::login($user);
            // Alert::success('success', 'Anda berhasil login');
            // return redirect('/');
            $user = User::where('new_NIP', $request->nip)->first();
            if(!$user){
                return $this->error('NIP tidak terdaftar', '/login');
            }

            if(Auth::Attempt([
                'new_NIP'   => $request->nip,
                'password'  => $request->password,
            ])){

                Alert::success('success', 'Anda berhasil login');
                return redirect('/');
            }

            return $this->error('Password Anda Salah', '/login');
        } catch(Exception $e) {
            Log::error($e->getMessage());
            Alert::error('Maaf', 'terjadi kesalahan');
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::logout();
        Alert::success('success', 'Anda berhasil logout');
        // return redirect(Socialite::driver('keycloak')->getLogoutUrl(url('/')));
        return redirect('/');
    }
}
