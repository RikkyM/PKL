<div class="h-[91.4vh] select-none" wire:poll.1s>
    <div class="flex justify-center">
        <div class="w-[90%]">
            <h2 class="mt-10 w-max text-2xl font-semibold capitalize">buat retur barang kembali</h2>
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

    <div class="flex justify-center capitalize">
        <form wire:submit
            class="flex w-[90%] justify-between rounded-md border border-black/50 bg-white px-5 py-4 shadow-[5px_5px_3px_0_rgba(0,0,0,.3)]">
            @csrf
            <div class="w-[70%] p-2">
                <div class="flex flex-col gap-3">
                    <div class="flex">
                        <div class="flex w-[50%] flex-col p-3">
                            <label for="faktur" class="font-semibold text-black/[47%]">No. Faktur</label>
                            <select wire:model.live='faktur' id="faktur"
                                class="rounded-md border border-[#111322] px-2 py-1 focus:outline-[#111322]">
                                <option value="">Pilih Faktur</option>
                                @foreach ($getFaktur as $invoice)
                                    <option value="{{ $invoice->id }}">{{ $invoice->no_faktur }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('faktur'))
                                {{ $errors->first('faktur') }}
                            @endif
                        </div>
                        <div class="flex w-[50%] justify-end bg-white p-3">
                            <a href="{{ route('list-retur') }}" wire:navigate
                                class="mt-5 flex max-h-9 items-center justify-center gap-3 rounded-lg bg-blue-500 px-3 py-2 text-sm text-white">
                                <i class='bx bx-loader bx-xs'></i>
                                <span>List Retur</span>
                            </a>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex w-[50%] flex-col bg-white p-3">
                            <label for="toko" class="font-semibold text-black/[47%]">toko</label>
                            <select id="toko" wire:model='toko' disabled
                                class="appearance-none rounded-md border border-[#111322] px-2 py-1 focus:outline-[#111322] disabled:opacity-100 disabled:opacity-100">
                                <option value=""></option>
                                @foreach ($getToko as $shop)
                                    <option value="{{ $shop->id }}">{{ $shop->nama_toko }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('toko'))
                                {{ $errors->first('toko') }}
                            @endif
                        </div>
                        <div class="flex w-[50%] flex-col p-3">
                            <label for="kembali" class="font-semibold text-black/[47%]">Alasan Retur</label>
                            <input type="text" id="kembali" wire:model='kembali'
                                class="rounded-md border border-[#111322] px-2 py-1 focus:outline-[#111322] disabled:opacity-100"
                                disabled>
                            @if ($errors->has('kembali'))
                                {{ $errors->first('kembali') }}
                            @endif
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex w-full flex-col bg-white p-3">
                            <label for="note" class="font-semibold text-black/[47%]">Note</label>
                            <input id="note" type="text" wire:model='note' readonly
                                class="rounded-md border border-[#111322] p-2 focus:outline-[#111322]">
                            @if ($errors->has('note'))
                                {{ $errors->first('note') }}
                            @endif
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex w-full flex-col p-3">
                            <h2 class="font-semibold text-black/[47%]">detail barang</h2>
                            <table class="border-collapse bg-white">
                                <thead>
                                    <tr class="bg-[#111322] text-sm text-white">
                                        <th class="w-[38px] rounded-tl-md py-2 text-center font-semibold">No</th>
                                        <th class="w-80 pl-3 text-left font-semibold">Barang</th>
                                        <th class="w-24 text-center font-semibold">Qty</th>
                                        <th class="w-44 rounded-tr-md text-center font-semibold">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderItems as $index => $orderItem)
                                        <tr wire:key='orderItems.{{ $index }}'>
                                            <td class="border border-black/20 py-4 text-center">{{ $loop->iteration }}
                                            </td>
                                            <td class="border border-black/20 px-3">
                                                <select id="barang"
                                                    class="w-full appearance-none capitalize disabled:opacity-100"
                                                    disabled wire:model.live='orderItems.{{ $index }}.barang'>
                                                    <option value="">pilih barang</option>
                                                    @foreach ($getBarang as $item)
                                                        <option value="{{ $item->id_barang }}">
                                                            {{ $item->nama_barang }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td class="border border-black/20 text-center">
                                                <input type="number" id="qty" step="1" min="1"
                                                    readonly pattern="\d+"
                                                    wire:model.live='orderItems.{{ $index }}.qty'
                                                    class="w-24 select-none text-center [appearance:textfield] focus:outline-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                                            </td>
                                            <td class="border border-black/20 text-center">
                                                <input type="text" id="harga"
                                                    wire:model='orderItems.{{ $index }}.harga'
                                                    class="cursor-auto text-center focus:outline-0" readonly>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="flex w-[30%] justify-center p-3">
                <div class="mt-10">
                    <div class="flex flex-col gap-8">
                        <div class="border border-black bg-white p-2">
                            <label for="retur">No. Retur</label>
                            <input wire:model='retur' type="text" id="retur"
                                class="w-full p-2 focus:outline-0" readonly>
                        </div>
                        <div class="mb-28 flex flex-col border border-black bg-white p-2">
                            <label for="tanggal">tanggal</label>
                            <input wire:model='tanggal' type="date" id="tanggal"
                                class="w-full p-2 focus:outline-0">
                        </div>
                        <div class="flex justify-between border-b border-black pb-1">
                            <h1>Total :</h1>
                            <p wire:model='total' class="cursor-auto">{{ currency_IDR($total) }},00</p>
                        </div>
                        @if (auth()->user()->role == 'direktur logistik' || auth()->user()->role == 'admin logistik')
                            <div class="flex justify-center gap-5">
                                <button wire:click='save'
                                    class="rounded-md bg-green-500 px-3 py-1 capitalize text-white transition-all duration-[.2s] hover:-translate-y-1 hover:shadow-[0_3px_3px_0_rgba(0,0,0,.3)]">buat</button>
                                <button wire:click='resetButton' type="button"
                                    class="rounded-md bg-red-500 px-3 py-1 capitalize text-white transition-all duration-[.2s] hover:-translate-y-1 hover:shadow-[0_3px_3px_0_rgba(0,0,0,.3)]">reset</button>
                            </div>
                        @endif
                    </div>
                </div>
        </form>
    </div>

</div>
