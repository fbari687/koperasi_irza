@forelse($items as $item)

    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
            <img class="w-10 h-10 rounded-full" src="img/65.png" alt="Jese image">
            <div class="ps-3">
                <div class="text-base font-semibold">{{ ucfirst($item->nama_barang) }}</div>
                <div class="font-normal text-gray-500">{{ $item->deskripsi }}</div>
            </div>  
        </th>
        <td class="px-6 py-4">
            {{ "Rp. " . number_format($item->harga, 0, ',', '.') }}
        </td>
        <td class="px-6 py-4">
            <div class="flex items-center">

                @if($item->stok < 1)

                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Habis

                @elseif($item->stok < 6 && $item->stok > 0)

                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Sisa {{ $item->stok }}
                
                @else
                
                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Tersedia {{ $item->stok }}

                @endif
            </div>
        </td>
        <td class="px-6 py-4 text-right">
            <a href="#" class="font-medium text-blue-600 dark:text-blue-500"><button class="p-3 bg-blue-700 text-white rounded-lg active:scale-95">Unduh Laporan</button></a>
        </td>
    </tr>
    
@empty

    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <th class="px-6 py-4" colspan="4">
            <h1>Tidak ada data</h1>
        </th>
    </tr>

    
@endforelse

{{-- <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
    <th class="px-6 py-4" colspan="4">
        {{ $items->links() }}
    </th>
</tr> --}}