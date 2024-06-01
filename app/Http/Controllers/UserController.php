<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jurusan;
use App\Models\Skil;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Admin.usermanajemen', compact('users'));
    }
   // UserController.php

   public function showCompleteProfileForm()
   {
       $jurusans = Jurusan::all();
       $skils = Skil::all();
       return view('auth.complete-profil', compact('jurusans', 'skils'));
   }    

   public function completeProfile(Request $request)
   {   
       $request->validate([
           'jenis_kelamin' => ['required', 'string', 'max:255'],
           'ttl' => ['required', 'date'],
           'sekolah' => ['required', 'string', 'max:255'],
           'alamat' => ['required', 'string'],
           'tinggi' => ['required', 'integer'],
           'no_hp' => ['required', 'string', 'max:15'],
           'jurusan_id' => ['required', 'integer', 'exists:jurusans,id'],
           'dokumen_id' => ['required', 'integer', 'exists:dokumens,id'],
           'skil_id' => ['required', 'integer', 'exists:skils,id'],
       ]);

       $userId = Auth::id();
       $user = User::findOrFail($userId);
     
       Pelamar::create([
           'user_id' => $user->id,
           'jenis_kelamin' => $request->jenis_kelamin,
           'ttl' => $request->ttl,
           'sekolah' => $request->sekolah,
           'alamat' => $request->alamat,
           'tinggi' => $request->tinggi,
           'no_hp' => $request->no_hp,
           'jurusan_id' => $request->jurusan_id,
           'dokumen_id' => $request->dokumen_id,
           'skil_id' => $request->skil_id,
       ]);

       return redirect('semualowongan')->with('success', 'Profile completed successfully.');
   
    // Redireksi atau berikan pesan sukses
    }



    public function create()
    {
        return view('Admin.createuser');
    }

    public function store(Request $request)
    {
     // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'roles' => 'required|string|in:admin,pelamar',
    ]);

    // Simpan pengguna baru
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'roles' => $request->roles,
    ]);

    // Redirect ke halaman daftar pengguna dengan pesan sukses
    return redirect()->route('usermanajemen.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
    $user = User::findOrFail($id);
    return view('Admin.edituser', compact('user'));
    }

    public function update(Request $request, $id)
    {
       
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'roles' => 'required|string|in:admin,pelamar',
        'password' => 'nullable|string|min:8|confirmed',

    ]);

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->roles = $request->roles;
    $user->save();

    return redirect()->route('usermanajemen.index')->with('success', 'User berhasil diperbarui.');
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()->route('usermanajemen.index')->with('success', 'User berhasil dihapus.');
    }
}

