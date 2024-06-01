<?php

namespace App\Http\Controllers;

use App\Models\Skil;
use Illuminate\Http\Request;

class SkilController extends Controller
{
    public function index()
    {
        $skils = Skil::all();
        return view('Admin.skil', compact('skils'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);
        Skil::create($request->all());
        return redirect()->route('skil.index')->with('success', 'Skill created successfully.');
    }

    public function update(Request $request, Skil $skil)
    {
        $request->validate(['nama' => 'required']);
        $skil->update($request->all());
        return redirect()->route('skil.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skil $skil)
    {
        $skil->delete();
        return redirect()->route('skil.index')->with('success', 'Skill deleted successfully.');
    }
}

