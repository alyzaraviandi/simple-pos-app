<ul>
    @foreach ($barangs as $barang)
        <li class="flex justify-between py-1 border-b text-sm">
            <div>
                <strong>{{ $barang->nama_barang }}</strong> (Kode: {{ $barang->kode_barang }})<br>
                Harga: Rp {{ number_format($barang->harga, 0, ',', '.') }}
            </div>
            <button class="bg-blue-600 text-white px-2 py-0.5 rounded hover:bg-blue-700 add-to-cart-btn text-xs"
                data-id="{{ $barang->id }}" data-name="{{ $barang->nama_barang }}" data-price="{{ $barang->harga }}">
                Tambah
            </button>
        </li>
    @endforeach
</ul>

<div class="mt-3 text-sm">
    {{ $barangs->links() }}
</div>
