<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    public function index()
    {
        $jobs = Lowongan::all();
        return view('welcome', compact('jobs'));
    }
}
