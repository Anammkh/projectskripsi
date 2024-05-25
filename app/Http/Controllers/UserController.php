<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Admin.usermanajemen', compact('users'));
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

