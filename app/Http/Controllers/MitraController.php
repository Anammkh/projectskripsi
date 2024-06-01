<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MitraController extends Controller
{
    public function index()
    {
        $mitras= Mitra::all();
        return view('Admin.mitra', compact('mitras'));
    }

    public function create()
    {
        $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        $provinces = $response->json();
        return view('Admin.createmitra', compact('provinces'));
    }

    public function store(Request $request)
    {
      
     // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string||max:255|',
        'deskripsi' => 'required|string|',
        'gambar' => 'nullable',
    ]);
    $imageName = ''; 

    if ($request->hasFile('gambar')) {
        $imageName = time().'.'.$request->gambar->extension();  
        $request->gambar->move(public_path('images'), $imageName);
    }
    // Simpan pengguna baru
    Mitra::create([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'deskripsi' => $request->deskripsi,
        'gambar' => $imageName,
        'kota' => $request->kota,
    ]);

    // Redirect ke halaman daftar pengguna dengan pesan sukses
    return redirect()->route('mitra.index')->with('success', 'Mitra berhasil ditambahkan.');
    }

    public function edit($id)
    {
    $mitra = Mitra::findOrFail($id);
    return view('Admin.editmitra', compact('mitra'));
    } 

    public function update(Request $request, Mitra $mitra)    
    {
    $request->validate([
        'nama' => 'required',
        'alamat' => 'required',
        'deskripsi' => 'required',
        'gambar' => 'nullable',
    ]);

    $imageName = ''; 

    if ($request->hasFile('gambar')) {
        $imageName = time().'.'.$request->gambar->extension();  
        $request->gambar->move(public_path('images'), $imageName);
    }

    // Perbarui data mitra
    $mitra->nama = $request->nama;
    $mitra->alamat = $request->alamat;
    $mitra->deskripsi = $request->deskripsi;
    $mitra->gambar = $imageName;

    $mitra->save();

    return redirect()->route('mitra.index')
                     ->with('success','Mitra berhasil diperbarui.');
}


    public function destroy(mitra $mitra)
    {
    
    $mitra->delete();
    return redirect()->route('mitra.index')->with('success', 'mitra deleted successfully.');
    }
}

