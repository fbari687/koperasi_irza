@extends('master')

@section('content')
    <main class="p-4 md:ml-64 h-auto pt-20">

        <style>
            .paginationjs {
                padding: 10px;
            }
        </style>

        <link rel="stylesheet" href="/css/pagination.css">

        @if (session('success'))
            <div id="toast-success"
                class="border-t-4 border-green-500 left-1/2 transform -translate-x-1/2 fixed top-5 text-center z-[999] mx-auto mb-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-xl dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ ucfirst(session('success')) }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @elseif(session('error'))
            <div id="toast-warning"
                class="border-t-4 border-red-500 left-1/2 transform -translate-x-1/2 fixed top-5 text-center z-[999] mx-auto mb-5 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-xl dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                    </svg>
                    <span class="sr-only">Warning icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session('error') }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-warning" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif


        <div class="rounded-lg h-auto mb-4">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div id="pagination-container"></div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="myTable">
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

                <!-- Tambahkan tag <script> ini di dalam halaman Anda -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    $(document).ready(function() {
        // Fungsi untuk memperbarui tabel dengan data baru
        function updateTable(data) {
            $('#items-value').empty(); // Kosongkan isi tabel
            $.each(data, function(index, item) {
                var row = '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">' +
                    '<th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">' +
                    '<img class="w-10 h-10 rounded-full" src="storage/' + item.image + '" alt="' + item.name + ' image">' +
                    '<div class="ps-3">' +
                    '<div class="text-base font-semibold">' + (index + 1) + '. ' + item.name + '</div>' +
                    '<div class="font-normal text-gray-500">Rp. ' + item.price + '</div>' +
                    '</div>' +
                    '</th>' +
                    '<td class="px-6 py-4">' + item.description + '</td>' +
                    '<td class="px-6 py-4">' + item.stock + '</td>' +
                    '<td class="px-6 py-4">' + item.total_sold + '</td>' +
                    '<td class="px-6 py-4">' +
                    '<div class="flex items-center">' +
                    '<div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>' + item.status +
                    '</div>' +
                    '</td>' +
                    '<td class="px-6 py-4 text-right flex items-center gap-2">' +
                    '<a href="#" '+ `data-id='${item.id}'` +' class="delete-btn font-medium text-blue-600 dark:text-blue-500"><button class="p-3 bg-blue-700 text-white rounded-lg active:scale-95">Unduh Laporan</button></a>';
                $('#items-value').append(row);
            });
        }


        function fetchData() {
            $.ajax({
                type: 'GET',
                url: 'http://localhost:4444/item',
                success: function(response) {
                    updateTable(response.data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        var firstInterval = setInterval(fetchData, 0);

        setTimeout(() => {
            clearInterval(firstInterval)
            setInterval(fetchData, 5000)
        }, 0);


    });
    $(document).ready(function() {
        // Fungsi untuk menghapus item
        function deleteItem(itemId) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'DELETE',
            url: '/items/' + itemId, // Ganti dengan URL endpoint delete Anda
            data: {
                _token: csrfToken // Sertakan token CSRF di sini
            },
            success: function(response) {
                fetchData(); // Panggil kembali fetchData untuk memperbarui tabel setelah penghapusan berhasil
            },
            error: function(xhr, status, error) {
                console.error(error); // Tangani kesalahan jika terjadi
            }
        });
    }

    // Tambahkan event listener ke setiap tombol delete
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault(); // Mencegah tindakan default dari link
        var itemId = $(this).data('id'); // Dapatkan ID item dari atribut data
        var confirmation = confirm('Apakah Anda yakin ingin menghapus item ini?'); // Konfirmasi penghapusan
        if (confirmation) {
            deleteItem(itemId); // Panggil fungsi deleteItem jika pengguna mengonfirmasi
        }
        });
    });



</script> --}}

<script>
    $(document).ready(function() {
        function fetchData() {
            $.ajax({
                type: "GET",
                url: "http://localhost:3000/items/get",
                success: function (response) {
                    console.log(response.data);
                },
                error: function (xhr, status, error) {

                }
            });
        }

        function updateItem(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "http://localhost:3000/items",
                data: "data",
                dataType: "dataType",
                success: function (response) {

                }
            });
        }
        fetchData();
    })
</script>

            </div>
        </div>
        {{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div class="border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600 h-32 md:h-64"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64"></div>
    </div>
    <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
    </div>
    <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
    <div class="grid grid-cols-2 gap-4">
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
    </div> --}}
    </main>
@endsection
