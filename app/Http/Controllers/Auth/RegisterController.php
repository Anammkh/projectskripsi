<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/complete-profile'; // Redirect ke halaman melengkapi profil

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $pelamar = Pelamar::create([
            'user_id' => $user->id,
            // Tambahkan atribut-atribut lain yang sesuai dengan data pelamar
            'jenis_kelamin' => $request->jenis_kelamin,
            'ttl' => $request->ttl,
            'sekolah' => $request->sekolah,
            'alamat' => $request->alamat,
            'tinggi' => $request->tinggi,
            'no_hp' => $request->no_hp,
            'jurusan_id' => $request->jurusan_id,
            // dan seterusnya...
        ]);
    }

    protected function registered(Request $request, $user)
    {
        $request->session()->put('new_user_id', $user->id);
    }
}
