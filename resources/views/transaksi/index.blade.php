@extends('app')

@section('title', 'Transaksi')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Daftar Transaksi</h1>

        <div class="relative mb-4">
            <input type="text" id="search-transaksi" class="w-full p-2 border rounded mb-3 text-sm pr-8"
                placeholder="Cari transaksi...">
            <button type="button" id="clear-search"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div id="transaksi-list">
            @include('transaksi._transaksi_list')
        </div>
    </div>

    @include('transaksi._modal_detail')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const transaksiListEl = document.getElementById('transaksi-list');
            const searchInput = document.getElementById('search-transaksi');
            const clearSearchBtn = document.getElementById('clear-search');

            function ajaxLoad(url) {
                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.text();
                    })
                    .then(html => {
                        transaksiListEl.innerHTML = html;
                    })
                    .catch(err => console.error('Error loading page:', err));
            }

            transaksiListEl.addEventListener('click', (e) => {
                const link = e.target.closest('a');
                if (link && link.href.includes('page=')) {
                    e.preventDefault();
                    ajaxLoad(link.href);
                }
            });

            searchInput.addEventListener('input', (e) => {
                const searchTerm = e.target.value.trim();
                const url = new URL(window.location.href);
                clearSearchBtn.classList.toggle('hidden', !searchTerm); 
                if (searchTerm) {
                    url.searchParams.set('search', searchTerm);
                } else {
                    url.searchParams.delete('search');
                }
                ajaxLoad(url.toString());
            });

            clearSearchBtn.addEventListener('click', () => {
                searchInput.value = '';
                clearSearchBtn.classList.add('hidden'); 
                const url = new URL(window.location.href);
                url.searchParams.delete('search');
                ajaxLoad(url.toString());
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('simple-modal');
            const modalContent = document.getElementById('modal-content');
            const closeBtn = document.getElementById('close-modal-btn');
            const prevBtn = document.getElementById('modal-prev');
            const nextBtn = document.getElementById('modal-next');
            const transaksiListEl = document.getElementById('transaksi-list');

            let currentDetails = [];
            let currentIndex = 0;

            function updateModalContent() {
                if (!currentDetails.length) {
                    modalContent.innerHTML =
                        `<tr><td colspan="2" class="p-4 text-center">No details available</td></tr>`;
                    prevBtn.style.display = 'none';
                    nextBtn.style.display = 'none';
                    return;
                }

                const detail = currentDetails[currentIndex];

                modalContent.innerHTML = `
                    <tr><td class="border border-gray-300 px-3 py-2 font-semibold">Detail ID</td><td class="border border-gray-300 px-3 py-2">${detail.id}</td></tr>
                    <tr><td class="border border-gray-300 px-3 py-2 font-semibold">Transaksi ID</td><td class="border border-gray-300 px-3 py-2">${detail.transaksi_id}</td></tr>
                    <tr><td class="border border-gray-300 px-3 py-2 font-semibold">Barang</td><td class="border border-gray-300 px-3 py-2">${detail.barang}</td></tr>
                    <tr><td class="border border-gray-300 px-3 py-2 font-semibold">Harga</td><td class="border border-gray-300 px-3 py-2">Rp ${detail.harga.toLocaleString('id-ID')}</td></tr>
                    <tr><td class="border border-gray-300 px-3 py-2 font-semibold">Jumlah</td><td class="border border-gray-300 px-3 py-2">${detail.jumlah}</td></tr>
                `;

                prevBtn.style.display = currentIndex === 0 ? 'none' : 'inline-block';
                nextBtn.style.display = currentIndex === currentDetails.length - 1 ? 'none' : 'inline-block';
            }

            transaksiListEl.addEventListener('click', (e) => {
                const button = e.target.closest('.open-modal-btn');
                if (!button) return;

                try {
                    currentDetails = JSON.parse(button.dataset.details || '[]');
                } catch (error) {
                    console.error('Invalid detailTransaksis JSON:', error);
                    currentDetails = [];
                }
                currentIndex = 0;
                updateModalContent();

                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });

            closeBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });

            prevBtn.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateModalContent();
                }
            });

            nextBtn.addEventListener('click', () => {
                if (currentIndex < currentDetails.length - 1) {
                    currentIndex++;
                    updateModalContent();
                }
            });
        });
    </script>
@endsection
s