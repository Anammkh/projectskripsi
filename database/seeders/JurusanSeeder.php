<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::create(['nama' => 'Teknik Informatika']);
        Jurusan::create(['nama' => 'Sistem Informasi']);
        Jurusan::create(['nama' => 'Ilmu Komputer']);
    }
}
