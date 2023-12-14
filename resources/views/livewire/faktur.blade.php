<div class="select-none h-[91.4vh]">
    <div class="flex justify-center">
        <div class="w-[90%]">
            <h2 class="mt-10 w-max text-2xl font-semibold capitalize">buat faktur penjualan</h2>
            <h2 class="mb-5 w-max text-xl font-semibold capitalize text-black/[47%]">detail pembeli</h2>
        </div>
    </div>

    <div class="absolute right-14 top-3">
        <div x-data="{ open: false }" x-init="() => {
            Livewire.on('success', () => {
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
                <span class="capitalize">{{ $error }}</span>
            </div>
        </div>
    </div>

    <div class="flex w-full justify-center">
        <form wire:submit
            class="flex w-[90%] justify-between rounded-md border border-black/50 px-5 py-4 shadow-[5px_5px_3px_0_rgba(0,0,0,.3)]">
            @csrf
            <div class="relative flex w-[70%] flex-col gap-3 p-2">
                <div class="flex capitalize">
                    <div class="flex w-[50%] flex-col p-3">
                        <label class="font-semibold text-black/[47%]" for="toko">toko</label>
                        <select id="toko" wire:model='toko'
                            class="rounded-md border border-[#111322] px-2 py-1 capitalize focus:outline-[#111322]">
                            <option value="">pilih toko</option>
                            @foreach ($getToko as $shop)
                                <option value="{{ $shop->id }}">{{ $shop->nama_toko }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('toko'))
                            {{ $errors->first('toko') }}
                        @endif
                    </div>
                    <div class="flex w-[50%] justify-end p-3">
                        <a href="{{ route('list-faktur') }}" wire:navigate
                            class="mt-5 flex max-h-9 items-center justify-center gap-3 rounded-lg bg-blue-500 px-3 py-2 text-sm text-white">
                            <i class='bx bx-loader bx-xs'></i>
                            <span>List Faktur</span>
                        </a>
                    </div>
                </div>
                <div class="flex capitalize">
                    <div class="flex w-[50%] flex-col p-3">
                        <label class="font-semibold text-black/[47%]" for="sopir">sopir</label>
                        <select id="sopir" wire:model='sopir'
                            class="rounded-md border border-[#111322] px-2 py-1 capitalize focus:outline-[#111322]">
                            <option value="">pilih sopir</option>
                            @foreach ($getSopir as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('sopir'))
                            {{ $errors->first('sopir') }}
                        @endif
                    </div>
                    <div class="flex w-[50%] flex-col p-3">
                        <label class="font-semibold text-black/[47%]" for="mobil">mobil</label>
                        <select id="mobil" wire:model='mobil'
                            class="rounded-md border border-[#111322] px-2 py-1 capitalize focus:outline-[#111322]">
                            <option value="">pilih mobil</option>
                            @foreach ($getMobil as $truk)
                                <option value="{{ $truk->id }}">{{ $truk->nama }} - {{ $truk->plat }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('mobil'))
                            {{ $errors->first('mobil') }}
                        @endif
                    </div>
                </div>
                <div class="flex flex-col bg-white p-3">
                    <label class="font-semibold text-black/[47%]" for="note">Note</label>
                    <input type="text" id="note" wire:model='note'
                        class="rounded-md border border-[#111322] p-2 focus:outline-[#111322]">
                    @if ($errors->has('note'))
                        {{ $errors->first('note') }}
                    @endif
                </div>
                <div class="flex">
                    <div class="flex w-full flex-col p-3">
                        <h2 class="w-max font-semibold capitalize text-black/[47%]">Detail
                            Barang</h2>
                        @error('orderItems.*.qty')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                        <table class="w-full border-collapse bg-transparent capitalize">
                            <thead>
                                <tr class="text-sm capitalize text-white">
                                    <th class="w-12 rounded-tl-md bg-[#111322] px-3 py-2 text-center font-semibold">
                                        no
                                    </th>
                                    <th class="w-80 bg-[#111322] px-3 py-2 text-left font-semibold">barang</th>
                                    <th class="w-24 bg-[#111322] px-3 py-2 font-semibold">qty</th>
                                    <th class="w-44 bg-[#111322] px-3 py-2 font-semibold">harga</th>
                                    <th class="w-44 rounded-tr-md bg-[#111322] px-3 py-2 font-semibold">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $index => $orderItem)
                                    <tr>
                                        <td class="border border-black/20 py-4 text-center">{{ $loop->iteration }}
                                        </td>
                                        <td class="border border-black/20 px-3">
                                            <select id="barang" class="w-full px-2 capitalize focus:outline-0"
                                                wire:model.live='orderItems.{{ $index }}.barang'>
                                                <option value="">pilih barang</option>
                                                @foreach ($barang as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($item->stock === 0) disabled @endif>
                                                        {{ $item->nama_barang }} @if ($item->stock === 0)
                                                            - Stock Kosong
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="border border-black/20 px-3 text-center">
                                            <input type="number" id="qty" step="1" min="1" @if(empty($orderItems[$index]['barang'])) disabled @endif
                                                pattern="\d+" wire:model.live='orderItems.{{ $index }}.qty'
                                                class="w-24 text-center [appearance:textfield] focus:outline-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                                        </td>
                                        <td class="border border-black/20 px-3">
                                            <input type="text" id="harga"
                                                wire:model='orderItems.{{ $index }}.harga'
                                                class="w-full cursor-auto pl-8 focus:outline-0" readonly>
                                        </td>
                                        <td class="border border-black/20 px-3 text-center">
                                            @if ($index >= 1)
                                                <button type="button" wire:click='deleteBarang({{ $index }})'
                                                    class="mx-auto flex items-center justify-center rounded-lg bg-red-500 p-2 text-white">
                                                    <i class='bx bx-trash bx-xs'></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mt-5">
                            @if (auth()->user()->role == 'direktur logistik' || auth()->user()->role == 'admin fakturis')
                                <button
                                    class="flex items-center justify-center gap-2 rounded-lg bg-green-500 p-2 capitalize text-white"
                                    wire:click='addBarang' type="button"><i class='bx bx-plus'></i> tambah</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative flex w-[30%] justify-center">
                <div class="mt-10">
                    <div class="flex flex-col gap-8 capitalize">
                        <div class="border border-black bg-white p-2">
                            <label for="faktur">no. faktur</label>
                            <input wire:model='faktur' type="text" id="faktur"
                                class="w-full p-2 focus:outline-0" readonly>
                        </div>
                        <div class="mb-28 border border-black p-2">
                            <label for="tanggal">tanggal</label>
                            <input type="date" id="tanggal" class="w-full p-2 focus:outline-0"
                                wire:model='tanggal'>
                        </div>
                        @if ($errors->has('tanggal'))
                            {{ $errors->first('tanggal') }}
                        @endif
                        <div class="flex justify-between border-b border-black pb-1">
                            <h1>Total :</h1>
                            <p wire:model='total' class="cursor-auto">{{ currency_IDR($total) }},00</p>
                        </div>
                        @if (auth()->user()->role == 'direktur logistik' || auth()->user()->role == 'admin fakturis')
                            <div class="flex justify-center gap-5">
                                <button wire:click='save()'
                                    class="rounded-md bg-green-500 px-3 py-1 capitalize text-white transition-all duration-[.2s] hover:-translate-y-1 hover:shadow-[0_3px_3px_0_rgba(0,0,0,.3)]">buat</button>
                                <button wire:click='resetButton()' type="button"
                                    class="rounded-md bg-red-500 px-3 py-1 capitalize text-white transition-all duration-[.2s] hover:-translate-y-1 hover:shadow-[0_3px_3px_0_rgba(0,0,0,.3)]">reset</button>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
