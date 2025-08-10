<?php

namespace App\Http\Controllers\Api;

use App\Models\Barang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangApiController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|string|unique:barang,kode_barang',
            'nama_barang' => 'required|string',
            'harga' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $barang = Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $barang,
        ], 201);
    }

    public function getAll()
    {
        $barangs = Barang::all();

        return response()->json([
            'success' => true,
            'data' => $barangs,
        ]);
    }

    public function getById($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $barang,
        ]);
    }
}
