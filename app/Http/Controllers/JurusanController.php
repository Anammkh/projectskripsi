<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = jurusan::all();
        return view('Admin.jurusan', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);
        jurusan::create($request->all());
        return redirect()->route('jurusan.index')->with('success', 'jurusan created successfully.');
    }

    public function update(Request $request, jurusan $jurusan)
    {
        $request->validate(['nama' => 'required']);
        $jurusan->update($request->all());
        return redirect()->route('jurusan.index')->with('success', 'jurusan updated successfully.');
    }

    public function destroy(jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('jurusan.index')->with('success', 'jurusan deleted successfully.');
    }
}

