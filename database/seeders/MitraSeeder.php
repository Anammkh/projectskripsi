<?php

namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mitras = [
            [
                'nama' => 'Tokopedia',
                'alamat' => 'Jl. Tokopedia No. 1, Jakarta',
                'deskripsi' => 'Marketplace terbesar di Indonesia.',
                'gambar' => 'tokopedia.jpg',
            ],
            [
                'nama' => 'Bukalapak',
                'alamat' => 'Jl. Bukalapak No. 2, Bandung',
                'deskripsi' => 'Marketplace yang menyediakan berbagai macam produk.',
                'gambar' => 'bukalapak.jpg',
            ],
            [
                'nama' => 'Shopee',
                'alamat' => 'Jl. Shopee No. 3, Surabaya',
                'deskripsi' => 'Marketplace dengan layanan pengiriman cepat.',
                'gambar' => 'shopee.jpg',
            ],
            [
                'nama' => 'Lazada',
                'alamat' => 'Jl. Lazada No. 4, Yogyakarta',
                'deskripsi' => 'Marketplace dengan berbagai penawaran menarik.',
                'gambar' => 'lazada.jpg',
            ],
            [
                'nama' => 'Blibli',
                'alamat' => 'Jl. Blibli No. 5, Semarang',
                'deskripsi' => 'Marketplace dengan berbagai macam produk elektronik.',
                'gambar' => 'blibli.jpg',
            ],
            [
                'nama' => 'JD.ID',
                'alamat' => 'Jl. JD.ID No. 6, Medan',
                'deskripsi' => 'Marketplace yang menjamin keaslian produk.',
                'gambar' => 'jd_id.jpg',
            ],
            [
                'nama' => 'Zalora',
                'alamat' => 'Jl. Zalora No. 7, Bali',
                'deskripsi' => 'Marketplace yang fokus pada produk fashion.',
                'gambar' => 'zalora.jpg',
            ],
            [
                'nama' => 'Tokopedi',
                'alamat' => 'Jl. Tokopedi No. 8, Surabaya',
                'deskripsi' => 'Marketplace dengan layanan pembayaran aman.',
                'gambar' => 'tokopedi.jpg',
            ],
            [
                'nama' => 'Blanja',
                'alamat' => 'Jl. Blanja No. 9, Malang',
                'deskripsi' => 'Marketplace dengan produk lokal dan internasional.',
                'gambar' => 'blanja.jpg',
            ],
            [
                'nama' => 'MatahariMall',
                'alamat' => 'Jl. MatahariMall No. 10, Makassar',
                'deskripsi' => 'Marketplace dengan berbagai penawaran menarik dan diskon.',
                'gambar' => 'mataharimall.jpg',
            ],
        ];

        foreach ($mitras as $mitra) {
            Mitra::create($mitra);
        }
    }
}
