<div class="select-none">

    {{-- flashMessage --}}
    <div>
        {{-- success --}}
        <div x-data="{ open: false }" x-init="() => {
            Livewire.on('success', () => {
                open = true;
                setTimeout(() => {
                    open = false;
                }, 3000)
            })
        }">
            <div x-cloak x-show="open" x-transition:enter="transition duration-[.5s]" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-[.5s]"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="absolute right-10 top-5 flex items-center justify-center gap-3 rounded-lg bg-green-400 px-4 py-3 font-bold text-white shadow-[rgba(0,_0,_0,_0.25)_0px_25px_50px_-12px]">
                <i class='bx bx-check bx-sm'></i>
                <span class="capitalize">{{ $message }}</span>
            </div>
        </div>

        {{-- error --}}
        <div x-cloak x-data="{ open: false }" x-init="() => {
            Livewire.on('error', () => {
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
                class="absolute right-10 top-5 flex items-center justify-center gap-3 rounded-lg bg-red-400 px-4 py-3 font-bold text-white shadow-[rgba(0,_0,_0,_0.25)_0px_25px_50px_-12px]">
                <i class='bx bx-check bx-sm'></i>
                <span class="capitalize">{{ $message }}</span>
            </div>
        </div>
    </div>
    {{-- endFlashMessage --}}

    <div class="flex w-full items-center justify-center">
        <div class="w-[90%]">
            <h2 class="mb-6 mt-7 w-max text-2xl font-semibold capitalize">Stok Barang</h2>
        </div>
    </div>
    <div class="flex w-full items-center justify-center">
        <div class="flex w-[90%] items-center justify-between py-2">
            <div class="relative flex items-center gap-2 border-[1px] border-black py-1 pl-2">
                <i class='bx bx-search'></i>
                <input id="search" type="text" class="placeholder:text-sm focus:outline-0" placeholder="Search..."
                    wire:model.live='search' wire:keydown.escape.window='resetSearch'>
            </div>
            {{ $table->links() }}
            <div class="flex gap-5 text-xs font-semibold text-white">
                @if (auth()->user()->role == 'direktur logistik')
                    <button x-on:click="$dispatch('open-modal')"
                        class="z-10 flex items-center justify-center gap-1 rounded-sm bg-green-400 px-4 py-2 text-sm font-semibold capitalize text-white transition-all duration-[.2s] hover:-translate-y-1 hover:shadow-[0_2px_4px_0_rgba(0,0,0,.6)] focus:outline-0"><i
                            class='bx bx-plus-circle bx-xs'></i> Tambah
                        Stok
                        Barang</button>
                @endif
            </div>

            {{-- modal --}}
            <div x-transition.duration.400ms x-cloak x-show="show" x-data="{ show: false }"
                x-on:open-modal.window="show = true" x-on:close-modal.window="show = false"
                wire:keydown.escape.window='resetData' x-on:keydown.escape.window="show = false"
                class="fixed left-0 top-0 z-10 h-screen w-screen">
                <div x-on:click="show = false" wire:click='resetData'
                    class="fixed inset-0 left-0 top-0 -z-50 h-screen w-screen rounded-lg bg-black/60 opacity-40"></div>
                <div class="pointer-events-none fixed inset-0 mx-auto flex max-w-2xl items-center justify-center">
                    <form wire:submit='tambahBarang'
                        class="pointer-events-auto flex h-max w-max flex-col items-center justify-center gap-1 rounded-lg bg-white p-10 text-black">
                        @csrf
                        <h2 class="text-lg font-bold capitalize">tambah barang</h2>
                        <div class="mt-5 flex w-[300px] flex-col gap-1 px-5">
                            <label for="brg" class="text-sm">Nama Barang</label>
                            <select wire:model='nama_barang' id="brg"
                                class="rounded-sm border-2 border-[#A8A2A9] bg-transparent py-[6px] pl-2 text-sm text-black placeholder:text-xs focus:outline-0">
                                <option value="" selected>Pilih Barang</option>
                                @foreach ($dropdown as $item)
                                    <option value="{{ $item->id }}" class="text-black">{{ $item->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('nama_barang'))
                                <div class="text-sm">{{ $errors->first('nama_barang') }}</div>
                            @endif
                        </div>
                        <div class="flex w-[300px] flex-col gap-1 px-5 py-2">
                            <label for="jmlhBrg" class="mb-[.3rem] text-sm">Jumlah</label>
                            <input id="jmlhBrg" type="number" wire:model='stock' autocomplete="off"
                                class="rounded-sm border-2 border-[#A8A2A9] bg-transparent py-[6px] pl-2 text-sm [appearance:textfield] placeholder:text-xs placeholder:capitalize focus:outline-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                placeholder="masukkan jumlah barang">
                            @if ($errors->has('stock'))
                                <div class="text-sm">{{ $errors->first('stock') }}</div>
                            @endif
                        </div>
                        <div class="mt-5 flex gap-5">
                            <button wire:click='tambahBarang'
                                class="rounded-sm bg-green-500 px-4 py-2 text-sm capitalize text-white focus:outline-0">tambah</button>
                            <button type="button" x-on:click="$dispatch('close-modal')" wire:click='resetData()'
                                class="rounded-sm bg-red-500 px-4 py-2 text-sm capitalize text-white focus:outline-0">batal</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- endmodal --}}
        </div>
    </div>

    <div class="relative mt-2 flex h-max w-full flex-col items-center">
        <div class="flex w-[90%] items-center justify-center">
            <table class="w-full border-collapse text-center capitalize">

                <thead class="bg-[#111322] text-white">
                    <tr>
                        <th class="w-5 rounded-tl-lg p-1 py-2 text-center text-sm font-semibold">no.</th>
                        <th class="w-[210px] p-1 py-2 text-left text-sm font-semibold">nama</th>
                        <th class="w-[90px] py-2 text-center text-sm font-semibold capitalize">kode</th>
                        <th class="w-[210px] p-1 py-2 text-sm font-semibold">harga</th>
                        <th class="w-[70px] rounded-tr-lg p-1 py-2 text-sm font-semibold">jumlah</th>
                    </tr>
                </thead>
                <tbody class="relative">
                    @foreach ($table as $key => $value)
                        <tr class="hover:bg-gray-300">
                            <td class="border border-black/20 p-2 py-4 text-center">{{ $table->firstItem() + $key }}
                            </td>
                            <td class="border-b border-r border-black/20 p-2 text-left">{{ $value->nama_barang }}</td>
                            <td class="border-b border-r border-black/20 py-2 text-center">{{ $value->kode_barang }}
                            </td>
                            <td class="border-b border-r border-black/20 p-2">Rp.
                                {{ number_format($value->harga_barang, 0, ',', '.') }}</td>
                            <td class="border border-black/20 p-2">{{ $value->stock }}</td>
                        </tr>
                    @endforeach
                    @if (count($table) == 0)
                        <div class="absolute left-0 top-0 mt-64 flex h-full w-full items-center justify-center">
                            <span>Barang Tidak Ditemukan</span>
                        </div>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
