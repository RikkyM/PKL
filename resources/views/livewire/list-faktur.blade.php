<div class="flex h-[91.4vh] select-none flex-col items-center justify-start">

    <!-- Modal -->
    <!-- kirim -->
    <div>
        <div class="fixed inset-0 z-50" x-cloak x-data="{ status: false }" x-show="status"
            x-on:status-validation.window="status = true" x-on:status-close.window="status = false"
            x-on:itemdown.escape.window="status = false" x-on:itemdown.escape.window="resetData">
            <div x-on:click="status = false"
                class="fixed inset-0 left-0 top-0 -z-50 h-screen w-screen rounded-lg bg-black/60 opacity-40"></div>
            <div class="pointer-events-none fixed inset-0 mx-auto flex max-w-2xl items-center justify-center">
                <div
                    class="pointer-events-auto flex w-[300px] flex-col gap-5 rounded-lg bg-[#111322] p-6 text-white lg:w-[500px]">
                    <h2 class="text-xs capitalize text-white lg:text-sm">status</h2>
                    <p class="text-xs normal-case lg:text-sm">Apakah faktur selesai di kirim ?</p>
                    <div class="my-2 flex justify-end gap-3">
                        <a wire:click='updateStatus()' x-on:click='status = false'
                            class="cursor-pointer rounded-sm bg-green-500 px-3 py-1 text-xs capitalize text-white lg:text-sm">Ya</a>
                        <a x-on:click="$dispatch('status-close')"
                            class="cursor-pointer rounded-sm bg-red-500 px-3 py-1 text-xs capitalize text-white lg:text-sm">Tidak</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- endkirim -->

        <!-- tagihan -->

        <div class="fixed inset-0 z-50" x-cloak x-data="{ tagihan: false }" x-show="tagihan"
            x-on:tagihan-validation.window="tagihan = true" x-on:tagihan-close.window="tagihan = false"
            x-on:itemdown.escape.window="tagihan = false" x-on:itemdown.escape.window="resetData">
            <div x-on:click="tagihan = false"
                class="fixed inset-0 left-0 top-0 -z-50 h-screen w-screen rounded-lg bg-black/60 opacity-40"></div>
            <div class="pointer-events-none fixed inset-0 mx-auto flex max-w-2xl items-center justify-center">
                <div
                    class="pointer-events-auto flex w-[300px] flex-col gap-5 rounded-lg bg-[#111322] p-6 text-white lg:w-[500px]">
                    <h2 class="text-xs capitalize text-white lg:text-sm">tagihan</h2>
                    <p class="text-xs normal-case lg:text-sm">Apakah tagihan faktur telah lunas ?</p>
                    <div class="my-2 flex justify-end gap-3">
                        <a wire:click='updateTagihan()' x-on:click='tagihan = false'
                            class="cursor-pointer rounded-sm bg-green-500 px-3 py-1 text-xs capitalize text-white lg:text-sm">Ya</a>
                        <a x-on:click="$dispatch('tagihan-close')"
                            class="cursor-pointer rounded-sm bg-red-500 px-3 py-1 text-xs capitalize text-white lg:text-sm">Tidak</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- endtagihan -->

        <!-- hapus -->
        <div class="fixed inset-0 z-50" x-cloak x-data="{ del: false }" x-show="del"
            x-on:del-validation.window="del = true" x-on:del-close.window="del = false"
            x-on:itemdown.escape.window="del = false" x-on:itemdown.escape.window="resetData">
            <div x-on:click="del = false"
                class="fixed inset-0 left-0 top-0 -z-50 h-screen w-screen rounded-lg bg-black/60 opacity-40"></div>
            <div class="pointer-events-none fixed inset-0 mx-auto flex max-w-2xl items-center justify-center">
                <div
                    class="pointer-events-auto flex w-[300px] flex-col gap-5 rounded-lg bg-white p-6 text-black lg:w-[500px]">
                    <h2 class="text-xs capitalize text-black lg:text-sm">Hapus</h2>
                    <p class="text-xs normal-case lg:text-sm">Apakah anda yakin ingin menghapus faktur tersebut ?</p>
                    <div class="my-2 flex justify-end gap-3">
                        <a wire:click='deleteFaktur()' x-on:click='del = false'
                            class="cursor-pointer rounded-sm bg-green-500 px-3 py-1 text-xs capitalize text-white lg:text-sm">Ya</a>
                        <a x-on:click="$dispatch('del-close')"
                            class="cursor-pointer rounded-sm bg-red-500 px-3 py-1 text-xs capitalize text-white lg:text-sm">Tidak</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- endhapus -->

    <!-- retur -->
    <div x-transition.duration.400ms x-cloak x-show = "show" x-data = "{ show : false }"
        x-on:open-modal.window = "show = true" x-on:close-modal.window = "show = false"
        x-on:itemdown.escape.window = "show = false" wire:itemdown.escape.window='resetData' class="fixed inset-0 z-50">
        <div x-on:click="show = false" wire:click='resetData'
            class="fixed inset-0 left-0 top-0 -z-50 h-screen w-screen rounded-lg bg-black/60 opacity-40"></div>
        <div class="pointer-events-none fixed inset-0 mx-auto flex max-w-2xl items-center justify-center">
            <form wire:submit
                class="pointer-events-auto flex w-[90%] flex-col items-center justify-center gap-5 rounded-lg bg-white py-10 text-black">
                @csrf
                <h2 class="text-lg font-semibold">Barang Retur</h2>
                <div class="w-[90%] space-y-3">
                    <div class="flex w-full flex-col">
                        <label for="faktur">No Faktur</label>
                        <select wire:model='faktur' id="faktur" disabled
                            class="appearance-none border border-black/40 bg-transparent py-1 pl-1 text-black disabled:opacity-70">
                            <option value=""></option>
                            @foreach ($getFaktur as $item)
                                <option value="{{ $item->id }}">{{ $item->no_faktur }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('faktur'))
                        {{ $errors->first('faktur') }}
                    @endif
                    <div class="flex w-full flex-col">
                        <label for="toko">Toko</label>
                        <select id="toko" wire:model='toko' disabled
                            class="appearance-none border border-black/40 bg-transparent py-1 pl-1 text-black disabled:opacity-70">
                            <option value=""></option>
                            @foreach ($getToko as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_toko }}</option>
                            @endforeach
                        </select>
                        {{-- <input id="toko" class="text-black pl-1 py-1 border border-black/40" type="text" wire:model='toko' readonly> --}}
                    </div>
                    <div class="flex w-full flex-col">
                        <label for="note">Note</label>
                        <input id="note" disabled
                            class="border border-black/40 bg-transparent py-1 pl-1 text-black disabled:opacity-70"
                            type="text" wire:model='note'>
                    </div>
                    <div class="flex w-full flex-col">
                        <label for="kembali">Alasan Retur</label>
                        <select wire:model='alasanRetur' id="kembali"
                            class="border border-black/40 bg-transparent py-1 pl-1 text-black focus:outline-0">
                            <option value="">Pilih</option>
                            <option value="barang rusak">Barang Rusak</option>
                            <option value="barang expired">Barang Expired</option>
                        </select>
                    </div>
                    @if ($errors->has('alasanRetur'))
                        {{ $errors->first('alasanRetur') }}
                    @endif
                </div>
                <div class="flex w-full items-center justify-center">
                    <div class="flex w-full flex-col items-center justify-center">
                        @error('getItems.*.qty')
                            <div class="flex items-center justify-center">{{ $message }}</div>
                        @enderror
                        <table class="w-[90%] border-collapse bg-transparent">
                            <thead>
                                <tr class="bg-[#111322] text-white">
                                    <th class="rounded-tl-md text-center">No</th>
                                    <th class="pl-2 text-left">Barang</th>
                                    <th class="text-center">Qty</th>
                                    <th class="rounded-tr-md text-center">Harga</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($getItems as $index => $getItem)
                                    <tr>
                                        <td class="border border-black/40 text-center">{{ $loop->iteration }}</td>
                                        <td class="border border-black/40">
                                            <select disabled
                                                class="appearance-none bg-transparent pl-2 disabled:opacity-70"
                                                wire:model='getItems.{{ $index }}.barang'>
                                                @foreach ($getBarang as $item)
                                                    <option value="{{ $item->barang }}">{{ $item->nama_barang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="border border-black/40 text-center">
                                            <input type="number" step="1" min="1" pattern="\d+"
                                                wire:model.live='getItems.{{ $index }}.qty'
                                                class="w-10 select-none py-1 text-center text-black [appearance:textfield] focus:outline-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                                        </td>
                                        <td class="border border-black/40 text-center">
                                            <input type="text" disabled
                                                wire:model.live='getItems.{{ $index }}.harga'
                                                class="w-28 select-none py-1 text-center text-black [appearance:textfield] focus:outline-0 disabled:opacity-70 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
                <div class="space-x-3">
                    <button wire:click='save' class="bg-green-500 px-3 py-1 text-white" x>Kirim</button>
                    <button type="button" x-on:click="$dispatch('close-modal')" wire:click='resetData'
                        class="bg-red-500 px-3 py-1 text-white">Batal</button>
                </div>
            </form>
        </div>
    </div>
    <!-- endModal -->

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
            <div x-cloak x-show="open" x-transition:enter="transition duration-[.5s]"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition duration-[.5s]" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute right-10 top-5 flex w-max items-center justify-center gap-3 rounded-lg bg-green-400 px-4 py-3 font-bold text-white shadow-[rgba(0,_0,_0,_0.25)_0px_25px_50px_-12px]">
                <i class='bx bx-check bx-sm'></i>
                <span class="capitalize">{{ $pesan }}</span>
            </div>
        </div>
    </div>

    <div class="absolute right-14 top-3">
        <div x-data="{ open: false }" x-init="() => {
            Livewire.on('failed', () => {
                open = true;
                setTimeout(() => {
                    open = false;
                }, 3000)
            })
        }">
            <div x-cloak x-show="open" x-transition:enter="transition duration-[.5s]"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition duration-[.5s]" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute right-10 top-5 flex w-max items-center justify-center gap-3 rounded-lg bg-red-500 px-4 py-3 font-bold text-white shadow-[rgba(0,_0,_0,_0.25)_0px_25px_50px_-12px]">
                <i class='bx bx-check bx-sm'></i>
                <span class="capitalize">{{ $failed }}</span>
            </div>
        </div>
    </div>

    <!-- endnotif -->

    <div class="flex w-[90%] flex-col gap-2">
        @if (auth()->user()->role != 'sopir')
            <div class="mt-10 w-max">
                <a href="{{ route('faktur') }}" class="flex items-center justify-center gap-1"><i
                        class='bx bx-left-arrow-alt bx-xs'></i> <span
                        class="text-xs font-semibold capitalize xl:text-lg">back</span></a>
            </div>
        @endif
        <h2 class="text-sm font-semibold lg:text-lg">List Faktur</h2>
        <div
            class="mt-3 flex w-max items-center justify-center gap-3 border border-black p-1 py-2 pl-2 text-[8px] lg:text-lg">
            <i class='bx bx-search'></i>
            <input id="search" type="text" wire:model.live='search'
                class="w-16 placeholder:text-[8px] focus:outline-0 lg:w-32 lg:text-sm lg:placeholder:text-sm"
                placeholder="Search...">
        </div>
        <table class="mb-10 border-collapse">
            <thead>
                <tr class="bg-[#111322] text-white">
                    <th class="px-1 text-left text-[6px] font-normal lg:px-2 lg:text-sm">No Faktur</th>
                    <th class="w-16 px-1 text-left text-[6px] font-normal md:w-48 lg:px-2 lg:text-sm">Toko</th>
                    <th class="px-1 text-center text-[6px] font-normal lg:px-2 lg:text-sm">Tanggal</th>
                    <th class="w-7 text-center text-[6px] font-normal lg:w-24 lg:text-sm">Sopir</th>
                    <th class="text-center text-[6px] font-normal lg:text-sm">Mobil</th>
                    <th class="px-1 text-center text-[6px] font-normal lg:px-2 lg:text-sm">Tagihan</th>
                    <th class="text-center text-[6px] font-normal lg:text-sm">Status</th>
                    <th class="text-center text-[6px] font-normal lg:text-sm">Retur</th>
                    @if (auth()->user()->role == 'direktur logistik')
                        <th class="text-center text-[6px] font-normal lg:text-sm">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $Items)
                    @if (auth()->user()->role == 'direktur logistik' ||
                            auth()->user()->role == 'admin logistik' ||
                            auth()->user()->role == 'admin fakturis' ||
                            auth()->user()->name == $Items->id_sopir)
                        <tr>
                            <td class="border border-black/30 py-3 text-[6px] lg:text-sm">
                                <a href="{{ url('print-faktur/' . Crypt::encrypt($Items->id)) }}"
                                    class="px-1 text-left hover:text-black/40">{{ $Items->no_faktur }}</a>
                            </td>
                            <td class="lg:px-25 border border-black/30 px-1 py-3 text-left text-[6px] lg:text-sm">
                                {{ $Items->toko }}
                            </td>
                            <td class="border border-black/30 px-1 py-3 text-center text-[6px] lg:text-sm">
                                {{ $Items->tanggal }}</td>
                            <td class="border border-black/30 py-3 text-center text-[6px] lg:text-sm">
                                {{ $Items->id_sopir }}

                            </td>
                            <td class="border border-black/30 px-1 py-3 text-center text-[6px] lg:text-sm">
                                {{ $Items->plat }}
                            </td>
                            <td class="border border-black/30 px-1 py-3 text-center text-[6px] lg:px-2 lg:text-sm">
                                @if ($Items->status == 'Proses' || ($Items->status == 'Selesai' && $Items->tagihan == 'Lunas'))
                                    @if (auth()->user()->role != 'admin logistik' && auth()->user()->role != 'sopir')
                                        {{ $Items->tagihan }} <br> {{ currency_IDR($Items->total) }}
                                    @else
                                        {{ $Items->tagihan }} <br> {{ currency_IDR($Items->total) }}
                                    @endif
                                @else
                                    @if (auth()->user()->role != 'sopir' && auth()->user()->role != 'admin logistik')
                                        <button wire:click='prosesValidation({{ $Items->id }})'
                                            x-on:click='$dispatch("tagihan-validation")'>{{ $Items->tagihan }} <br>
                                            {{ currency_IDR($Items->total) }}</button>
                                    @else
                                        <span>{{ $Items->tagihan }} <br>
                                            {{ currency_IDR($Items->total) }}</span>
                                    @endif
                                @endif
                            </td>
                            @if ($Items->status == 'Selesai')
                                <td class="border border-black/30 py-3 text-center text-[6px] lg:text-sm">
                                    <span class="px-1 text-green-500">{{ $Items->status }}</span>
                                </td>
                            @else
                                @if (auth()->user()->role != 'admin logistik')
                                    <td class="border border-black/30 py-3 text-center text-[6px] lg:text-sm">
                                        <button type="button" wire:click='prosesValidation({{ $Items->id }})'
                                            x-on:click="$dispatch('status-validation')"
                                            class="px-1 text-blue-500">{{ $Items->status }}</button>
                                    </td>
                                @else
                                    <td class="border border-black/30 py-3 text-center text-[6px] lg:text-sm">
                                        <span class="px-1 text-blue-500">{{ $Items->status }}</span>
                                    </td>
                                @endif
                            @endif
                            <td class="border border-black/30 py-3 text-center text-[6px] lg:text-sm">
                                @if ($Items->status == 'Selesai')
                                    @if ($Items->retur != null)
                                        <div class="px-1 text-blue-500">
                                            {{ $Items->retur }}
                                        </div>
                                    @else
                                        @if ($Items->barangRetur)
                                            <div class="mx-auto w-max rounded-md text-red-500">Proses</div>
                                        @else
                                            <div class="text mx-auto w-max rounded-md">Tidak Ada</div>
                                        @endif
                                    @endif
                                @else
                                    @if (auth()->user()->role != 'admin logistik')
                                        <button wire:click='edit({{ $Items->id }})' type="button"
                                            x-on:click="$dispatch('open-modal')"
                                            class="mx-auto flex items-center justify-center px-2 text-[6px] md:text-sm">
                                            Buat
                                        </button>
                                    @else
                                        <span
                                            class="mx-auto flex items-center justify-center px-2 text-[6px] md:text-sm">
                                            Buat
                                        </span>
                                    @endif
                                @endif

                            </td>
                            @if (auth()->user()->role == 'direktur logistik')
                                <td class="border border-black/30 py-3 text-center text-[6px] lg:text-sm">
                                    <button type="button"
                                        class="mx-auto flex items-center justify-center rounded-sm bg-red-500 p-1 text-[6px] text-white md:rounded-md md:p-2 md:text-lg"
                                        wire:click='prosesValidation({{ $Items->id }})'
                                        x-on:click="$dispatch('del-validation')"><i class='bx bx-trash'></i></button>
                                </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
                <div class="pointer-events-none absolute left-0 top-0 flex h-full w-full items-center justify-center">
                    @if (count($list) == 0)
                        <span class="mt-32 capitalize">faktur tidak ditemukan</span>
                    @endif
                </div>
            </tbody>
        </table>
    </div>
</div>
