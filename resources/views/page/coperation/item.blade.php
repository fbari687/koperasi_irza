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

        <div class="h-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <div class="rounded-lg dark:border-gray-600 h-max">
                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                    style="background-image: url('/img/bg-card.jpg'); background-repeat: no-repeat">
                    <a href="#" class="flex justify-center">
                        <img class="p-8 w-auto rounded-t-lg h-[250px]" src="img/products/kebab.png" alt="product image" />
                    </a>
                    <div class="px-5 pb-5">
                        <a href="#">
                            {{-- <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ ucfirst($random->nama_barang) }}</h5> --}}
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Ini Nama Barang
                            </h5>
                            {{-- <h5 class="text-md tracking-tight text-gray-900 dark:text-white">{{ $random->deskripsi }}</h5> --}}
                            <h5 class="text-md tracking-tight text-gray-900 dark:text-white">Ini Deskripsi Barang</h5>
                        </a>
                        <div class="flex items-center mt-2.5 mb-5">
                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                            </div>
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">4.0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            {{-- <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ "Rp. " . number_format($random->harga, 0, ',', '.') }}</span> --}}
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">Rp 18.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-lg dark:border-gray-600 h-max">
                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                    style="background-image: url('/img/bg-card.jpg'); background-repeat: no-repeat">
                    <a href="#" class="flex justify-center">
                        <img class="p-8 w-auto rounded-t-lg h-[250px]" src="img/products/kebab.png"
                            alt="product image" />
                    </a>
                    <div class="px-5 pb-5">
                        <a href="#">
                            {{-- <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ ucfirst($random->nama_barang) }}</h5> --}}
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Ini Nama Barang
                            </h5>
                            {{-- <h5 class="text-md tracking-tight text-gray-900 dark:text-white">{{ $random->deskripsi }}</h5> --}}
                            <h5 class="text-md tracking-tight text-gray-900 dark:text-white">Ini Deskripsi Barang</h5>
                        </a>
                        <div class="flex items-center mt-2.5 mb-5">
                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                            </div>
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">4.0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            {{-- <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ "Rp. " . number_format($random->harga, 0, ',', '.') }}</span> --}}
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">Rp 18.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-lg dark:border-gray-600 h-max">
                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                    style="background-image: url('/img/bg-card.jpg'); background-repeat: no-repeat">
                    <a href="#" class="flex justify-center">
                        <img class="p-8 w-auto rounded-t-lg h-[250px]" src="img/products/kebab.png"
                            alt="product image" />
                    </a>
                    <div class="px-5 pb-5">
                        <a href="#">
                            {{-- <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ ucfirst($random->nama_barang) }}</h5> --}}
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Ini Nama Barang
                            </h5>
                            {{-- <h5 class="text-md tracking-tight text-gray-900 dark:text-white">{{ $random->deskripsi }}</h5> --}}
                            <h5 class="text-md tracking-tight text-gray-900 dark:text-white">Ini Deskripsi Barang</h5>
                        </a>
                        <div class="flex items-center mt-2.5 mb-5">
                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                            </div>
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">4.0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            {{-- <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ "Rp. " . number_format($random->harga, 0, ',', '.') }}</span> --}}
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">Rp 18.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-lg dark:border-gray-600 h-max">
                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                    style="background-image: url('/img/bg-card.jpg'); background-repeat: no-repeat">
                    <a href="#" class="flex justify-center">
                        <img class="p-8 w-auto rounded-t-lg h-[250px]" src="img/products/kebab.png"
                            alt="product image" />
                    </a>
                    <div class="px-5 pb-5">
                        <a href="#">
                            {{-- <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ ucfirst($random->nama_barang) }}</h5> --}}
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Ini Nama Barang
                            </h5>
                            {{-- <h5 class="text-md tracking-tight text-gray-900 dark:text-white">{{ $random->deskripsi }}</h5> --}}
                            <h5 class="text-md tracking-tight text-gray-900 dark:text-white">Ini Deskripsi Barang</h5>
                        </a>
                        <div class="flex items-center mt-2.5 mb-5">
                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                            </div>
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">4.0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            {{-- <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ "Rp. " . number_format($random->harga, 0, ',', '.') }}</span> --}}
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">Rp 18.000</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="rounded-lg h-auto mb-4">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div
                    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 p-4 bg-white dark:bg-gray-900">

                    {{-- MODAL TAMBAH BARANG --}}
                    <div id="defaultModal" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                            <!-- Modal content -->
                            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                <!-- Modal header -->
                                <div
                                    class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Tambah Barang
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="defaultModal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action="{{ route('testDelWhichApi') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Identification</h3>
                                    <ul
                                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <li
                                            class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3">
                                                <input id="vue-checkbox-list" name="students[]" type="checkbox" value="2"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="vue-checkbox-list" name="students[]"
                                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Vue
                                                    JS</label>
                                            </div>
                                        </li>
                                        <li
                                            class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3">
                                                <input id="react-checkbox-list" name="students[]" type="checkbox" value="3"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="react-checkbox-list" name="students[]"
                                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">React</label>
                                            </div>
                                        </li>
                                        <li
                                            class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3">
                                                <input id="angular-checkbox-list" name="students[]" type="checkbox" value="4"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="angular-checkbox-list" name="students[]"
                                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Angular</label>
                                            </div>
                                        </li>
                                        <li class="w-full dark:border-gray-600">
                                            <div class="flex items-center ps-3">
                                                <input id="laravel-checkbox-list" name="students[]" type="checkbox" value="5"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="laravel-checkbox-list" name="students[]"
                                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Laravel</label>
                                            </div>
                                        </li>
                                    </ul>

                                    <button type="submit"
                                        class="mr-4 block text-white bg-green-700 hover:bg-primary-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:hover:bg-green-700">
                                        Tambahkan
                                    </button>
                                    {{-- <div class="grid gap-4 mb-4 sm:grid-cols-2"> --}}
                                    {{-- <div>
                                            <label for="selItems"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                                Barang</label>
                                            <select name="id" id="selItems"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option selected disabled>Pilih Barang</option> --}}

                                    {{-- @foreach ($items as $item) --}}
                                    {{-- <option value="{{ $item->id }}">{{ ucfirst($item->nama_barang) }}</option> --}}
                                    {{-- @endforeach --}}
                                    {{-- <option value="1">Air Mineral</option>

                                            </select>
                                        </div>
                                        <div>
                                            <label for="name"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                                Barang</label>
                                            <input type="text" name="name" id="name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Ganti nama barang" required="">
                                        </div>

                                        <div>

                                            <div class="mb-4">
                                                <label for="edit_harga"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                                                <input type="text" name="email" id="edit_harga"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Exp : 5000" required="">
                                            </div>
                                            <div class="mb-4">
                                                <label for="edit_stok"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                                                <input type="text" name="username" id="edit_stok"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Exp : 17" required="">
                                            </div>
                                            <div class="mb-4">
                                                <label for="edit_stok"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                                                <input type="password" name="password" id="edit_stok"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Exp : 17" required="">
                                            </div> --}}

                                    {{-- <div class="">
                                                <label for="edit_deskripsi"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                                <textarea id="edit_deskripsi" name="deskripsi" rows="6"
                                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Tuliskan deskripsi barangnya disini"></textarea>
                                            </div> --}}
                                    {{-- </div>

                                        <div>
                                            <label for="edit_stok"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                                            <img id="imagePreviewEdit" src="{{ asset('img/no-data.jpg') }}" alt="Preview"
                                                class=""
                                                style="box-shadow: rgba(50, 50, 93, 0.077) 0px 6px 12px -2px, rgba(0, 0, 0, 0.061) 0px 3px 7px -3px; border-radius: 10px; display: ; border: 1px solid rgba(0, 0, 0, 0.161); max-width: 250px; min-width: 250px; width: 100%; aspect-ratio: 1/1">
                                            <input type="file" accept="image/*" id="gambarEdit" name="gambar"
                                                class="mt-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    const imageInputEdit = document.getElementById('gambarEdit');
                                                    const imagePreviewEdit = document.getElementById('imagePreviewEdit');

                                                    imageInputEdit.addEventListener('change', function() {
                                                        if (imageInputEdit.files && imageInputEdit.files[0]) {
                                                            const reader = new FileReader();

                                                            reader.onload = function(e) {
                                                                imagePreviewEdit.src = e.target.result;
                                                                imagePreviewEdit.style.display = 'block';
                                                            };

                                                            reader.readAsDataURL(imageInputEdit.files[0]);
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div> --}}
                                    {{-- <button type="submit"
                                        class="mr-4 block text-white bg-green-700 hover:bg-primary-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:hover:bg-green-700">
                                        Tambahkan
                                    </button> --}}
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- MODAL EDIT BARANG --}}
                    <div id="editItem" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                            <!-- Modal content -->
                            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                <!-- Modal header -->
                                <div
                                    class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Edit Barang
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="editItem">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action="{{ route('update.item') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                        <div>
                                            <label for="selItems"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                                Barang</label>
                                            <select name="id" id="selItems"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option selected disabled>Pilih Barang</option>
                                                {{-- @foreach ($items as $item) --}}
                                                {{-- <option value="{{ $item->id }}">{{ ucfirst($item->nama_barang) }}</option> --}}
                                                {{-- @endforeach --}}
                                                <option value="1">Air Mineral</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                                Barang</label>
                                            <input type="text" name="nama_barang" id="name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Ganti nama barang" required="">
                                        </div>

                                        <div>

                                            <div class="mb-4">
                                                <label for="edit_harga"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                                                <input type="number" name="harga" id="edit_harga"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Exp : 5000" required="">
                                            </div>
                                            <div class="mb-4">
                                                <label for="edit_stok"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                                                <input type="number" name="stok" id="edit_stok"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Exp : 17" required="">
                                            </div>

                                            <div class="">
                                                <label for="edit_deskripsi"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                                <textarea id="edit_deskripsi" name="deskripsi" rows="6"
                                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Tuliskan deskripsi barangnya disini"></textarea>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="edit_stok"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                                            <img id="imagePreview" src="{{ asset('img/no-data.jpg') }}" alt="Preview"
                                                class=""
                                                style="box-shadow: rgba(50, 50, 93, 0.077) 0px 6px 12px -2px, rgba(0, 0, 0, 0.061) 0px 3px 7px -3px; border-radius: 10px; display: ; border: 1px solid rgba(0, 0, 0, 0.161); max-width: 250px; min-width: 250px; width: 100%; aspect-ratio: 1/1">
                                            <input type="file" accept="image/*" id="gambar" name="gambar"
                                                class="mt-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required="">
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    const imageInput = document.getElementById('gambar');
                                                    const imagePreview = document.getElementById('imagePreview');

                                                    imageInput.addEventListener('change', function() {
                                                        if (imageInput.files && imageInput.files[0]) {
                                                            const reader = new FileReader();

                                                            reader.onload = function(e) {
                                                                imagePreview.src = e.target.result;
                                                                imagePreview.style.display = 'block';
                                                            };

                                                            reader.readAsDataURL(imageInput.files[0]);
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>





                                    </div>
                                    <button type="submit"
                                        class="mr-4 block text-white bg-blue-700 hover:bg-primary-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:hover:bg-green-700">
                                        Simpan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="items-center flex flex-wrap">
                        <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                            class="mr-2 sm:mr-4 block text-white bg-green-700 hover:bg-primary-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:hover:bg-green-700"
                            type="button">
                            Tambahkan Barang
                        </button>
                        <button id="editItemButton" data-modal-target="editItem" data-modal-toggle="editItem"
                            class="mr-2 sm:mr-4 block text-white bg-blue-700 hover:bg-primary-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:hover:bg-green-700"
                            type="button">
                            Edit Barang
                        </button>
                        <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                            class="mt-2 sm:mt-0 w-full sm:w-auto mr-2 inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-3 py-2.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600"
                            type="button">
                            <span class="sr-only">Filter</span>
                            <span id="viewValFilter">Filter</span>
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <svg id="load-filter" aria-hidden="true"
                            class="w-7 h-7 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <!-- Dropdown menu -->
                        <div id="dropdownAction"
                            class="z-[999] hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <div class="py-1">
                                <a class="font-semibold text-xl block px-4 py-2 text-sm text-gray-700 dark:text-gray-200">Urutkan
                                    :</a>
                            </div>
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownActionButton">

                                @foreach ($filters as $filter)
                                    <li>
                                        <a id="{{ $filter }}" onclick="filterItem('{{ $filter }}')"
                                            class="cursor-pointer block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><span
                                                class="font-bold">•</span> {{ ucfirst($filter) }}</a>
                                    </li>
                                @endforeach

                            </ul>
                            <div id="rem-filter" class="py-1">
                                <a id="nothing" onclick="return filterItem('nothing')"
                                    class="cursor-pointer block px-4 py-2 text-sm text-red-700 hover:bg-red-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Hapus
                                    Filter</a>
                            </div>
                        </div>
                    </div>
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg id="search-logo" class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <svg id="load-logo" aria-hidden="true"
                                class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <input type="text" id="search-items"
                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Cari barang...">
                    </div>
                </div>
                <div id="pagination-container"></div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="myTable">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Barang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Harga
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">

                            </th>
                        </tr>
                    </thead>
                    <tbody id="items-value">

                        {{-- @forelse($items as $item)

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

                                    @if ($item->stok < 1)

                                        <div class="h-2.5 w-2.5 rounded-full bg-red-700 me-2"></div> Habis

                                    @elseif($item->stok < 6 && $item->stok > 0)

                                        <div class="h-2.5 w-2.5 rounded-full bg-red-300 me-2"></div> Sisa {{ $item->stok }}

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

                    @endforelse --}}

                        {{-- <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th class="px-6 py-4" colspan="4">
                            {{ $items->links() }}
                        </th>
                    </tr> --}}

                        @foreach ($data as $item)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <img class="w-10 h-10 rounded-full" src="img/65.png" alt="Jese image">
                                    <div class="ps-3">
                                        <div class="text-base font-semibold">{{ $loop->iteration }}. {{ $item['API'] }}
                                        </div>
                                        <div class="font-normal text-gray-500">{{ $item['Description'] }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item['Category'] }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">

                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> {{ $item['Link'] }}

                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500"><button
                                            class="p-3 bg-blue-700 text-white rounded-lg active:scale-95">Unduh
                                            Laporan</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <script src="/js/jquery.min.js"></script>
                <script src="/js/pagination.min.js"></script>
                <script>
                    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                    const searchBtn = document.getElementById('search-items');
                    const tableData = document.getElementById('items-value');
                    const searchLogo = document.getElementById('search-logo');
                    const loadLogo = document.getElementById('load-logo');
                    const loadFilter = document.getElementById('load-filter');
                    const viewValFilter = document.getElementById('viewValFilter');
                    const remFilter = document.getElementById('rem-filter');
                    let myPagination = null;

                    loadLogo.style.display = 'none';
                    loadFilter.style.display = 'none';
                    remFilter.style.display = 'none';

                    const ucFirst = (str) => {
                        let firstChar = str.charAt(0);
                        firstChar = firstChar.toUpperCase();
                        let strWithoutFirstChar = str.slice(1);
                        let newString = firstChar + strWithoutFirstChar;
                        return newString;
                    }

                    const filterItems = async (filter) => {
                        try {
                            const response = await axios.post('{{ route('filter.item') }}', {
                                filter: filter
                            }, {
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Cache-Control': 'no-cache',
                                },
                            });


                            return response.data;
                        } catch (error) {
                            console.error("Gagal memuat permintaan", error);
                            throw error;
                        }
                    }

                    const fetchItems = async (search) => {
                        try {
                            const response = await axios.post('{{ route('search.item') }}', {
                                search: search
                            }, {
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                }
                            });

                            return response.data;
                        } catch (error) {
                            console.error("Gagal memuat permintaan", error);
                            throw error;
                        }
                    }

                    const filterItem = async (filter) => {
                        loadFilter.style.display = 'inline';

                        try {
                            const result = await filterItems(filter);
                            if (myPagination) {
                                myPagination.pagination('destroy');
                            }

                            myPagination = $('#myTable').pagination({
                                dataSource: result,
                                pageSize: 10,
                                showPageNumbers: true,
                                showNavigator: true,
                                callback: function(data, pagination) {
                                    updateTable(data);
                                }
                            });
                        } catch (error) {
                            console.error("Gagal menangani permintaan", error);
                        }

                        loadFilter.style.display = 'none';
                        filter == 'nothing' ? viewValFilter.innerHTML = 'Filter' : viewValFilter.innerHTML = ucFirst(filter);
                        searchBtn.value = '';

                        filter != 'nothing' ? remFilter.style.display = 'block' : remFilter.style.display = 'none';;
                    }

                    searchBtn.addEventListener('change', async () => {
                        searchLogo.style.display = 'none';
                        loadLogo.style.display = 'inline';

                        let value = searchBtn.value;
                        try {
                            const result = await fetchItems(value);
                            if (myPagination) {
                                myPagination.pagination('destroy');
                            }

                            myPagination = $('#myTable').pagination({
                                dataSource: result,
                                pageSize: 10,
                                showPageNumbers: true,
                                showNavigator: true,
                                callback: function(data, pagination) {
                                    updateTable(data);
                                }
                            });
                            loadLogo.style.display = 'none';
                            searchLogo.style.display = 'inline';
                            viewValFilter.innerHTML = 'Filter';
                        } catch (error) {
                            console.error("Gagal menangani permintaan", error);
                        }
                    });


                    let numberFormatter = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    });

                    // Function to update the table with new data
                    const updateTable = (data) => {
                        let tableBody = document.getElementById('items-value');
                        tableBody.innerHTML = ''; // Clear existing table rows

                        // Populate the table with data for the current page
                        data.forEach(function(item) {
                            let row = document.createElement('tr');
                            row.className =
                                'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600';

                            // Create and append cells for each column
                            let cell1 = document.createElement('th');
                            cell1.setAttribute('scope', 'row');
                            cell1.className = 'flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white';

                            let image = document.createElement('img');
                            image.className = 'w-10 h-10 rounded-full';
                            image.src = 'img/65.png'; // You may want to dynamically set the image source based on item data
                            image.alt = 'Jese image';

                            let ps3 = document.createElement('div');
                            ps3.className = 'ps-3';

                            let itemName = document.createElement('div');
                            itemName.className = 'text-base font-semibold';
                            itemName.textContent = item
                                .nama_barang; // Assuming 'nama_barang' is a property in your item object

                            let itemDescription = document.createElement('div');
                            itemDescription.className = 'font-normal text-gray-500';
                            itemDescription.textContent = item
                                .deskripsi; // Assuming 'deskripsi' is a property in your item object

                            ps3.appendChild(itemName);
                            ps3.appendChild(itemDescription);

                            cell1.appendChild(image);
                            cell1.appendChild(ps3);

                            let cell2 = document.createElement('td');
                            cell2.className = 'px-6 py-4';
                            cell2.textContent = numberFormatter.format(item.harga);

                            let cell3 = document.createElement('td');
                            cell3.className = 'px-6 py-4';
                            let statusDiv = document.createElement('div');
                            statusDiv.className = 'flex items-center';

                            if (item.stok < 1) {
                                let statusBadge = document.createElement('div');
                                statusBadge.className = 'h-2.5 w-2.5 rounded-full bg-red-700 me-2';
                                statusDiv.appendChild(statusBadge);
                                statusDiv.textContent = 'Habis';
                            } else if (item.stok < 6 && item.stok > 0) {
                                let statusBadge = document.createElement('div');
                                statusBadge.className = 'h-2.5 w-2.5 rounded-full bg-red-300 me-2';
                                statusDiv.appendChild(statusBadge);
                                statusDiv.textContent = 'Sisa ' + item.stok;
                            } else {
                                let statusBadge = document.createElement('div');
                                statusBadge.className = 'h-2.5 w-2.5 rounded-full bg-green-500 me-2';
                                statusDiv.appendChild(statusBadge);
                                statusDiv.textContent = 'Tersedia ' + item.stok;
                            }

                            cell3.appendChild(statusDiv);

                            let cell4 = document.createElement('td');
                            cell4.className = 'px-6 py-4 text-right';
                            let downloadLink = document.createElement('a');
                            downloadLink.href = '#';
                            downloadLink.className = 'font-medium text-blue-600 dark:text-blue-500';

                            let downloadButton = document.createElement('button');
                            downloadButton.className = 'p-3 bg-blue-700 text-white rounded-lg active:scale-95';
                            downloadButton.textContent = 'Unduh Laporan';

                            downloadLink.appendChild(downloadButton);
                            cell4.appendChild(downloadLink);

                            row.appendChild(cell1);
                            row.appendChild(cell2);
                            row.appendChild(cell3);
                            row.appendChild(cell4);

                            tableBody.appendChild(row);
                        });
                    }
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
