@extends('master')

@section('content')
    <!-- component -->
    <!-- This is an example component -->
    <main class="p-4 md:ml-64 mx-auto h-full pt-12 max-w-screen mt-4">
        <div class="rounded-lg h-auto mb-4">
            <div class="container mx-auto shadow-lg rounded-lg">
                <!-- end header -->
                <!-- Chatting -->
                <div class="flex flex-row justify-between bg-white">
                    <!-- chat list -->
                    <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto">
                        <!-- search compt -->
                        {{-- <div class="border-b-2 py-4 px-2">
                        <input type="text" placeholder="search chatting"
                            class="py-2 px-2 border-2 border-gray-200 rounded-2xl w-full" />
                    </div> --}}
                        <!-- end search compt -->
                        <!-- user list -->
                        <div class="flex flex-row py-4 px-2 items-center border-b-2 border-l-4 border-blue-400">
                            <div class="w-1/4">
                                <img src="https://source.unsplash.com/L2cxSuKWbpo/600x600"
                                    class="object-cover h-12 w-12 rounded-full" alt="" />
                            </div>
                            <div class="w-full">
                                <div class="text-lg font-semibold">Koperasi</div>
                                <span class="text-gray-500">Lusi : Thanks Everyone</span>
                            </div>
                        </div>
                        <!-- end user list -->
                    </div>
                    <!-- end chat list -->
                    <!-- message -->
                    <div class="w-full px-5 flex flex-col justify-between" style="min-height: 88vh;">
                        <div class="flex flex-col mt-5" id="chatContainer">
                            <div class="flex justify-end mb-4">
                                <div
                                    class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                    Welcome to group everyone !
                                </div>
                                <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                                    class="object-cover h-8 w-8 rounded-full" alt="" />
                            </div>
                            <div class="flex justify-start mb-4">
                                <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                                    class="object-cover h-8 w-8 rounded-full" alt="" />
                                <div
                                    class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat
                                    at praesentium, aut ullam delectus odio error sit rem. Architecto
                                    nulla doloribus laborum illo rem enim dolor odio saepe,
                                    consequatur quas?
                                </div>
                            </div>
                            <div class="flex justify-end mb-4">
                                <div>
                                    <div
                                        class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                        Magnam, repudiandae.
                                    </div>

                                </div>
                                <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                                    class="object-cover h-8 w-8 rounded-full" alt="" />
                            </div>
                            <div class="flex justify-start mb-4">
                                <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                                    class="object-cover h-8 w-8 rounded-full" alt="" />
                                <div
                                    class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                                    happy holiday guys!
                                </div>
                            </div>
                        </div>
                        <div id="formMessage" class="w-full bg-gray-300 py-3 my-2 px-3 rounded-xl flex items-center justify-between">
                            <input class="w-full bg-transparent outline-none border-none rounded-xl focus:outline-none" type="text"
                                placeholder="type your message here..." id="message" />
                            <button type="button" id="sendMessageBtn">Submit</button>
                        </div>
                    </div>
                    <!-- end message -->
                    <div class="w-2/5 border-l-2 px-5">
                        <div class="flex flex-col">
                            <div class="font-semibold text-xl py-4">Koperasi Group</div>
                            <img src="https://source.unsplash.com/L2cxSuKWbpo/600x600" class="object-cover rounded-xl h-64"
                                alt="" />
                            <div class="font-semibold py-4">Created 22 Sep 2021</div>
                            <div class="font-light">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt,
                                perspiciatis!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const chatContainer = document.getElementById('chatContainer');
        const formMessage = document.getElementById('formMessage');
        const message = document.getElementById('message');
        const sendMessageBtn = document.getElementById('sendMessageBtn');

        sendMessageBtn.addEventListener('click', function () {
            if(message.value == "") {
                return false;
            }

            sendMessage();
        })

        message.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();

            if(message.value == "") {
                return false;
            }

            sendMessage();
        }
        });

        const sendMessage = () => {
            let element = `<div class="flex justify-end mb-4">
                                <div>
                                    <div
                                        class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                        ${message.value}
                                    </div>

                                </div>
                                <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                                    class="object-cover h-8 w-8 rounded-full" alt="" />
                            </div>`;
                            chatContainer.insertAdjacentHTML("beforeend", element);
            message.value = "";
        };
    </script>
@endsection
