<div class="select-none">

    @include('livewire.navbar')

    <div class="absolute top-16 z-50 flex w-full justify-center sm:right-0 sm:top-20 sm:justify-end sm:pr-20">
        <div x-data="{ open: false }" x-init="() => {
            Livewire.on('success', () => {
                open = true;
                setTimeout(() => {
                    open = false;
                }, 3000)
            })
        }">
            <div x-cloak x-show="open" x-transition:enter="transition duration-[.5s]"
                x-transition:enter-start="opacity-0 -translate-y-3 sm:translate-x-3 sm:-translate-y-0"
                x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
                x-transition:leave="transition duration-[.5s]"
                x-transition:leave-start="opacity-100 translate-y-0 sm:translate-x-0"
                x-transition:leave-end="opacity-0 -translate-y-3 sm:translate-x-3 sm:-translate-y-0"
                class="flex w-max items-center justify-center gap-3 rounded-lg bg-green-400 px-4 py-3 font-bold text-white shadow-[rgba(0,_0,_0,_0.25)_0px_25px_50px_-12px]">
                <i class='bx bx-check bx-sm'></i>
                <span class="capitalize">{{ $pesan }}</span>
            </div>
        </div>
    </div>
    <div class="flex h-[90vh] items-center justify-center capitalize">
        <div class="flex w-[90%] items-center justify-center">
            <form wire:submit='update'
                class="relative flex w-72 flex-col items-center justify-center space-y-5 rounded-md bg-white p-3 pb-4 text-[13px] shadow-[rgba(6,_24,_44,_0.4)_0px_0px_0px_2px,_rgba(6,_24,_44,_0.65)_0px_4px_6px_-1px,_rgba(255,_255,_255,_0.08)_0px_1px_0px_inset] sm:w-[40%] sm:space-y-6">
                <div class="flex w-full flex-col items-center justify-center space-y-2 sm:space-y-5 sm:text-sm">
                    <div class="flex w-full justify-center">
                        <h2 class="">form <strong>profil</strong></h2>
                    </div>
                    <div class="flex w-[90%] flex-col">
                        <label for="nama">nama</label>
                        <input wire:model='name' type="text" id="nama" autocomplete="off"
                            class="mt-1 border border-[#111322] py-1 pl-2 rounded-md">
                        @error('name')
                            <div class="text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex w-[90%] flex-col">
                        <label for="username">username</label>
                        <input wire:model='username' type="text" id="username" autocomplete="off"
                            class="mt-1 border border-[#111322] py-1 pl-2 rounded-md">
                        @error('username')
                            <div class="text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="flex w-full flex-col items-center justify-center space-y-2 sm:space-y-5 sm:text-sm">
                    <div class="flex w-full justify-center">
                        <h2 class="space-x-1 font-bold"><i class='bx bx-lock-alt'></i><span>ubah password</span></h2>
                    </div>
                    <div class="flex w-[90%] flex-col">
                        <label for="password_lama">password lama</label>
                        <input wire:model='old_password' type="password" id="password_lama" autocomplete="off"
                            class="mt-1 border border-[#111322] py-1 pl-2 rounded-md">
                        @error('old_password')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex w-[90%] flex-col">
                        <label for="password_baru">password baru</label>
                        <input wire:model='password' type="password" id="password_baru" autocomplete="off"
                            class="mt-1 border border-[#111322] py-1 pl-2 rounded-md">
                    </div>
                    <div class="flex w-[90%] flex-col">
                        <label for="password_confirmation">konfirmasi password</label>
                        <input wire:model='password_confirmation' type="password" id="password_confirmation"
                            class="mt-1 border border-[#111322] py-1 pl-2 rounded-md" autocomplete="off">
                        @error('password')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button
                    class="rounded-md bg-green-500 px-4 py-2 text-sm font-semibold capitalize text-white">simpan</button>
            </form>
        </div>
    </div>

</div>
