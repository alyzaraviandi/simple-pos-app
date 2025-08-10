<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailTransaksiSeeder extends Seeder
{
    public function run()
    {
        $transaksis = DB::table('transaksi')->pluck('id');
        $barangs = DB::table('barang')->select('id', 'harga')->get();

        $detailTransaksis = [];

        foreach ($transaksis as $transaksiId) {
            
            $numDetails = rand(1, 5);

            $selectedBarangIds = $barangs->random($numDetails);

            foreach ($selectedBarangIds as $barang) {
                $jumlah = rand(1, 10);
                $harga = $barang->harga; 

                $detailTransaksis[] = [
                    'transaksi_id' => $transaksiId,
                    'barang_id' => $barang->id,
                    'harga' => $harga,
                    'jumlah' => $jumlah,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('detail_transaksi')->insert($detailTransaksis);
    }
}
