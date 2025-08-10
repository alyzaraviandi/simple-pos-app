<?php

namespace App\Http\Controllers;

use App\Models\Barang;

use Illuminate\Http\Request;

class BarangController extends Controller
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
            return view('barang._barang_list', compact('barangs'))->render();
        }

        return view('barang.index', compact('barangs'));
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang',
            'nama_barang' => 'required',
            'harga' => 'required|integer|min:0',
        ]);

        Barang::create($request->all());
        return redirect()->route('barang.get')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang,' . $barang->id,
            'nama_barang' => 'required',
            'harga' => 'required|integer|min:0',
        ]);

        $barang->update($request->all());
        return redirect()->route('barang.get')->with('success', 'Barang berhasil diperbarui');
    }
}
