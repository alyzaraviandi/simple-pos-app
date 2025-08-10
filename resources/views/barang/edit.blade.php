@extends('app')

@section('content')
    <div class="max-w-lg mx-auto bg-white shadow-md rounded p-6">
        <h1 class="text-lg font-bold mb-4">Edit Barang</h1>
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red rounded border border-red-300">
                <strong>Perhatian!</strong> Ada masalah dengan input Anda:
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang"
                    value="{{ old('nama_barang', $barang->nama_barang) }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm"
                    required>
            </div>

            <div class="mb-4">
                <label for="kode_barang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
                <input type="text" name="kode_barang" id="kode_barang"
                    value="{{ old('kode_barang', $barang->kode_barang) }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm"
                    required>
            </div>

            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="harga" id="harga" value="{{ old('harga', $barang->harga) }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm"
                    required>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('barang.get') }}"
                    class="px-4 py-2 bg-red-500 rounded hover:bg-gray-400 text-sm">Batal</a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">Simpan</button>
            </div>
        </form>
    </div>
@endsection
