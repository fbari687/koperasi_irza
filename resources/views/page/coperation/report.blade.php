@extends('master')

@section('content')

<main class="p-4 md:ml-64 h-auto pt-20">
    <div class="rounded-lg h-96 mb-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 p-4 bg-white dark:bg-gray-900">
                <div>
                    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600" type="button">
                        <span class="sr-only">Action button</span>
                        Cetak Laporan
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownAction" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cetak Laporan Sebagai PDF</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cetak Laporan Sebagai Excel</a>
                            </li>
                        </ul>
                </div>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Laporan Transaksi Hari Ini
                    {{-- <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p> --}}
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Barang
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Harga
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                <td class="px-6 py-4 font-semibold">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction['date'] }}
                                </td>
                                {{-- <th scope="row"
                                    class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="ps-3">
                                        <div class="text-base font-semibold">{{ $item['date'] }}
                                        </div>
                                    </th> --}}
                                <td class="px-6 py-4">
                                    <ul class="flex flex-col gap-2">
                                        @foreach ($transaction['items'] as $item)
                                        <li class="flex flex-col gap-0.5">
                                            <span>
                                                Nama: <span class="font-semibold">{{ $item['detail']['name'] }}</span>
                                            </span>
                                            <span>
                                                Harga Satuan: <span class="font-semibold">{{ $item['detail']['price'] }}</span>
                                            </span>
                                            <span>
                                                Jumlah: <span class="font-semibold">{{ $item['quantity'] }}</span>
                                            </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction['prices'] }}
                                </td>
                                {{-- <td class="px-6 py-4 text-right">
                                    <button class="font-medium text-blue-600 dark:text-blue-500"><button
                                            class="p-3 bg-blue-700 text-white rounded-lg active:scale-95">Unduh
                                            Laporan</button></button>
                                </td> --}}
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>


@endsection
