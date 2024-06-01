<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::all();
        return view('Admin.lowongan', compact('lowongans'));
    }

    public function create()
    {
        return view('lowongans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'batas_waktu' => 'required|date',
            'posisi' => 'required',
            'persyaratan' => 'required',
            'jurusan_id' => 'required|integer',
            'mitra_id' => 'required|integer',
            'skil_id' => 'required|integer',
        ]);

        Lowongan::create($request->all());

        return redirect()->route('lowongans.index')
                         ->with('success', 'Lowongan created successfully.');
    }

    public function show(Lowongan $lowongan)
    {
        return view('lowongans.show', compact('lowongan'));
    }

    public function edit(Lowongan $lowongan)
    {
        return view('lowongans.edit', compact('lowongan'));
    }

    public function update(Request $request, Lowongan $lowongan)
    {
        $request->validate([
            'judul' => 'required',
            'batas_waktu' => 'required|date',
            'posisi' => 'required',
            'persyaratan' => 'required',
            'jurusan_id' => 'required|integer',
            'mitra_id' => 'required|integer',
            'skil_id' => 'required|integer',
        ]);

        $lowongan->update($request->all());

        return redirect()->route('lowongans.index')
                         ->with('success', 'Lowongan updated successfully.');
    }

    public function destroy(Lowongan $lowongan)
    {
        $lowongan->delete();

        return redirect()->route('lowongans.index')
                         ->with('success', 'Lowongan deleted successfully.');
    }
}

