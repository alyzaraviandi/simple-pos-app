@extends('app')

@section('title', 'Kasir')

@section('content')
    <div class="max-w-5xl mx-auto p-6">
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-500 text-white">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-3 rounded bg-red-500 text-white">
                {{ session('error') }}
            </div>
        @endif
        <h1 class="text-3xl font-bold mb-6">Kasir</h1>

        <div class="flex flex-col md:flex-row gap-8">
            <div class="w-full md:w-1/2 bg-white p-3 rounded shadow">
                <h2 class="text-lg font-semibold mb-3">Daftar Barang</h2>
                <div class="relative">
                    <input type="text" id="search-barang" class="w-full p-2 border rounded mb-3 text-sm pr-8"
                        placeholder="Cari barang...">
                    <button type="button" id="clear-search"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div id="barang-list">
                    @include('kasir._barang_list')
                </div>
            </div>

            <div class="w-full md:w-1/2 bg-white p-4 rounded shadow flex flex-col">
                <h2 class="text-xl font-semibold mb-4">Keranjang</h2>
                <form id="checkout-form" action="{{ route('kasir.checkout') }}" method="POST" class="flex flex-col h-full">
                    @csrf
                    <table class="w-full text-left mb-4">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <tr>
                                <td colspan="5" class="text-center text-gray-500">Keranjang kosong</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-auto">
                        <div class="font-bold text-lg mb-4">
                            Total: Rp <span id="total-price">0</span>
                        </div>

                        <button type="submit"
                            class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 disabled:opacity-50"
                            id="checkout-btn" disabled>
                            Bayar
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cart = JSON.parse(localStorage.getItem('cart')) || {};
            const cartItemsEl = document.getElementById('cart-items');
            const totalPriceEl = document.getElementById('total-price');
            const checkoutBtn = document.getElementById('checkout-btn');
            const barangListEl = document.getElementById('barang-list');
            const searchInput = document.getElementById('search-barang');
            const clearSearchBtn = document.getElementById('clear-search');

            function updateCart() {
                cartItemsEl.innerHTML = '';
                document.querySelectorAll('#checkout-form input[name^="items"]').forEach(el => el.remove());

                let total = 0;
                const keys = Object.keys(cart);

                if (keys.length === 0) {
                    cartItemsEl.innerHTML =
                        '<tr><td colspan="5" class="text-center text-gray-500">Keranjang kosong</td></tr>';
                    checkoutBtn.disabled = true;
                    totalPriceEl.textContent = '0';
                    return;
                }

                keys.forEach((id, index) => {
                    const item = cart[id];
                    const subtotal = item.price * item.qty;
                    total += subtotal;

                    cartItemsEl.innerHTML += `
            <tr>
                <td>${item.name}</td>
                <td>Rp ${item.price.toLocaleString('id-ID')}</td>
                <td>
                    <input type="number" min="1" value="${item.qty}" data-id="${id}" class="qty-input w-16 border rounded p-1" />
                </td>
                <td>Rp ${subtotal.toLocaleString('id-ID')}</td>
                <td>
                    <button class="remove-btn text-red-600 hover:text-red-800" data-id="${id}">Hapus</button>
                </td>
            </tr>
        `;

                    const form = document.getElementById('checkout-form');
                    form.insertAdjacentHTML('beforeend', `
            <input type="hidden" name="items[${index}][id]" value="${id}">
            <input type="hidden" name="items[${index}][name]" value="${item.name}">
            <input type="hidden" name="items[${index}][price]" value="${item.price}">
            <input type="hidden" name="items[${index}][qty]" value="${item.qty}">
        `);
                });

                totalPriceEl.textContent = total.toLocaleString('id-ID');
                checkoutBtn.disabled = false;
            }

            function attachAddToCartListeners() {
                document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const id = btn.dataset.id;
                        if (cart[id]) {
                            cart[id].qty++;
                        } else {
                            cart[id] = {
                                name: btn.dataset.name,
                                price: parseInt(btn.dataset.price),
                                qty: 1
                            };
                        }
                        updateCart();
                    });
                });
            }

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
                        attachAddToCartListeners();
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

            attachAddToCartListeners();
            updateCart();
        });
    </script>

@endsection
