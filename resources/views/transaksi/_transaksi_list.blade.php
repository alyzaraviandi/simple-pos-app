<table class="w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 p-2 text-left">ID</th>
            <th class="border border-gray-300 p-2 text-left">Tanggal</th>
            <th class="border border-gray-300 p-2 text-left">Total Barang</th>
            <th class="border border-gray-300 p-2 text-left">Total Harga</th>
            <th class="border border-gray-300 p-2 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($transaksis as $transaksi)
            <tr>
                <td class="border border-gray-300 p-2">{{ $transaksi->id }}</td>
                <td class="border border-gray-300 p-2">{{ $transaksi->created_at->format('d-m-Y') }}</td>
                <td class="border border-gray-300 p-2">{{ $transaksi->total_barang }}</td>
                <td class="border border-gray-300 p-2">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                @php
                    $detailArray = $transaksi->details->map(function ($detail) {
                        return [
                            'id' => $detail->id,
                            'transaksi_id' => $detail->transaksi_id,
                            'barang' => $detail->barang->nama_barang,
                            'harga' => $detail->harga,
                            'jumlah' => $detail->jumlah,
                        ];
                    });
                @endphp
                <td class="border border-gray-300 p-2 text-center">
                    <button class="open-modal-btn text-white bg-blue-700 hover:bg-blue-800 rounded px-3 py-1 text-sm"
                        data-id="{{ $transaksi->id }}" data-details='@json($detailArray)'>
                        Detail
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">Tidak ada transaksi</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4 text-sm">
    {{ $transaksis->links() }}
</div>
