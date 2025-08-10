<nav class="bg-[#1E293B] border-[#F3F4F6] dark:bg-[#1E293B]">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-[#FBBF24]">POS App</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-[#F3F4F6] rounded-lg md:hidden hover:bg-[#38BDF8] focus:outline-none focus:ring-2 focus:ring-[#FBBF24] dark:text-[#F3F4F6] dark:hover:bg-[#38BDF8] dark:focus:ring-[#FBBF24]"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-[#F3F4F6] rounded-lg bg-[#F3F4F6] md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-[#1E293B] dark:bg-[#1E293B] md:dark:bg-[#1E293B] dark:border-[#F3F4F6]">
                <li>
                    <a href="{{ url('/') }}"
                        class="block py-2 px-3
                {{ request()->is('/')
                    ? 'text-[#FBBF24] bg-[#38BDF8] md:bg-transparent md:text-[#FBBF24] dark:text-[#FBBF24] md:dark:text-[#FBBF24]'
                    : 'text-[#1E293B] hover:bg-[#38BDF8] md:hover:bg-transparent md:hover:text-[#38BDF4] dark:text-[#F3F4F6] md:dark:hover:text-[#38BDF8]' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('kasir.get') }}"
                        class="block py-2 px-3 rounded-sm
                {{ request()->routeIs('kasir.get')
                    ? 'text-[#FBBF24] bg-transparent md:bg-transparent md:text-[#FBBF24] dark:text-[#FBBF24] md:dark:text-[#FBBF24]'
                    : 'text-[#1E293B] hover:bg-[#38BDF8] md:hover:bg-transparent md:border-0 md:hover:text-[#38BDF8] dark:text-[#F3F4F6] md:dark:hover:text-[#38BDF8]' }}">
                        Kasir
                    </a>
                </li>
                <li>
                    <a href="{{ route('barang.get') }}"
                        class="block py-2 px-3 rounded-sm
                {{ request()->routeIs('barang.get')
                    ? 'text-[#FBBF24] bg-transparent md:bg-transparent md:text-[#FBBF24] dark:text-[#FBBF24] md:dark:text-[#FBBF24]'
                    : 'text-[#1E293B] hover:bg-[#38BDF8] md:hover:bg-transparent md:border-0 md:hover:text-[#38BDF8] dark:text-[#F3F4F6] md:dark:hover:text-[#38BDF8]' }}">
                        Barang
                    </a>
                </li>
                <li>
                    <a href="{{ route('transaksi.get') }}"
                        class="block py-2 px-3 rounded-sm
                {{ request()->routeIs('transaksi.get')
                    ? 'text-[#FBBF24] bg-transparent md:bg-transparent md:text-[#FBBF24] dark:text-[#FBBF24] md:dark:text-[#FBBF24]'
                    : 'text-[#1E293B] hover:bg-[#38BDF8] md:hover:bg-transparent md:border-0 md:hover:text-[#38BDF8] dark:text-[#F3F4F6] md:dark:hover:text-[#38BDF8]' }}">
                        Transaksi
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
