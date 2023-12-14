<div class="relative flex h-[472px] w-[65%] flex-col justify-between px-3">
    <div>
        <table class="w-full border-collapse bg-white">
            <h2 class="py-2 pl-2 text-lg font-semibold">Faktur Penjualan</h2>
            <thead>
                <tr class="text-sm capitalize text-[#7D7C81]">
                    <th class="border border-transparent p-2 text-left">no faktur</th>
                    <th class="border border-transparent p-2 text-left">toko</th>
                    <th class="border border-transparent text-center">total</th>
                    <th class="border border-transparent p-2 text-center">status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr wire:key='$item->id'>
                        <td class="p-2 py-3 text-sm">{{ $item->no_faktur }}</td>
                        <td class="p-2 py-3 text-left text-sm">{{ $item->toko }}
                        </td>
                        <td class="text-center text-sm">
                            {{ currency_IDR($item->total - $item->retur) }}
                        </td>
                        @if ($item->tagihan == 'Lunas')
                            <td class="px-2 py-3 text-center text-sm text-green-500">
                                <span class="rounded-md border border-green-500 px-9 py-1">
                                    {{ $item->tagihan }}
                                </span>
                            </td>
                        @else
                            <td class="px-2 py-3 text-center text-sm text-blue-500">
                                <span class="rounded-md border border-blue-500 px-3 py-1">
                                    {{ $item->tagihan }}
                                </span>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex w-full justify-center pb-1">
        {{ $data->links() }}
    </div>
</div>
