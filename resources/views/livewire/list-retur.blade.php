<div class="flex h-[91.4vh] select-none flex-col items-center justify-start">

    <!-- notif -->
    <div class="absolute right-14 top-3">
        <div x-data="{ open: false }" x-init="() => {
            Livewire.on('pesan', () => {
                open = true;
                setTimeout(() => {
                    open = false;
                }, 3000)
            })
        }">
            <div x-cloak x-show="open" x-transition:enter="transition duration-[.5s]" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-[.5s]"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="absolute right-10 top-5 flex w-max items-center justify-center gap-3 rounded-lg bg-green-400 px-4 py-3 font-bold text-white shadow-[rgba(0,_0,_0,_0.25)_0px_25px_50px_-12px]">
                <i class='bx bx-check bx-sm'></i>
                <span class="capitalize">{{ $pesan }}</span>
            </div>
        </div>
    </div>
    <!-- endnotif -->

    <div class="fixed inset-0 z-50" x-cloak x-data="{ del: false }" x-show="del"
        x-on:del-validation.window="del = true" x-on:del-close.window="del = false"
        x-on:itemdown.escape.window="del = false" x-on:itemdown.escape.window="resetData">
        <div x-on:click="del = false"
            class="fixed inset-0 left-0 top-0 -z-50 h-screen w-screen rounded-lg bg-black/60 opacity-40"></div>
        <div class="pointer-events-none fixed inset-0 mx-auto flex max-w-2xl items-center justify-center">
            <div
                class="pointer-events-auto flex w-[300px] flex-col gap-5 rounded-lg bg-white p-6 text-black lg:w-[500px]">
                <h2 class="text-xs capitalize text-black lg:text-sm">Hapus</h2>
                <p class="text-xs normal-case lg:text-sm">Apakah anda yakin ingin menghapus retur tersebut ?</p>
                <div class="my-2 flex justify-end gap-3">
                    <a wire:click='deleteRetur()' x-on:click='del = false'
                        class="cursor-pointer rounded-sm bg-green-500 px-3 py-1 text-xs capitalize text-white lg:text-sm">Ya</a>
                    <a x-on:click="$dispatch('del-close')"
                        class="cursor-pointer rounded-sm bg-red-500 px-3 py-1 text-xs capitalize text-white lg:text-sm">Tidak</a>
                </div>
            </div>
        </div>
    </div>

    <div class="w-[90%]">
        <div class="mt-10 w-max">
            <a href="{{ route('retur') }}" wire:navigate class="flex items-center justify-center gap-1"><i
                    class="bx bx-left-arrow-alt"></i><span
                    class="text-xs font-semibold capitalize lg:text-lg">back</span></a>

        </div>
        <h2
            class="@if (auth()->user()->role == 'sopir') mt-10 @else mt-2 @endif text-sm font-semibold capitalize lg:text-lg">
            list
            retur</h2>
        <div
            class="mt-5 flex w-max items-center justify-center gap-3 border border-black p-1 py-2 pl-2 text-[8px] lg:text-lg">
            <i class="bx bx-search"></i>
            <input type="text" id="search" wire:model.live='search'
                class="w-16 placeholder:text-[8px] focus:outline-0 lg:w-32 lg:text-sm lg:placeholder:text-sm"
                placeholder="Search...">
        </div>
        <table class="mb-10 mt-2 w-full border-collapse bg-transparent">
            <thead class="bg-[#111322] capitalize text-white">
                <tr>
                    <th class="px-1 text-left text-[6px] font-normal lg:px-2 lg:text-sm">no retur</th>
                    <th class="w-10 px-1 text-left text-[6px] font-normal lg:w-48 lg:px-2 lg:text-sm">nama toko</th>
                    <th class="px-1 text-center text-[6px] font-normal lg:px-2 lg:text-sm">tanggal</th>
                    <th class="px-1 text-center text-[6px] font-normal lg:px-2 lg:text-sm">alasan retur</th>
                    <th class="text-center text-[6px] font-normal lg:text-sm">no faktur</th>
                    <th class="px-1 text-left text-[6px] font-normal lg:px-2 lg:text-sm">note</th>
                    <th class="text-left text-[6px] font-normal lg:text-sm">total</th>
                    @if (auth()->user()->role == 'direktur logistik')
                        <th class="text-center text-[6px] font-normal lg:text-sm">action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $item)
                    <tr>
                        <td class="border border-black/30 px-1 py-3 text-[6px] lg:px-2 lg:text-sm">
                            <a href="{{ url('print-retur/' . Crypt::encrypt($item->id)) }}"
                                class="hover:text-black/40">{{ $item->no_retur }}</a>
                        </td>
                        <td class="border border-black/30 px-1 py-3 text-left text-[6px] lg:px-2 lg:text-sm">
                            {{ $item->id_toko }}</td>
                        <td class="border border-black/30 py-3 text-center text-[6px] lg:text-sm">{{ $item->tanggal }}
                        </td>
                        <td class="border border-black/30 py-3 text-center text-[6px] capitalize lg:text-sm">
                            {{ $item->alasan_retur }}
                        </td>
                        <td class="border border-black/30 text-center text-[6px] lg:text-sm">
                            {{ $item->no_faktur }}</td>
                        <td class="border border-black/30 px-1 py-3 text-[6px] capitalize lg:px-2 lg:text-sm">
                            @if ($item->note == null)
                                <span>-</span>
                            @else
                                <span>{{ $item->note }}</span>
                            @endif
                        </td>
                        <td class="w-16 border border-black/30 px-1 py-3 text-[6px] lg:w-max lg:px-2 lg:text-sm">
                            {{ currency_IDR($item->total) }}</td>
                        @if (auth()->user()->role == 'direktur logistik')
                            <td class="border border-black/30 py-3 text-center text-[6px] lg:text-sm">
                                <button type="button" wire:click='prosesValidation({{ $item->id }})'
                                    x-on:click='$dispatch("del-validation")'
                                    class="mx-auto flex w-max items-center justify-center rounded-sm bg-red-500 p-1 text-white lg:rounded-md lg:p-2">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        @endif
                    </tr>
                @endforeach
                <div class="pointer-events-none absolute left-0 top-0 flex h-full w-full items-center justify-center">
                    @if (count($list) == 0)
                        <span class="mt-32 capitalize">retur tidak ditemukan</span>
                    @endif
                </div>
            </tbody>
        </table>
    </div>
</div>
