<div class="select-none antialiased">

    <livewire:dashboard-header/>

    <div class="mt-7 flex w-full justify-evenly">
        <div class="flex w-[95%] justify-between">
            <livewire:dashboard-faktur />
            <div class="w-[30%]">
                <div
                    class="flex flex-col justify-between rounded-md shadow-[rgba(6,_24,_44,_0.4)_0px_0px_0px_2px,_rgba(6,_24,_44,_0.65)_0px_4px_6px_-1px,_rgba(255,_255,_255,_0.08)_0px_1px_0px_inset]">
                    <div>
                        <div class="my-2">
                            <div class="flex items-center justify-center gap-5 py-3 text-lg font-semibold">
                                <i class='bx bx-chevron-left cursor-pointer px-1 text-2xl font-semibold'
                                    id="prev"></i>
                                <div id="bulan"></div>
                                <i class="bx bx-chevron-right cursor-pointer px-1 text-2xl font-semibold"
                                    id="next"></i>
                            </div>
                        </div>
                        <div class="mb-3 grid grid-cols-7 gap-5 px-2 text-center font-semibold text-black">
                            <div>Min</div>
                            <div>Sen</div>
                            <div>Sel</div>
                            <div>Rab</div>
                            <div>Kam</div>
                            <div>Jum</div>
                            <div>Sab</div>
                        </div>
                        <div id="hari" class="grid grid-cols-7 gap-5 px-2 text-center">
                        </div>
                    </div>
                    <div class="mx-5 my-3 flex items-center justify-end gap-2 text-xl capitalize">
                        <h3 class="cursor-pointer rounded-md bg-green-500 px-4 py-2 text-xs font-semibold text-white"
                            id="today">today</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/Script/fullCalendar.js') }}"></script>
</div>
