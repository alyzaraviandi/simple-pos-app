<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run()
    {
        $items = [];

        for ($i = 1; $i <= 40; $i++) {
            $items[] = [
                'kode_barang' => 'BRG' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_barang' => 'Produk ' . $i,
                'harga' => rand(10000, 500000),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('barang')->insert($items);
    }
}
