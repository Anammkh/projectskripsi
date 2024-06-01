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
        'skil_id'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function skil()
    {
        return $this->belongsTo(Skil::class);
    }
}
