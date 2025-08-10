<?php

namespace App\Http\Controllers;

use App\Models\Barang;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function get(Request $request)
    {
        $query = Barang::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_barang', 'like', "%{$search}%")
                ->orWhere('kode_barang', 'like', "%{$search}%");
        }

        $barangs = $query->paginate(10);

        if ($request->ajax()) {
            return view('kasir._barang_list', compact('barangs'))->render();
        }

        return view('kasir.index', compact('barangs'));
    }

    public function checkout(Request $request)
    {
        \Log::info('Checkout Request Data:', $request->all());

        $validated = $request->validate([
            'items' => ['required', 'array'],
            'items.*.id' => ['required', 'exists:barang,id'],
            'items.*.name' => ['required', 'string'],
            'items.*.price' => ['required', 'numeric'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
        ]);

        DB::beginTransaction();
        try {
            $totalBarang = collect($validated['items'])->sum(fn($item) => $item['qty']);
            $totalHarga  = collect($validated['items'])->sum(fn($item) => $item['price'] * $item['qty']);

            $transaksi = Transaksi::create([
                'tanggal'      => now(),
                'total_barang' => $totalBarang,
                'total_harga'  => $totalHarga,
            ]);

            foreach ($validated['items'] as $item) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id'    => $item['id'],
                    'harga'        => $item['price'] * $item['qty'],
                    'jumlah'       => $item['qty'],
                ]);
            }

            DB::commit();

            return redirect()->route('kasir.get')->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('kasir.get')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
