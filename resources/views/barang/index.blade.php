@extends('app')

@section('title', 'Daftar Barang')

@section('content')
    <div class="max-w-3xl mx-auto p-6">
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-500 text-white">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Daftar Barang</h1>
            <a href="{{ route('barang.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                + Tambah Barang
            </a>
        </div>

        <div class="relative ">
            <input type="text" id="search-barang" class="w-full p-2 border rounded mb-3 text-sm pr-8"
                placeholder="Cari barang...">
            <button type="button" id="clear-search"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div id="barang-list">
            @include('barang._barang_list')
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const barangListEl = document.getElementById('barang-list');
            const searchInput = document.getElementById('search-barang');
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
                        barangListEl.innerHTML = html;
                    })
                    .catch(err => console.error('Error loading page:', err));
            }

            barangListEl.addEventListener('click', (e) => {
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
@endsection
