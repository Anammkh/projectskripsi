<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Lowongan;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class LandingpageController extends Controller
{
    public function index()
    {
        $jobs = Lowongan::all();
        $mitras = Mitra::with('lowongan')->get();
        $kota = Lowongan::pluck('kota')->unique();
        $jurusan = Jurusan::all();
        return view('welcome', compact('jobs', 'mitras','kota','jurusan'));
    }

    public function editPassword()
    {
        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->get();
        
        return view('Pelamar.edit-password', compact('user'));
    }
    public function updatePassword(Request $request, $id)
    {
        $messages = [
            'required' => 'Kolom :attribute harus diisi.',
            'min' => 'Kolom :attribute harus memiliki minimal :min karakter.',
            'confirmed' => 'Konfirmasi password tidak cocok.',
        ];

        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], $messages);

        $user = User::findOrFail($id);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini salah.');
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }
}
