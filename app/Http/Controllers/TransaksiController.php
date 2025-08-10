<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function get(Request $request)
    {
        $query = Transaksi::with('details');

        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('tanggal', 'like', "%{$search}%")
                    ->orWhere('total_barang', 'like', "%{$search}%")
                    ->orWhere('total_harga', 'like', "%{$search}%")
                    ->orWhereHas('details', function ($q) use ($search) {
                        $q->whereHas('barang', function ($q) use ($search) {
                            $q->where('nama_barang', 'like', "%{$search}%");
                        });
                    });
            });
        }

        $transaksis = $query->paginate(10);

        if ($request->ajax()) {
            return view('transaksi._transaksi_list', compact('transaksis'))->render();
        }

        return view('transaksi.index', compact('transaksis'));
    }
}
