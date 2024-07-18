<?php

namespace App\Http\Controllers;
use App\Models\Jurusan;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\Mitra;
use App\Models\Pelamar;
use App\Models\Skil;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlahUser = User::count();
        $jumlahLowongan = Lowongan::count();
        $jumlahMitra = Mitra::count();
        $jumlahJurusan = Jurusan::count();
        $jumlahSkill = Skil::count();
        $jumlahlamaran = Lamaran::count();

        return view('home', compact('jumlahUser', 'jumlahLowongan', 'jumlahMitra', 'jumlahJurusan', 'jumlahSkill','jumlahlamaran'));
    }   

    public function profile()
    {
        $user = Auth::user();
        return view('Admin.profile-admin', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    
        // Validasi input
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    
        // Handle file upload
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage');
            $image->move($destinationPath, $name);
            $user->gambar = $name;
        }
    
        // Update nama
        $user->name = $request->input('name');
    
        // Update password jika ada
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
    
        $user->save();
    
        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
    
}
