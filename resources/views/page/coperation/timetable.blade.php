@extends('master')

@section('content')
    <main class="p-4 md:ml-64 h-auto pt-20">
        <div id="defaultModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Tambah Jadwal
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
                    <form id="itemAddForm" action="{{ route('items.add') }}" method="POST" onsubmit="updateItem(this)"
                        enctype="multipart/form-data">
                        @csrf

                        {{-- @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    @endif --}}
                        <div class="grid gap-4 mb-4 sm:grid-cols-1">

                            <div>
                                <div class="mb-4">
                                    <label for="userId"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penjaga</label>
                                    <select id="userId"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                        <option value="0" disable selected>Pilih Penjaga</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="startAdd"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                                    <input type="date" name="start" id="startAdd"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Rp. 20,000" required="">
                                </div>

                                {{-- <div class="mb-4">
                                    <label for="stock"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                                    <input type="text" name="stock" id="stockAdd"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="20" required="">
                                </div>

                                <div class="">
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                    <textarea id="descriptionAdd" name="description" rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                                </div> --}}
                            </div>

                            {{-- <div>
                                <label for="image"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                                <img id="imagePreviewEdit" src="{{ asset('img/no-data.jpg') }}" alt="Preview"
                                    class=""
                                    style="box-shadow: rgba(50, 50, 93, 0.077) 0px 6px 12px -2px, rgba(0, 0, 0, 0.061) 0px 3px 7px -3px; border-radius: 10px; display: ; border: 1px solid rgba(0, 0, 0, 0.161); max-width: 300px; min-width: 300px; width: 100%; aspect-ratio: 1/1">
                                <input type="file" accept="image/*" id="gambarEdit" name="image"
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
                            </div> --}}
                        </div>
                        <button type="submit"
                            class="mr-4 block text-white bg-green-700 hover:bg-primary-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:hover:bg-green-700">
                            Tambahkan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div id="editJadwal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit Jadwal
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="editJadwal">
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
                    <form id="itemAddForm" action="{{ route('items.add') }}" method="POST" onsubmit="updateItem(this)"
                        enctype="multipart/form-data">
                        @csrf

                        {{-- @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    @endif --}}
                        <div class="grid gap-4 mb-4 sm:grid-cols-1">

                            <div>
                                <div class="mb-4">
                                    <label for="startEdit"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Yang
                                        ingin di Edit</label>
                                    <input type="date" name="start" id="priceEdit"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Rp. 20,000" required="">
                                </div>
                                <div class="mb-4">
                                    <label for="userId"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penjaga</label>
                                    <select id="userId"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                        <option value="0" disable selected>Pilih Penjaga</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                {{-- <div class="mb-4">
                                    <label for="stock"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                                    <input type="text" name="stock" id="stockAdd"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="20" required="">
                                </div>

                                <div class="">
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                    <textarea id="descriptionAdd" name="description" rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                                </div> --}}
                            </div>

                            {{-- <div>
                                <label for="image"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                                <img id="imagePreviewEdit" src="{{ asset('img/no-data.jpg') }}" alt="Preview"
                                    class=""
                                    style="box-shadow: rgba(50, 50, 93, 0.077) 0px 6px 12px -2px, rgba(0, 0, 0, 0.061) 0px 3px 7px -3px; border-radius: 10px; display: ; border: 1px solid rgba(0, 0, 0, 0.161); max-width: 300px; min-width: 300px; width: 100%; aspect-ratio: 1/1">
                                <input type="file" accept="image/*" id="gambarEdit" name="image"
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
                            </div> --}}
                        </div>
                        <button type="submit"
                            class="mr-4 block text-white bg-green-700 hover:bg-primary-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:hover:bg-green-700">
                            Tambahkan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="rounded-lg border-gray-300 dark:border-gray-600 mb-4">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full p-4">
                <div class="w-full items-center flex mb-2">
                    <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                        class="mr-2 sm:mr-4 block text-white bg-green-700 hover:bg-primary-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:hover:bg-green-700"
                        type="button">
                        Tambahkan Jadwal
                    </button>
                    <button id="editJadwalButton" data-modal-target="editJadwal" data-modal-toggle="editJadwal"
                        class="mr-2 sm:mr-4 block text-white bg-blue-700 hover:bg-primary-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:hover:bg-green-700"
                        type="button">
                        Edit Jadwal
                    </button>
                </div>
                <caption
                    class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Jadwal Penjaga Koperasi
                </caption>
                <div id="calendar"></div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'listWeek',
                events: [
                    @foreach ($timetables as $data)
                        {
                            title: '{{ $data->title }}',
                            start: '{{ $data->start }}',
                            allDay: true
                        },
                    @endforeach
                ],
                eventDidMount: function(info) {
                    if (info.event.extendedProps.status === 'done') {


                        // Change color of dot marker
                        var dotEl = info.el.getElementsByClassName('fc-event-dot')[0];
                        if (dotEl) {
                            dotEl.style.backgroundColor = 'white';
                        }
                    }
                }

            });
            calendar.render();
        });
    </script>
@endsection
