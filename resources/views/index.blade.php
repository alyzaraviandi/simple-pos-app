@extends('app')

@section('title', 'Home')

@section('content')
    <div class="text-center mt-10">
        <h1 class="text-4xl font-bold mb-4">Selamat Datang di POS App</h1>
        <p class="text-lg text-gray-600">
            Aplikasi Point of Sales (POS) ini membantu Anda mengelola penjualan, stok barang,
            dan riwayat transaksi dengan mudah dan cepat.
        </p>
        <hr class="mt-6 border-t-4 border-gray-1000">

        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            <a href="{{ route('kasir.get') }}"
                class="bg-blue-600 text-white rounded-xl shadow-lg p-10 flex flex-col items-center justify-center hover:bg-blue-700 transition aspect-square">
                <span class="text-2xl font-bold mb-2">Kasir</span>
                <p class="text-sm text-white/80">Mulai proses penjualan</p>
            </a>
            <a href="{{ route('barang.get') }}"
                class="bg-green-600 text-white rounded-xl shadow-lg p-10 flex flex-col items-center justify-center hover:bg-green-700 transition aspect-square">
                <span class="text-2xl font-bold mb-2">Daftar Barang</span>
                <p class="text-sm text-white/80">Kelola stok dan harga barang</p>
            </a>
            <a href="{{ route('transaksi.get') }}"
                class="bg-yellow-500 text-white rounded-xl shadow-lg p-10 flex flex-col items-center justify-center hover:bg-yellow-600 transition aspect-square">
                <span class="text-2xl font-bold mb-2">Daftar Transaksi</span>
                <p class="text-sm text-white/80">Lihat riwayat penjualan</p>
            </a>
        </div>        
        
    </div>
@endsection
