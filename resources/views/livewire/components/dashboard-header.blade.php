<div class="mt-10 flex w-full justify-center" wire:poll.1s>
{{-- <div class="mt-10 flex w-full justify-center"> --}}
    <div class="flex w-[95%] justify-center gap-5">
        <div
            class="flex w-[50%] items-center justify-start gap-4 rounded-xl bg-blue-500 px-5 py-8 text-white transition duration-[.5s] hover:bg-blue-500/80">
            <div class="rounded-xl bg-white/20 p-2">
                <i class='bx bxs-truck text-5xl'></i>
            </div>
            <div class="flex flex-col gap-2">
                <span class="text-xl font-semibold">{{ $item }}</span>
                <span class="text-[16px] font-normal capitalize">total item terjual</span>
            </div>
        </div>
        <div
            class="flex w-[50%] items-center justify-start gap-4 rounded-xl bg-green-400 px-5 py-8 text-white transition duration-[.5s] hover:bg-green-400/80">
            <div class="rounded-xl bg-white/20 p-2">
                <i class='bx bx-shopping-bag text-5xl'></i>
            </div>
            <div class="flex flex-col gap-2">
                <span class="text-xl font-semibold">{{ $invoice }}</span>
                <span class="text-[16px] font-normal capitalize">total transaksi</span>
            </div>
        </div>
        <div
            class="flex w-[50%] items-center justify-start gap-4 rounded-xl bg-[#FF993A] px-5 py-8 text-white transition duration-[.5s] hover:bg-[#FF993A]/80">
            <div class="rounded-xl bg-white/20 p-2">
                <i class='bx bx-money text-5xl'></i>
            </div>
            <div class="flex flex-col gap-2">
                <span class="text-xl font-semibold">{{ currency_IDR($income) }},00</span>
                <span class="text-[16px] font-normal capitalize">total income</span>
            </div>
        </div>
        <div
            class="flex w-[50%] items-center justify-start gap-4 rounded-xl bg-[#F6C631] px-5 py-8 text-white transition duration-[.5s] hover:bg-[#F6C631]/80">
            <div class="rounded-xl bg-white/20 p-2">
                <i class='bx bxs-group text-5xl'></i>
            </div>
            <div class="flex flex-col gap-2">
                <span class="text-xl font-semibold">{{ $toko }}</span>
                <span class="text-[16px] font-normal capitalize">total pelanggan aktif</span>
            </div>
        </div>
    </div>
</div>
