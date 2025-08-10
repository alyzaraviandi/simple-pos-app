<ul>
    @foreach ($barangs as $barang)
        <li class="flex justify-between items-center py-1 border-b text-sm">
            <!-- Left side: barang info -->
            <div>
                <strong>{{ $barang->nama_barang }}</strong> (Kode: {{ $barang->kode_barang }})<br>
                Harga: Rp {{ number_format($barang->harga, 0, ',', '.') }}
            </div>

            <!-- Right side: buttons -->
            <div class="flex items-center gap-2">
                <a href="{{ route('barang.edit', $barang->id) }}"
                    class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs">
                    Edit
                </a>
                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-xs">
                        Hapus
                    </button>
                </form>
            </div>
        </li>
    @endforeach
</ul>

<div class="mt-4 text-sm">
    {{ $barangs->links() }}
</div>
