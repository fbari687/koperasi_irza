<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        input[type="radio"]:checked + label {
            background-color: #3490dc;
            color: #fff;
        }
    </style>
</head>

<body class="antialiased">
    <section class="bg-white dark:bg-gray-900">
        <div class="flex justify-center min-h-screen">
            <div class="hidden bg-cover lg:block lg:w-2/5 relative" style="background-image: url('img/bussiness.jpg')">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <img src="img/65.png" alt="SMK Negeri 65 Jakarta" class="w-64 h-64 shadow-lg shadow-blue-500/50 rounded-full">
                </div>
            </div>

            <div class="flex items-center w-full max-w-3xl p-8 mx-auto lg:px-12 lg:w-3/5">
                <form class="w-full" action="" method="POST">
                    @csrf
                    <h1 class="text-2xl font-semibold tracking-wider text-gray-800 capitalize dark:text-white">
                        Bentuk Masa Depan Keuangan Sekolah Diawali Dengan Koperasi.
                    </h1>

                    <p class="mt-4 text-gray-500 dark:text-gray-400">
                        Tingkatkan pengalaman sekolah Kamu dan jadilah bagian dari tim petugas koperasi untuk membentuk masa depan keuangan sekolah yang lebih cerdas dan berkelanjutan.
                    </p>

                    <div class="mt-6">
                        <h1 class="text-gray-500 dark:text-gray-300">Apa tipe akun kamu?</h1>

                        <div class="mt-3 md:flex md:items-center md:-mx-2">
                            <input required value="petugas" type="radio" name="role" id="petugas" class="hidden" />
                            <label for="petugas" class="cursor-pointer flex justify-center w-full px-6 py-3 mt-4 text-blue-500 border border-blue-500 rounded-md md:mt-0 md:w-auto md:mx-2 dark:border-blue-400 dark:text-blue-400 focus:outline-none transition-all duration-300 ease-in-out hover:bg-blue-50 focus:bg-blue-400 focus:text-white">
                                <!-- Ikon SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <!-- Teks "Petugas" -->
                                <span class="mx-2">
                                    Petugas
                                </span>
                            </label>

                            <input required value="admin" type="radio" name="role" id="admin" class="hidden" />
                            <label for="admin" class="cursor-pointer flex justify-center w-full px-6 py-3 mt-4 text-blue-500 border border-blue-500 rounded-md md:mt-0 md:w-auto md:mx-2 dark:border-blue-400 dark:text-blue-400 focus:outline-none transition-all duration-300 ease-in-out hover:bg-blue-50 focus:bg-blue-400 focus:text-white">
                                <!-- Ikon SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <!-- Teks "Admin" -->
                                <span class="mx-2">
                                    Admin
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Nama Lengkap</label>
                            <input required type="text" name="name" placeholder="Farhan Kebab" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">NIS</label>
                            <input required type="number" name="nis" pattern="[0-9]*" inputmode="numeric" placeholder="00123456789" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Nomor Telepon</label>
                            <input required type="text" name="telephone" placeholder="08XX-XXXX-XXXX" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Alamat Email</label>
                            <input required type="email" name="email" placeholder="farhankebab@example.com" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Password</label>
                            <input required type="password" name="password" placeholder="********" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Konfirmasi Password</label>
                            <input required type="password" name="confirm_password" placeholder="********" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Pilih Kelas</label>
                            <div class="relative">
                                <select name="class" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md appearance-none dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40">
                                    <option value="" disabled selected>...</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->name }}">{{ $class->name }}</option>
                                    @endForeach
                                </select>
                            </div>
                        </div>

                        <button class="flex items-center justify-between w-full px-6 py-3 text-sm tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                            <span class="text-lg font-bold">Sign Up </span>

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-scale-x-100" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>