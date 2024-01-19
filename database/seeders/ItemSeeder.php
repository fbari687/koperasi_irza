<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Gunakan perulangan untuk membuat data dummy
        for ($i = 1; $i <= 45; $i++) {
            DB::table('items')->insert([
                'nama_barang' => "Nama Barang $i",
                'slug' => Str::slug("Nama Barang $i"),
                'deskripsi' => "Deskripsi Barang $i",
                'harga' => rand(10000, 50000),
                'stok' => rand(10, 100),
                'status' => rand(0, 1) ? 'tersedia' : 'habis',
                'gambar' => "gambar$i.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
