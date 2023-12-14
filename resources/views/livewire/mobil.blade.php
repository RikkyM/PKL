<div class="h-[91.4vh] select-none capitalize">

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

        {{-- fails --}}
        <div x-data="{ open: false }" x-init="() => {
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
                class="absolute right-10 top-5 flex items-center justify-center gap-3 rounded-lg bg-red-500 px-4 py-3 font-bold text-white shadow-[rgba(0,_0,_0,_0.25)_0px_25px_50px_-12px]">
                <i class='bx bx-trash bx-sm'></i>
                <span class="capitalize">{{ $message }}</span>
            </div>
        </div>
    </div>
    {{-- endflashMessage --}}

    {{-- modal --}}
    <div x-transition.duration.400ms x-cloak x-show = "show" x-data = "{ show : false }"
        x-on:open-modal.window = "show = true" x-on:close-modal.window = "show = false"
        x-on:keydown.escape.window = "show = false" wire:keydown.escape.window='resetData' class="fixed inset-0 z-50">

        <div x-on:click="show = false" wire:click='resetData'
            class="fixed inset-0 left-0 top-0 -z-50 h-screen w-screen rounded-lg bg-black/60 opacity-40"></div>
        <div class="pointer-events-none fixed inset-0 mx-auto flex max-w-2xl items-center justify-center">
            <form @if ($update == true) wire:submit='updateMobil' @else wire:submit='tambahMobil' @endif
                class="pointer-events-auto ml-10 flex w-[400px] flex-col items-center justify-center gap-5 rounded-lg bg-white py-10 text-black">
                @csrf
                @if ($update == true)
                    <h2 class="text-lg font-bold capitalize">edit data mobil</h2>
                @else
                    <h2 class="text-lg font-bold capitalize">tambah data mobil</h2>
                @endif
                <div class="flex w-[300px] flex-col gap-1">
                    <label for="nama">nama mobil</label>
                    <input type="text" id="nama" wire:model='nama' autocomplete="off"
                        class="h-7 border border-black/40 bg-transparent pl-2 placeholder:text-sm placeholder:capitalize">
                    @if ($errors->has('nama'))
                        <div class="text-sm">{{ $errors->first('nama') }}</div>
                    @endif
                </div>
                <div class="flex w-[300px] flex-col gap-1">
                    <label for="plat">no. polisi</label>
                    <input type="text" id="plat" wire:model='plat'
                        class="h-7 border border-black/40 bg-transparent pl-2 placeholder:text-sm placeholder:capitalize">
                    @if ($errors->has('plat'))
                        <div class="text-sm">{{ $errors->first('plat') }}</div>
                    @endif
                </div>
                <div>
                    @if ($update == true)
                        <button
                            class="rounded-sm bg-green-500 px-4 py-2 text-sm capitalize text-white focus:outline-0">ubah</button>
                    @else
                        <button
                            class="rounded-sm bg-green-500 px-4 py-2 text-sm capitalize text-white focus:outline-0">tambah</button>
                    @endif
                    <button type="button" x-on:click='$dispatch("close-modal")' wire:click='resetData'
                        class="rounded-sm bg-red-500 px-4 py-2 text-sm capitalize text-white focus:outline-0">
                        batal
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- endmodal --}}

    <div class="flex w-full items-center justify-center">
        <div class="w-[90%]">
            <h2 class="mb-6 mt-7 w-max text-2xl font-semibold">data mobil</h2>
        </div>
    </div>
    <div class="flex w-full items-center justify-center">
        <div class="flex w-[90%] items-center justify-between py-2">
            <div class="relative flex items-center gap-2 border-[1px] border-black py-1 pl-2">
                <i class="bx bx-search"></i>
                <input type="text" id="search" class="placeholder:text-sm focus:outline-0" placeholder="Search..."
                    wire:model.live='search' wire:keydown.escape.window='resetSearch'>
            </div>
            <div class="flex gap-5 text-xs font-semibold">
                @if (auth()->user()->role == 'direktur logistik')
                    <button x-on:click="$dispatch('open-modal')"
                        class="z-10 flex items-center justify-center gap-1 rounded-sm bg-green-400 px-4 py-2 text-sm capitalize text-white transition-all duration-[.2s] hover:-translate-y-1 hover:shadow-[0_2px_4px_0_rgba(0,0,0,.6)] focus:outline-0"><i
                            class='bx bx-plus-circle bx-xs'></i> tambah
                        mobil</button>
                @endif
            </div>
        </div>
    </div>

    <div class="relative mt-2 flex h-max w-full flex-col items-center">
        <table class="mb-10 w-[90%] border-collapse text-center capitalize">
            <thead class="bg-[#111322] text-white">
                <tr>
                    <th class="w-10 rounded-tl-lg p-1 py-2 text-center text-sm font-semibold">no.</th>
                    <th class="px-2 text-left text-sm">mobil</th>
                    <th class="@if (auth()->user()->role != 'direktur logistik') rounded-tr-lg @endif text-center text-sm">no. polisi
                    </th>
                    @if (auth()->user()->role == 'direktur logistik')
                        <th class="rounded-tr-lg text-center text-sm">action</th>
                    @endif
                </tr>
            </thead>
            <tbody class="relative">
                @foreach ($data as $mobil => $value)
                    <tr class="border border-black/20 hover:bg-gray-300">
                        <td class="border border-black/20 px-2 py-3 text-center">{{ $data->firstItem() + $mobil }}</td>
                        <td class="border border-black/20 px-2 py-3 text-left">{{ $value->nama }}</td>
                        <td class="border border-black/20 px-2 py-3 text-center">{{ $value->plat }}</td>
                        @if (auth()->user()->role == 'direktur logistik')
                            <td class="border border-black/20 px-2 py-3 text-center">
                                <button type="button" class="bg-blue-500 px-3 py-1 text-sm capitalize text-white"
                                    x-on:click='$dispatch("open-modal")' wire:click='edit({{ $value->id }})'>
                                    edit
                                </button>
                            </td>
                        @endif
                    </tr>
                @endforeach
                <div class="absolute left-0 top-0 flex h-[72vh] w-full items-center justify-center">
                    @if (count($data) == 0)
                        <span>Mobil Tidak Ditemukan</span>
                    @endif
                </div>
            </tbody>
        </table>
    </div>
</div>
