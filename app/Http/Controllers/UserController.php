<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jurusan;
use App\Models\Skil;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
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
       $userId = Auth::id();
       $pelamar = Pelamar::where('user_id', $userId)->first();
       
       $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        $provinces = $response->json();
       if (!$pelamar) {
           $pelamar = new Pelamar();
           $pelamar->user_id = $userId;
       }
   
       return view('auth.complete-profil', compact('pelamar','skils','jurusans','provinces'));

   }    
   

   public function completeProfile(Request $request)
{
    $userId = Auth::id();
    $pelamar = Pelamar::firstOrCreate(['user_id' => $userId]);
    $user = User::find($userId);

    // Handle profile image upload
    if ($request->hasFile('gambar')) {
        if ($user->gambar) {
            Storage::delete($user->gambar);
        }
        $gambarPath = $request->file('gambar')->store('images/profiles', 'public');
        $user->gambar = $gambarPath;
    }

    // Handle other file uploads
    $fileFields = ['cv', 'ktp', 'transkip_nilai', 'ijazah'];
    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {
            if ($pelamar->$field) {
                Storage::delete(public_path($pelamar->$field));
            }
            $path = $request->file($field)->move(public_path('documents'), $request->file($field)->getClientOriginalName());
            $pelamar->$field = 'documents/' . $request->file($field)->getClientOriginalName();
        }
    }

    // Update user name
    $user->name = $request->input('name');
    $user->save();

    // Update pelamar details except file fields
    $pelamar->fill($request->except(array_merge($fileFields, ['skil_id'])));
    $pelamar->save();

    // Update skill relationships
    if ($request->has('skil_id')) {
        $pelamar->skils()->sync($request->input('skil_id'));
    }

    return redirect()->route('complete-profile-form')->with('success', 'Profil berhasil diperbarui.');
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

