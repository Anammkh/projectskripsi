<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skil;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skil::create(['nama' => 'PHP']);
        Skil::create(['nama' => 'Laravel']);
        Skil::create(['nama' => 'JavaScript']);
        Skil::create(['nama' => 'Vue.js']);
    }
}
