<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (request()->is('print-faktur/*') || request()->is('print-retur/*') || request()->is('login'))
        <title>@yield('title')</title>
    @else
        <title>{{ $title ?? config('app.name') }}</title>
    @endif

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" type="image/x-icon" href="img/logo.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src="{{ asset('Script/JQuery.js') }}"></script>

    @livewireStyles
</head>

<body class="@if (request()->is('login')) bg-[#111322] @endif font-[poppins]">
    <div class="relative flex h-screen">
        @if (
            !request()->is('print-faktur/*') &&
                !request()->is('print-retur/*') &&
                !request()->is('login') &&
                auth()->user()->role != 'sopir')
            <nav
                class="relative z-10 hidden h-screen w-[70px] space-y-20 overflow-hidden bg-[#111322] transition-all duration-[.5s] lg:block">
                <div class="ml-[6px] mt-6 flex items-center gap-2 text-xl font-semibold text-white">
                    <img src="../../img/logo.png" alt="LOGO" width="56" height="56">
                    <h1 class="sideText select-none capitalize opacity-0 transition-opacity duration-[.3s]">bintang
                        suryasindo</h1>
                </div>
                <ul class="text-xl text-white">
                    <li class="border-t-2 border-gray-500 p-2 pt-5 transition-all duration-[.5s]">
                        <a href="{{ url('/dashboard') }}"
                            class="group/dashboard {{ 'dashboard' == request()->path() ? 'bg-white text-black' : '' }} flex items-center rounded-xl py-2 transition-all duration-[.7s] focus:outline-0">
                            <i class='bx bxs-dashboard ml-[13px] mr-4 text-2xl'></i>
                            <span
                                class="sideText text-sm capitalize opacity-0 transition-opacity duration-[.3s]">dashboard</span>
                            <span
                                class="tooltip pointer-events-none fixed left-[80px] z-50 inline-block w-max rounded-xl bg-black px-4 py-2 text-sm capitalize text-white opacity-0 transition-opacity duration-[.4s] before:absolute before:left-[-5px] before:top-[11px] before:h-3 before:w-3 before:rotate-45 before:bg-black before:content-[''] group-hover/dashboard:opacity-100">dashboard</span>
                        </a>
                    </li>

                    <li class="p-2 transition-all duration-[.5s]">
                        <a href="{{ url('/faktur') }}"
                            class="group/faktur {{ 'faktur' == request()->path() ? 'bg-white text-black' : '' }} {{ 'list-faktur' == request()->path() ? 'bg-white text-black' : '' }} flex items-center rounded-xl py-2 transition-all duration-[.7s] focus:outline-0">
                            <i class='bx bx-receipt ml-[13px] mr-4 text-2xl'></i>
                            <span
                                class="sideText text-sm capitalize opacity-0 transition-opacity duration-[.3s]">faktur</span>
                            <span
                                class="tooltip pointer-events-none fixed left-[80px] z-50 inline-block w-max rounded-xl bg-black px-4 py-2 text-sm capitalize text-white opacity-0 transition-opacity duration-[.4s] before:absolute before:left-[-5px] before:top-[11px] before:h-3 before:w-3 before:rotate-45 before:bg-black before:content-[''] group-hover/faktur:opacity-100">faktur</span>
                        </a>
                    </li>
                    <li class="border-b-2 border-gray-500 p-2 pb-5 transition-all duration-[.5s]">
                        <a href="{{ url('/retur') }}"
                            class="group/barang-retur @if (request()->is('retur') || request()->is('list-retur')) bg-white fill-black text-black
                        @else
                            fill-white @endif flex items-center rounded-xl py-[.66rem] transition-all duration-[.7s] focus:outline-0">
                            <div class="ml-[13px] mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="26" height="26" x="0" y="0"
                                    viewBox="0 0 100 100" style="enable-background:new 0 0 512 512"
                                    xml:space="preserve">
                                    <g>
                                        <path
                                            d="M98 50c0 26.467-21.533 48-48 48S2 76.467 2 50c0-1.658 1.342-3 3-3s3 1.342 3 3c0 23.159 18.841 42 42 42s42-18.841 42-42S73.159 8 50 8c-11.163 0-21.526 4.339-29.322 12H32c1.658 0 3 1.342 3 3s-1.342 3-3 3H14c-1.658 0-3-1.342-3-3V5c0-1.658 1.342-3 3-3s3 1.342 3 3v10.234C25.851 6.786 37.481 2 50 2c26.467 0 48 21.533 48 48zM77 38v27c0 1.251-.776 2.37-1.945 2.81l-24 9a3.04 3.04 0 0 1-2.11 0l-24-9A3.003 3.003 0 0 1 23 65V38c0-1.251.776-2.37 1.945-2.81l24-9a3.036 3.036 0 0 1 2.109 0l24 9A3.002 3.002 0 0 1 77 38zm-42.457 0L50 43.795 65.457 38 50 32.205zM29 62.92l18 6.75V49.08l-18-6.75zm42 0V42.33l-18 6.75v20.59z"
                                            opacity="1">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <span
                                class="sideText whitespace-nowrap text-sm capitalize opacity-0 transition-opacity duration-[.3s]">
                                retur</span>
                            <span
                                class="tooltip pointer-events-none fixed left-[80px] z-50 inline-block w-max rounded-xl bg-black px-4 py-2 text-sm capitalize text-white opacity-0 transition-opacity duration-[.4s] before:absolute before:left-[-5px] before:top-[11px] before:h-3 before:w-3 before:rotate-45 before:bg-black before:content-[''] group-hover/barang-retur:opacity-100">retur</span>
                        </a>
                    </li>
                    <li class="p-2 pt-5 transition-all duration-[.5s]">
                        <a href="{{ url('/barang') }}"
                            class="group/barang {{ 'barang' == request()->path() ? 'bg-white text-black' : '' }} flex items-center rounded-xl py-2 transition-all duration-[.7s] focus:outline-0">
                            <i class='bx bx-package ml-[13px] mr-4 text-2xl'></i>
                            <span
                                class="sideText text-sm capitalize opacity-0 transition-opacity duration-[.3s]">barang</span>
                            <span
                                class="tooltip pointer-events-none fixed left-[80px] z-50 inline-block w-max rounded-xl bg-black px-4 py-2 text-sm capitalize text-white opacity-0 transition-opacity duration-[.4s] before:absolute before:left-[-5px] before:top-[11px] before:h-3 before:w-3 before:rotate-45 before:bg-black before:content-[''] group-hover/barang:opacity-100">barang</span>
                        </a>
                    </li>
                    <li class="p-2 transition-all duration-[.5s]">
                        <a href="{{ url('/toko') }}"
                            class="group/toko {{ 'toko' == request()->path() ? 'bg-white text-black' : '' }} flex items-center rounded-xl py-2 transition-all duration-[.7s] focus:outline-0">
                            <i class='bx bx-store ml-[13px] mr-4 text-2xl'></i>
                            <span
                                class="sideText text-sm capitalize opacity-0 transition-opacity duration-[.3s]">toko</span>
                            <span
                                class="tooltip pointer-events-none fixed left-[80px] z-50 inline-block w-max rounded-xl bg-black px-4 py-2 text-sm capitalize text-white opacity-0 transition-opacity duration-[.4s] before:absolute before:left-[-5px] before:top-[11px] before:h-3 before:w-3 before:rotate-45 before:bg-black before:content-[''] group-hover/toko:opacity-100">toko</span>
                        </a>
                    </li>
                    <li class="p-2 transition-all duration-[.5s]">
                        <a href="{{ url('/sopir') }}"
                            class="group/sopir {{ 'sopir' == request()->path() ? 'bg-white text-black' : '' }} flex items-center rounded-xl py-2 transition-all duration-[.7s] focus:outline-0">
                            <i class='bx bxs-user ml-[13px] mr-4 text-2xl'></i>
                            <span
                                class="sideText text-sm capitalize opacity-0 transition-opacity duration-[.3s]">sopir</span>
                            <span
                                class="tooltip pointer-events-none fixed left-[80px] z-50 inline-block w-max rounded-xl bg-black px-4 py-2 text-sm capitalize text-white opacity-0 transition-opacity duration-[.4s] before:absolute before:left-[-5px] before:top-[11px] before:h-3 before:w-3 before:rotate-45 before:bg-black before:content-[''] group-hover/sopir:opacity-100">sopir</span>
                        </a>
                    </li>
                    <li class="p-2 transition-all duration-[.5s]">
                        <a href="{{ url('/mobil') }}"
                            class="group/mobil {{ 'mobil' == request()->path() ? 'bg-white text-black' : '' }} flex items-center rounded-xl py-2 transition-all duration-[.7s] focus:outline-0">
                            <i class='bx bxs-truck ml-[13px] mr-4 text-2xl'></i>
                            <span
                                class="sideText text-sm capitalize opacity-0 transition-opacity duration-[.3s]">mobil</span>
                            <span
                                class="tooltip pointer-events-none fixed left-[80px] z-50 inline-block w-max rounded-xl bg-black px-4 py-2 text-sm capitalize text-white opacity-0 transition-opacity duration-[.4s] before:absolute before:left-[-5px] before:top-[11px] before:h-3 before:w-3 before:rotate-45 before:bg-black before:content-[''] group-hover/mobil:opacity-100">mobil</span>
                        </a>
                    </li>
                </ul>

            </nav>
        @endif
        <main class="h-full w-screen">
            @if (!request()->is('profil') && !request()->is('login'))
                @livewire('navbar')
            @endif
            <section
                class="@if (!request()->is('login')) overflow-y-auto relative scrollbar scrollbar-track-xl scrollbar-thumb-rounded-xl scrollbar-thumb-teal-500 scrollbar-w-1 @endif">
                @yield('pages')

                @if (!request()->is('print-faktur/*') && !request()->is('print-retur/*') && !request()->is('login'))
                    {{ $slot }}
                @endif

            </section>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('/Script/Script.js') }}"></script>
    @livewireScripts
</body>
