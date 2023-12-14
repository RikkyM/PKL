<div class="@if (!request()->is('login')) h-16 @endif relative z-50 select-none">
    @if (!request()->is('print-faktur/*') && !request()->is('print-retur/*') && !request()->is('login'))
        <div class="absolute left-0 top-0 h-full w-full" x-on:click="$dispatch('close-profil')"></div>
        <header class="relative flex h-[10vh] items-center justify-between px-5">
            @if (auth()->user()->role != 'sopir')
                <button id="btn" class="z-10 hidden text-4xl focus:outline-0 lg:block">
                    <i class='hamburger bx bx-menu cursor-pointer transition-opacity'></i>
                </button>
            @endif

            <div class="absolute right-5">
                <button type="button" class="flex items-center justify-center" x-on:click="$dispatch('toggle')">
                    <h2 class="pointer-events-none mr-2 text-sm lg:text-[1rem]">Hi, {{ Auth::user()->name }}</h2>
                    <i class='bx bxs-user bx-sm'></i>
                    <i class='bx bx-chevron-down'></i>
                </button>
                <div class="before:contents-[''] absolute right-1 z-50 mt-5 w-[115px] rounded-lg bg-[#111322] px-4 capitalize before:absolute before:-top-2 before:right-4 before:-z-10 before:h-5 before:w-5 before:rotate-45 before:bg-[#111322]"
                    x-cloak x-show="tampil" x-transition:enter="transition duration-[.5s]"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition duration-[.5s]" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" x-data="{ tampil: false }" x-on:toggle.window="tampil = !tampil"
                    x-on:close-profil.window="tampil = false" x-on:keydown.escape.window="tampil = false">
                    <ul class="flex flex-col gap-1 py-2 text-white">
                        <li><a href="{{ route('profil') }}" class="text-[16px]"><span
                                    class="block w-full hover:text-gray-300">profil</span></a></li>
                        <li><a href="{{ route('logout') }}" class="text-[16px]"><span
                                    class="block w-full hover:text-gray-300">log out</span></a></li>

                    </ul>
                </div>
        </header>
    @endif
</div>
