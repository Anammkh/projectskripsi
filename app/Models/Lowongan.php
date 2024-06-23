<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'batas_waktu',
        'posisi',
        'persyaratan',
        'jurusan_id',
        'mitra_id',
        'skil_id',
        'kota',
    ];

    public function jurusans()
    {
        return $this->belongsToMany(Jurusan::class, 'lowongan_jurusan', 'lowongan_id', 'jurusan_id');
    }

    // Relasi dengan Skil
    public function skils()
    {
        return $this->belongsToMany(Skil::class, 'lowongan_skil', 'lowongan_id', 'skil_id');
    }

    // Relasi dengan Mitra
    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function getPersyaratanAttribute($value)
    {
        return json_decode($value, true);
    }

}

