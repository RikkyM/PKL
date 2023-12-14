@extends('components.app')
@section('title')
    Print Retur
@endsection
@section('pages')
    <style>
        @media print {

            #printBtn,
            #back-button,
            #printContainer,
            #backContainer {
                display: none;
            }
        }
    </style>

    {{-- <div id="backContainer" class="mb-12 mt-14 flex justify-center">
        <div class="flex w-[90%] justify-start">
            <a id="back-button" href="{{ url('list-retur') }}" class="flex items-center justify-center gap-1"><i
                    class='bx bx-left-arrow-alt bx-xs sm:bx-md'></i> <span
                    class="text-xs font-semibold capitalize sm:text-[16px]">back</span></a>
        </div>
    </div> --}}

    <div id="printContainer" class="my-4 flex justify-center">
        <div class="w-[90%]">
            <button type="button" id="printBtnRetur"
                class="flex items-center justify-center gap-2 rounded-md bg-[#F9B572] px-3 py-1 text-xs text-white sm:gap-3 sm:px-5 sm:py-2 sm:text-[16px]"><i
                    class='bx bx-printer'></i>Print</button>
        </div>
    </div>

    <div id="retur">
        <div class="flex justify-center">
            <div class="flex w-[90%] justify-between">
                <div class="flex flex-col items-start sm:gap-1">
                    <span class="text-[8px] sm:text-[16px]">PT. BINTANG SURYASINDO</span>
                    <span class="text-[8px] sm:text-[16px]">Jl. Residen Abdul Rozak No.99 E/503</span>
                    <span class="text-[8px] sm:text-[16px]">0711-710481</span>
                    @foreach ($retur as $cn)
                        <span class="text-[8px] sm:text-[16px]">Tanggal :
                            {{ date('d-M-Y', strtotime($cn->tanggal)) }}</span>
                        <span class="text-[8px] capitalize sm:text-[16px]">Alasan Retur : {{ $cn->alasan_retur }}</span>
                    @endforeach
                </div>

                <div class="flex flex-col items-end sm:gap-1">
                    <span class="text-right text-[8px] sm:text-[16px]">{{ date('d/m/Y', strtotime($cn->tanggal)) }}</span>
                    <span class="text-right text-[8px] sm:text-[16px]">RETUR PENJUALAN {{ $cn->no_retur }}</span>
                    <span class="text-right text-[8px] sm:text-[16px]">Toko :
                        @foreach ($retur as $cn)
                            {{ $cn->kode_tk }}
                            {{ $cn->nama }}
                        @endforeach
                    </span>
                    <span class="text-right text-[8px] sm:text-[16px]">Alamat : {{ $cn->alamat }}</span>
                </div>
            </div>
        </div>
        <div class="mt-10 flex items-center justify-center">
            <div class="w-[90%]">
                <table class="w-full border-collapse border-b border-black/40 text-sm">
                    <thead>
                        <tr>
                            <th class="border-b border-black text-left text-[8px] font-normal sm:text-[16px]">No. Barang
                            </th>
                            <th class="border-b border-black text-left text-[8px] font-normal sm:text-[16px]">Barang</th>
                            <th class="border-b border-black text-right text-[8px] font-normal sm:text-[16px]">Qty</th>
                            <th class="border-b border-black text-right text-[8px] font-normal sm:text-[16px]">Harga</th>
                            <th class="border-b border-black text-right text-[8px] font-normal sm:text-[16px]">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="py-1 text-left text-[8px] sm:text-[16px]">{{ $item->kode_brg }}</td>
                                <td class="py-1 text-left text-[8px] sm:text-[16px]">{{ $item->barang }}</td>
                                <td class="py-1 text-right text-[8px] sm:text-[16px]">{{ $item->qty }}</td>
                                <td class="py-1 text-right text-[8px] sm:text-[16px]">{{ currency_IDR($item->harga) }}</td>
                                <td class="py-1 text-right text-[8px] sm:text-[16px]">
                                    {{ currency_IDR($item->qty * $item->harga) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-7 flex justify-center">
            <div class="flex w-[90%] justify-between">
                <div class="flex flex-col">
                    <span class="text-[8px] sm:text-[16px]">Catatan</span>
                    <span class="text-[8px] sm:text-[16px]">{{ $cn->note }}</span>
                </div>

                <div class="flex w-[35%] flex-col items-end gap-6">
                    <table class="border-collapse">
                        <tr>
                            <td class="w-16 text-[8px] sm:w-32 sm:text-[16px]">Total</td>
                            <td class="text-[8px] sm:text-[16px]">{{ currency_IDR($cn->total) }}</td>
                        </tr>
                    </table>
                    {{-- <div class="w-full">
                        <div class="ml-3 flex flex-col items-start text-center">
                            <span class="-mb-2 text-base uppercase">hormat kami</span>
                            <span class="ml-[2px] text-sm capitalize">Derry Maxcevy</span>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="flex w-full justify-end">
            <div class="mr-16 mt-5 flex flex-col text-center lg:mr-56 lg:mt-10">
                <span class="-mb-[5px] text-[10px] capitalize sm:text-lg">hormat kami</span>
                <span class="text-[8px] capitalize sm:text-sm">derry maxcevy</span>
            </div>
        </div>
    </div>
@endsection
