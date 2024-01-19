<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="relative min-h-screen flex ">
        <div
            class="flex flex-col sm:flex-row items-center md:items-start sm:justify-center md:justify-start flex-auto min-w-0 bg-white">
            <div class="sm:w-1/2 xl:w-2/5 h-full hidden md:flex flex-auto items-center justify-start p-10 overflow-hidden text-white bg-no-repeat relative"
                style="background-image: url(img/gedung-65.jpg);">
                <div class="absolute bg-gradient-to-b from-blue-900 to-gray-900 opacity-25 inset-0 z-0"></div>
                <div class="absolute triangle min-h-screen right-0 w-16" style=""></div>
                <a href="https://github.com/irzaarivin" target="_blank" title="Irza Arivin"
                    class="flex absolute top-5 text-center text-gray-100 focus:outline-none"><img
                        src="img/65.png" alt="aji"
                        class="object-cover mx-auto w-8 h-8 rounded-full w-10 h-10">
                    <p class="text-xl ml-3">Koperasi <strong>SMK Negeri 65 Jakarta</strong></p>
                </a>
                <img src="img/money.png" class="h-96 absolute right-0">
                <div class="w-full  max-w-md z-10">
                    <div class="sm:text-4xl xl:text-5xl font-bold leading-tight mb-6" style="text-shadow: 6px 6px 10px rgba(0,0,0,0.6);">Tempatnya Untuk Keuangan yang Lebih Cerdas dan Berkelanjutan.
                    </div>
                    <div class="sm:text-sm xl:text-md text-gray-200 font-normal" style="text-shadow: 1px 1px 5px rgba(0,0,0,0.6);">Dengan fokus pada efisiensi operasional dan perencanaan keuangan yang bijaksana, kami bertekad menjadi mitra terpercaya dalam merancang masa depan keuangan yang lebih baik untuk koperasi sekolah.</div>
                </div>
                <div class="absolute bottom-5 sm:text-sm xl:text-md text-gray-200 font-normal" style="text-shadow: 1px 1px 5px rgba(0,0,0,0.6);"><b>©</b> 2023 Cooperative of State Vocational School 65 Jakarta. All Rights Reserved.</div>
            </div>
            <div
                class="md:flex md:items-center md:justify-center w-full sm:w-auto md:h-full w-2/5 xl:w-2/5 p-8  md:p-10 lg:p-14 sm:rounded-lg md:rounded-none bg-white ">
                <div class="max-w-md w-full space-y-8">
                    @if(session('success'))
                        <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                            <div class="ms-3 text-sm font-medium">
                                {{ session('success') }}
                            </div>
                            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>
                    @elseif(session('error'))
                        <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <div class="ms-3 text-sm font-medium">
                                 {{ session('error') }}
                            </div>
                            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>
                    @endIf
                    <div class="text-center">
                        <h2 class="mt-2 text-3xl font-bold text-gray-900">
                            Halo Petugas!
                        </h2>
                    </div>
                    <div class="flex items-center justify-center space-x-2">
                        <span class="h-px w-16 bg-gray-200"></span>
                        <span class="text-gray-300 font-normal">Login</span>
                        <span class="h-px w-16 bg-gray-200"></span>
                    </div>
                    <form class="mt-8 space-y-6" action="" method="POST">
                        @csrf
                        <input type="hidden" name="remember" value="true">
                        <div class="relative">
                            <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email</label>
                            <input name="email" class=" w-full text-base px-4 py-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500" type="email" placeholder="mail@gmail.com">
                        </div>
                        <div class="mt-8 content-center">
                            <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Password</label>
                            <input name="password" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="password" placeholder="********">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input name="remember_me" id="remember_me" type="checkbox" class="h-4 w-4 bg-blue-500 focus:ring-blue-400 border-gray-300 rounded cursor-pointer">
                                <label for="remember_me" class="ml-2 block text-sm text-gray-900 cursor-pointer">
                                    Ingat Saya
                                </label>
                            </div>
                            <div class="text-sm">
                                <a href="/register" class="text-indigo-400 hover:text-blue-500">
                                    <b>SignUp</b>
                                </a>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="w-full flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600  hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-4  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
                                Sign in
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
