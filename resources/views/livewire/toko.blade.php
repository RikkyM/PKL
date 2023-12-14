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
    {{-- endFlashMessage --}}

    {{-- modalValidation --}}
    <div x-transition.duration.400ms x-cloak x-show = "show" x-data = "{ show : false }"
        x-on:open-modal.window = "show = true" x-on:close-modal.window = "show = false"
        x-on:keydown.escape.window = "show = false" wire:keydown.escape.window='resetData' class="fixed inset-0 z-50">
        <div x-on:click="show = false" wire:click='resetData'
            class="fixed inset-0 left-0 top-0 -z-50 h-screen w-screen rounded-lg bg-black/60 opacity-40"></div>
        <div class="pointer-events-none fixed inset-0 mx-auto flex max-w-2xl items-center justify-center">
            <form wire:submit
                class="@if ($update == true) h-[580px] @endif pointer-events-auto ml-10 flex w-[400px] flex-col items-center justify-center gap-5 rounded-lg bg-white py-10 text-black">
                @csrf
                @if ($update == true)
                    <h2 class="text-lg font-bold capitalize">ubah toko</h2>
                @else
                    <h2 class="text-lg font-bold capitalize">tambah toko</h2>
                @endif
                <div class="flex w-[300px] flex-col gap-1">
                    <label for="namaToko">nama toko</label>
                    <input wire:model='nama_toko' id="namaToko" autocomplete="off"
                        class="transparent h-7 border border-black/40 pl-2 placeholder:text-sm placeholder:capitalize"
                        type="text" placeholder="masukkan nama toko...">
                    @if ($errors->has('nama_toko'))
                        <div class="text-sm">
                            {{ $errors->first('nama_toko') }}
                        </div>
                    @endif
                </div>
                <div class="flex w-[300px] flex-col gap-1">
                    <label for="kodeToko">kode toko</label>
                    <input wire:model='kode_toko' maxlength="6" minlength="4" id="kodeToko" autocomplete="off"
                        class="h-7 border border-[#A8A2A9] border-black/40 pl-2 placeholder:text-sm placeholder:capitalize"
                        type="text" placeholder="masukkan kode toko...">
                    @if ($errors->has('kode_toko'))
                        <div class="text-sm">{{ $errors->first('kode_toko') }}</div>
                    @endif
                </div>
                <div class="flex w-[300px] flex-col gap-1">
                    <label for="alamatToko">alamat toko</label>
                    <textarea wire:model='alamat_toko'
                        class="h-20 max-h-32 resize-none border border-black/40 bg-transparent pl-2 pt-2 placeholder:text-sm placeholder:capitalize"
                        id="alamatToko" type="text" placeholder="masukkan kode toko..."></textarea>
                    @if ($errors->has('alamat_toko'))
                        <div class="text-sm">{{ $errors->first('alamat_toko') }}</div>
                    @endif
                </div>
                <div class="flex w-[300px] flex-col gap-1">
                    <label for="no_hp">No. HP</label>
                    <input wire:model='no_hp' maxlength="6" minlength="4" id="no_hp" autocomplete="off"
                        class="h-7 border border-[#A8A2A9] border-black/40 pl-2 placeholder:text-sm placeholder:capitalize [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                        type="number" placeholder="masukkan nomor hp...">
                    @if ($errors->has('no_hp'))
                        <div class="text-sm">{{ $errors->first('no_hp') }}</div>
                    @endif
                </div>
                @if ($update == true)
                    <div class="flex w-[300px] flex-col gap-1">
                        <label for="status">status</label>
                        <select class="h-7 border border-[#A8A2A9] bg-transparent capitalize text-black" id="status"
                            wire:model='status'>
                            <option value="" class="text-black">status</option>
                            <option value="Active" class="text-black">active</option>
                            <option value="Inactive" class="text-black">inactive</option>
                        </select>
                        @if ($errors->has('status'))
                            {{ $errors->first('status') }}
                        @endif
                    </div>
                @endif
                <div class="flex gap-5">
                    @if ($update == false)
                        <button wire:click='tambahToko'
                            class="rounded-sm bg-green-500 px-4 py-2 text-sm capitalize text-white focus:outline-0">tambah</button>
                    @else
                        <button wire:click='updateToko'
                            class="rounded-sm bg-green-500 px-4 py-2 text-sm capitalize text-white focus:outline-0">ubah</button>
                    @endif
                    <button x-on:click="$dispatch('close-modal')" wire:click='resetData' type="button"
                        class="rounded-sm bg-red-500 px-4 py-2 text-sm capitalize text-white focus:outline-0">batal</button>
                </div>
            </form>
        </div>
    </div>
    {{-- end modalValidation --}}

    <div x-transition.duration.400ms class="fixed inset-0 z-50" x-cloak x-data="{ del: false }" x-show="del"
        x-on:del-validation.window="del = true" x-on:del-close.window="del = false"
        x-on:keydown.escape.window="del = false" x-on:keydown.escape.window="resetData">
        <div x-on:click="del = false" wire:click='resetData'
            class="fixed inset-0 left-0 top-0 -z-50 h-screen w-screen rounded-lg bg-black/60 opacity-40"></div>
        <div class="pointer-events-none fixed inset-0 mx-auto flex max-w-2xl items-center justify-center">
            <div class="pointer-events-auto flex w-[400px] flex-col gap-5 rounded-lg bg-[#111322] p-6 text-white">
                <h2 class="capitalize text-white">hapus toko ?</h2>
                <p class="text-sm normal-case">Apakah anda yakin ingin menghapus data tersebut ?</p>
                <div class="my-2 flex justify-end gap-3">
                    <a wire:click='delete()' x-on:click='del = false'
                        class="cursor-pointer rounded-sm bg-green-500 px-3 py-1 text-sm capitalize text-white">Ya</a>
                    <a x-on:click="$dispatch('del-close')"
                        class="cursor-pointer rounded-sm bg-red-500 px-3 py-1 text-sm capitalize text-white">Tidak</a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex w-full items-center justify-center">
        <div class="w-[90%]">
            <h2 class="mb-6 mt-7 w-max text-2xl font-semibold capitalize">data toko</h2>
        </div>
    </div>
    <div class="flex w-full items-center justify-center">
        <div class="flex w-[90%] items-center justify-between py-2">
            <div
                class="relative flex w-max items-center gap-2 border-[1px] border-black py-1 pl-2 transition-all delay-[.5s] duration-[.5s]">
                <i class='bx bx-search'></i>
                <input id="search" type="text" class="placeholder:text-sm focus:outline-0"
                    placeholder="Search..." wire:model.live='search' wire:keydown.escape.window='resetSearch'>
            </div>
            @if (auth()->user()->role == 'direktur logistik')
                <button type="button" x-on:click="$dispatch('open-modal')"
                    class="z-10 flex items-center justify-center gap-1 rounded-sm bg-green-400 px-4 py-2 text-sm font-semibold capitalize text-white transition-all duration-[.2s] hover:-translate-y-1 hover:shadow-[0_2px_4px_0_rgba(0,0,0,.6)] focus:outline-0"><i
                        class='bx bx-plus-circle bx-xs'></i> tambah
                    toko</button>
            @endif
        </div>
    </div>

    <div class="relative mt-2 flex h-max w-full flex-col items-center">
        <table class="mb-10 w-[90%] border-collapse text-center capitalize">
            <thead class="bg-[#111322] text-white">
                <tr>
                    <th class="w-14 rounded-tl-lg p-1 py-2 text-center text-sm font-semibold">no.</th>
                    <th class="w-[410px] p-2 py-2 text-left text-sm font-semibold">nama</th>
                    <th class="w-[390px] py-2 text-center text-sm font-semibold capitalize">kode</th>
                    <th class="w-[390px] py-2 pl-[10px] text-left text-sm font-semibold capitalize">alamat</th>
                    <th class="w-[390px] py-2 pl-[10px] text-center text-sm font-semibold capitalize">No. HP</th>
                    <th class="w-[410px] p-1 py-2 text-sm font-semibold @if(auth()->user()->role != 'direktur logistik') rounded-tr-lg @endif">status</th>
                    @if (auth()->user()->role == 'direktur logistik')
                        <th class="w-[410px] rounded-tr-lg p-1 py-2 text-sm font-semibold">action</th>
                    @endif
                </tr>
            </thead>
            <tbody class="relative">
                @foreach ($toko as $key => $value)
                    <tr class="border border-black/20 hover:bg-gray-300">
                        <td class="border border-black/20 p-2 text-center">{{ $toko->firstItem() + $key }}</td>
                        <td class="border border-black/20 p-2 text-left">{{ $value->nama_toko }}</td>
                        <td class="border border-black/20 py-2 text-center">{{ $value->kode_toko }}</td>
                        <td class="border border-black/20 py-2 px-[10px] text-left">{{ $value->alamat_toko }}</td>
                        <td class="border border-black/20 py-2 pl-[10px] text-center">{{nomorHp($value->no_hp) }}</td>
                        @if ($value->status == 'Active')
                            <td class="border-b border-r border-black/20 p-2 py-3"><span
                                    class="rounded-lg bg-green-500 px-6 py-1 text-sm text-white">{{ $value->status }}</span>
                            </td>
                        @else
                            <td class="border-b border-r border-black/20 p-2 py-3"><span
                                    class="rounded-lg bg-red-500 px-4 py-1 text-sm text-white">{{ $value->status }}</span>
                            </td>
                        @endif
                        @if (auth()->user()->role == 'direktur logistik')
                            <td class="py-4">
                                <button type="button" wire:click='edit({{ $value->id }})'
                                    x-on:click="$dispatch('open-modal')"
                                    class="cursor-pointer bg-blue-500 px-3 py-1 text-sm capitalize text-white">edit</button>
                            </td>
                        @endif
                    </tr>
                @endforeach
                <div class="absolute left-0 top-0 flex h-[72vh] w-full items-center justify-center">
                    @if (count($toko) == 0)
                        <span class="capitalize">toko tidak ditemukan</span>
                    @endif
                </div>
            </tbody>
        </table>



    </div>
</div>
