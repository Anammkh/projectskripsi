<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 
        'alamat', 
        'deskripsi', 
        'gambar',
    ];

    public function lowongan()
    {
        return $this->hasMany(Lowongan::class);
    }
    

}
