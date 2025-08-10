<div id="simple-modal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 backdrop-blur-sm bg-opacity-40">
    <div class="bg-white rounded-lg p-6 max-w-md w-full relative text-left shadow-lg px-15">
        <button id="modal-prev"
            class="absolute left-3 top-1/2 transform -translate-y-1/2 bg-gray-200 hover:bg-gray-300 rounded px-3 py-1 text-lg font-bold">
            &lt;
        </button>

        <button id="modal-next"
            class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-gray-200 hover:bg-gray-300 rounded px-3 py-1 text-lg font-bold">
            &gt;
        </button>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th colspan="2" class="border border-gray-300 px-3 py-2 text-left">Detail Transaksi</th>
                </tr>
            </thead>
            <tbody id="modal-content" class="text-gray-700 text-sm">
                <!-- JS will fill rows here -->
            </tbody>
        </table>

        <button id="close-modal-btn" class="mt-6 bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded w-full">
            Close
        </button>
    </div>
</div>
