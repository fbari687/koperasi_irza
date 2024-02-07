@extends('master')

@section('content')
    <div class="p-4 md:ml-64 h-auto pt-32 sm:pt-20">
        <div class="rounded-lg shadow-md bg-white h-auto mb-4">
            <div class="p-4 rounded-lg dark:bg-gray-900 dark:text-gray-100">
                <div class="flex flex-col md:space-y-0 md:space-x-6 md:flex-row">
                    <img id="imagePreview" src="{{ Auth::user()->photo == null ? asset('img/no-data.jpg') : asset('storage/'.Auth::user()->photo) }}" alt=""
                        class="self-center flex-shrink-0 w-48 h-48 shadow border-gray-600 border-2 rounded-full md:justify-self-start dark:bg-gray-500 dark:border-gray-700">
                    <div class="flex flex-col">
                        <h4 class="text-xl font-semibold text-center md:text-left">{{ Auth::user()->name }} -
                            ({{ Auth::user()->nis }})</h4>
                        <p class="dark:text-gray-400 text-lg">{{ Auth::user()->class }}</p>
                        <p class="dark:text-gray-400 text-lg">{{ Auth::user()->telephone }}</p>
                        <p class="dark:text-gray-400 text-lg">{{ Auth::user()->email }}</p>

                        <label class="block mb-1 mt-3 text-sm font-medium text-gray-900 dark:text-white"
                            for="user-photo">Change Photo</label>
                        <form action="{{ route('changePhotoProfile') }}" method="POST" enctype="multipart/form-data" class="flex">
                            @csrf
                            @method('PUT')
                            <input name="photo"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-l-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="user-photo" type="file" required>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                                <span class="sr-only">Icon description</span>
                            </button>
                        </form>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const imageInput = document.getElementById('user-photo');
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
                        {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF
                            (MAX. 800x400px).</p> --}}

                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white mt-4 shadow-md rounded p-4">
            <h3 class="font-semibold text-xl mb-4">INFORMATION SETTING</h3>
            <form action="{{ route('editProfile') }}" method="POST" class="grid grid-cols-3 gap-4">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    @foreach ($errors->all() as $item)
                        {{ $item }}
                    @endforeach
                @endif
                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Lengkap</label>
                    <input type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Nama Lengkap" value="{{ Auth::user()->name }}" required="">
                </div>

                <div class="mb-4">
                    <label for="nis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nis</label>
                    <input type="number" name="nis" id="nis"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Nis" value="{{ Auth::user()->nis }}" required="">
                </div>

                <div class="mb-4">
                    <label for="class" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                    <select name="class" id="class"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        {{-- @foreach ($items as $item) --}}
                        {{-- <option value="{{ $item->id }}">{{ ucfirst($item->nama_barang) }}</option> --}}
                        {{-- @endforeach --}}
                        <option value="{{ Auth::user()->class }}" selected>{{ Auth::user()->class }}</option>
                        <option value="XII-RPL" class="{{ Auth::user()->class == 'XII-RPL' ? 'hidden' : '' }}">XII-RPL
                        </option>
                        <option value="XI-PPLG1" class="{{ Auth::user()->class == 'XI-RPL' ? 'hidden' : '' }}">XI-PPLG1
                        </option>
                        <option value="X-PPLG1" class="{{ Auth::user()->class == 'X-RPL' ? 'hidden' : '' }}">X-PPLG1
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                        Telepon</label>
                    <input type="text" name="telephone" id="telepon"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Nomor Telepon" value="{{ Auth::user()->telephone }}" required="">
                </div>

                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                        Address</label>
                    <input type="mail" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Email Address" value="{{ Auth::user()->email }}" required="">
                </div>
                <div class="mb-4">
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" name="password" id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Password">
                </div>
                <div class="mb-4">
                    <button type="submit"
                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
