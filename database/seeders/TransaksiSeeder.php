<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        $transactions = [];

        for ($i = 1; $i <= 20; $i++) {
            $randomDate = Carbon::now()->subDays(rand(0, 30))->setTime(rand(8, 20), rand(0, 59), rand(0, 59));

            $totalBarang = rand(1, 10);

            $totalHarga = $totalBarang * rand(10000, 100000);

            $transactions[] = [
                'tanggal' => $randomDate,
                'total_barang' => $totalBarang,
                'total_harga' => $totalHarga,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('transaksi')->insert($transactions);
    }
}
