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

    <div class="flex w-full items-center justify-center">
        <div class="w-[90%]">
            <h2 class="mb-6 mt-7 w-max text-2xl font-semibold">data sopir</h2>
        </div>
    </div>
    <div class="flex w-full items-center justify-center">
        <div class="flex w-[90%] items-center justify-between py-2">
            <div class="relative flex items-center gap-2 border-[1px] border-black py-1 pl-2">
                <i class='bx bx-search'></i>
                <input id="search" type="text" class="placeholder:text-sm focus:outline-0" placeholder="Search..."
                    wire:model.live='search' wire:keydown.escape.window='resetSearch'>
            </div>
            <div class="flex gap-5 text-xs font-semibold">
                @if (auth()->user()->role == 'direktur logistik')
                    <button x-on:click="$dispatch('open-modal')"
                        class="z-10 flex items-center justify-center gap-1 rounded-sm bg-green-400 px-4 py-2 text-sm capitalize text-white transition-all duration-[.2s] hover:-translate-y-1 hover:shadow-[0_2px_4px_0_rgba(0,0,0,.6)] focus:outline-0"><i
                            class='bx bx-plus-circle bx-xs'></i> tambah
                        sopir</button>
                @endif
            </div>
        </div>
    </div>

    <div x-transition.duration.400ms x-cloak x-show = "show" x-data = "{ show : false }"
        x-on:open-modal.window = "show = true" x-on:close-modal.window = "show = false"
        x-on:keydown.escape.window = "show = false" wire:keydown.escape.window='resetData' class="fixed inset-0 z-50">

        <div x-on:click="show = false" wire:click='resetData'
            class="fixed inset-0 left-0 top-0 -z-50 h-screen w-screen rounded-lg bg-black/60 opacity-40"></div>
        <div class="pointer-events-none fixed inset-0 mx-auto flex max-w-2xl items-center justify-center">
            <form @if ($update == true) wire:submit='updateSopir' @else wire:submit='tambahSopir' @endif
                class="pointer-events-auto ml-10 flex w-[400px] flex-col items-center justify-center gap-5 rounded-lg bg-white py-10 text-black">
                @csrf
                @if ($update == true)
                    <h2 class="text-lg font-bold capitalize">edit data sopir</h2>
                @else
                    <h2 class="text-lg font-bold capitalize">tambah sopir</h2>
                @endif
                <div class="flex w-[300px] flex-col gap-1">
                    <label for="nama" class="text-sm">nama</label>
                    <input autocomplete="off" type="text" id="nama" wire:model='name'
                        placeholder="masukkan nama..."
                        class="h-7 border border-black/40 bg-transparent pl-2 placeholder:text-sm placeholder:capitalize">
                    @if ($errors->has('name'))
                        <div class="text-sm">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="flex w-[300px] flex-col gap-1">
                    <label for="username" class="text-sm">username</label>
                    <input autocomplete="off" type="text" id="username" wire:model='username'
                        placeholder="masukkan username..."
                        class="h-7 border border-black/40 bg-transparent pl-2 placeholder:text-sm placeholder:capitalize"
                        autocomplete="off">
                    @if ($errors->has('username'))
                        <div class="text-sm">{{ $errors->first('username') }}</div>
                    @endif
                </div>
                @if ($update == true)
                    <div class="flex w-[300px] flex-col gap-1">
                        <label for="status" class="text-sm">status</label>
                        <select wire:model='status' class="h-7 border border-black/40 bg-transparent capitalize"
                            id="status">
                            <option value="">pilih status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        @if ($errors->has('status'))
                            <div class="text-sm">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                @else
                    <div class="flex w-[300px] flex-col gap-1">
                        <label for="password" class="text-sm">password</label>
                        <input autocomplete="off" type="password" id="password" wire:model='password'
                            placeholder="masukkan password..."
                            class="h-7 border border-black/40 bg-transparent pl-2 capitalize placeholder:text-sm placeholder:capitalize">
                        @if ($errors->has('password'))
                            <div class="text-sm">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                @endif
                <div>
                    @if ($update == false)
                        <button
                            class="rounded-sm bg-green-500 px-4 py-2 text-sm capitalize text-white focus:outline-0">tambah</button>
                    @else
                        <button
                            class="rounded-sm bg-green-500 px-4 py-2 text-sm capitalize text-white focus:outline-0">ubah</button>
                    @endif
                    <button type="button" x-on:click='$dispatch("close-modal")' wire:click='resetData'
                        class="rounded-sm bg-red-500 px-4 py-2 text-sm capitalize text-white focus:outline-0">batal</button>
                </div>
            </form>
        </div>
    </div>

    {{-- <div x-transition.duration.400ms class="fixed z-50 inset-0" x-cloak x-data="{ del: false }" x-show="del"
        x-on:del-validation.window="del = true" x-on:del-close.window="del = false"
        x-on:keydown.escape.window="del = false" x-on:keydown.escape.window="resetData">
        <div x-on:click="del = false" wire:click='resetData'
            class="-z-50 fixed bg-black/60 top-0 left-0 w-screen h-screen rounded-lg inset-0 opacity-40"></div>
        <div class="fixed pointer-events-none inset-0 max-w-2xl mx-auto flex items-center justify-center">
            <div
                class="bg-[#111322] pointer-events-auto text-white w-[400px] rounded-lg flex flex-col gap-5 p-6">
                <h2 class="text-white capitalize">hapus user ?</h2>
                <p class="normal-case text-sm">Apakah anda yakin ingin menghapus data tersebut ?</p>
                <div class="flex gap-3 justify-end my-2">
                    <a wire:click='deleteSopir()' x-on:click='$dispatch("del-close")'
                        class="capitalize bg-green-500 py-1 px-3 text-white text-sm cursor-pointer rounded-sm">Ya</a>
                    <a x-on:click="$dispatch('del-close')"
                        class="capitalize bg-red-500 py-1 px-3 text-white text-sm cursor-pointer rounded-sm">Tidak</a>
                </div>
            </div>
        </div>
    </div> --}}

    <div x-transition.duration.400ms class="fixed inset-0 z-50" x-cloak x-data="{ reset: false }" x-show="reset"
        x-on:reset-validation.window="reset = true" x-on:reset-close.window="reset = false"
        x-on:keydown.escape.window="reset = false" x-on:keydown.escape.window="resetData">
        <div x-on:click="reset = false" wire:click='resetData'
            class="fixed inset-0 left-0 top-0 -z-50 h-screen w-screen rounded-lg bg-black/60 opacity-40"></div>
        <div class="pointer-events-none fixed inset-0 mx-auto flex max-w-2xl items-center justify-center">

            <form wire:submit
                class="pointer-events-auto ml-10 flex h-[350px] w-[400px] flex-col items-center justify-center gap-5 rounded-lg bg-white py-10 text-black">
                @csrf
                <h2 class="text-lg font-bold capitalize">Reset Password</h2>
                <div class="flex w-[300px] flex-col gap-1">
                    <label for="newPassword" class="text-sm">password baru</label>
                    <input id="newPassword" type="password" wire:model='password'
                        class="h-7 border border-black/40 bg-transparent pl-2 capitalize placeholder:text-sm placeholder:capitalize">
                    @if ($errors->has('password'))
                        <div class="text-sm">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="flex w-[300px] flex-col gap-1">
                    <label for="password_confirmation" class="text-sm">konfirmasi password</label>
                    <input autocomplete="off" id="password_confirmation" type="password"
                        wire:model='password_confirmation'
                        class="h-7 border border-black/40 bg-transparent pl-2 capitalize placeholder:text-sm placeholder:capitalize">
                    @if ($errors->has('password_confirmation'))
                        <div class="text-sm">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>
                <div class="mt-2 flex gap-1">
                    <button class="rounded-sm bg-green-500 px-4 py-2 text-sm capitalize text-white focus:outline-0"
                        wire:click='updatePassword'>reset</button>
                    <button type="button"
                        class="rounded-sm bg-red-500 px-4 py-2 text-sm capitalize text-white focus:outline-0"
                        x-on:click='$dispatch("reset-close")' wire:click='resetData'>batal</button>
                </div>
            </form>
        </div>
    </div>

    <div class="relative mt-2 flex h-max w-full flex-col items-center">
        <table class="mb-10 w-[90%] border-collapse text-center capitalize">

            <thead class="bg-[#111322] text-white">
                <tr>
                    <th class="w-10 rounded-tl-lg p-1 py-2 text-center text-sm font-semibold">no.</th>
                    <th class="w-[210px] py-2 pl-[10px] text-left text-sm font-semibold">nama</th>
                    <th class="w-[210px] py-2 pl-[10px] text-left text-sm font-semibold">username</th>
                    @if (auth()->user()->role != 'direktur logistik')
                        <th class="w-[290px] rounded-tr-lg py-2 text-center text-sm font-semibold capitalize">status
                        </th>
                    @else
                        <th class="w-[290px] py-2 text-center text-sm font-semibold capitalize">status</th>
                    @endif
                    @if (auth()->user()->role == 'direktur logistik')
                        <th class="w-[410px] rounded-tr-lg py-2 text-sm font-semibold">action</th>
                    @endif
                </tr>
            </thead>
            <tbody class="relative">
                @foreach ($table as $key => $value)
                    <tr class="border border-black/20 hover:bg-gray-300">
                        <td class="border border-black/20 px-2 py-3 text-center">{{ $table->firstItem() + $key }}</td>
                        <td class="border border-black/20 py-3 pl-[10px] text-left">{{ $value->name }}</td>
                        <td class="border border-black/20 py-3 pl-[10px] text-left">{{ $value->username }}
                        </td>
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
                                <button type="button" x-on:click="$dispatch('open-modal')"
                                    class="bg-blue-500 px-3 py-1 text-sm capitalize text-white"
                                    wire:click='edit({{ $value->id }})'>edit</button>

                                <button x-on:click="$dispatch('reset-validation')"
                                    wire:click='rst({{ $value->id }})' type="button"
                                    class="bg-red-700 px-3 py-1 text-sm capitalize text-white">reset</button>
                            </td>
                        @endif
                    </tr>
                @endforeach
                <div class="absolute left-0 top-0 flex h-[72vh] w-full items-center justify-center">
                    @if (count($table) == 0)
                        <span>Sopir Tidak Ditemukan</span>
                    @endif
                </div>
            </tbody>
        </table>

    </div>
</div>
