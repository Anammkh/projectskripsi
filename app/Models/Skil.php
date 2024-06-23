<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skil extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function lowongans()
    {
        return $this->belongsToMany(Lowongan::class, 'lowongan_skil', 'skil_id', 'lowongan_id');
    }

    public function pelamars()
    {
        return $this->belongsToMany(Pelamar::class, 'pelamar_skil');
    }
}
