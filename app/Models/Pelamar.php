<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_kelamin',
        'ttl',
        'sekolah',
        'alamat',
        'tinggi',
        'no_hp',
        'jurusan_id',
        'user_id',
        'cv',
        'ktp',
        'transkip_nilai',
        'ijazah',
        'kota'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skils()
    {
        return $this->belongsToMany(Skil::class, 'pelamar_skil');
    }
}
