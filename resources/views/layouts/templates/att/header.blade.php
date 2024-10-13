<!DOCTYPE html>
<html lang="en">

<head>
    <title>CRC_MIMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @vite('resources/css/app.css')
    @stack("CSS")
</head>

<body>
    <div class="flex h-screen">
        @include('dashboard.partials.sidebar')
        <div id="body" class=" transition-transform flex flex-col flex-1 overflow-y-auto bg-[#F1F5F9]">
            <div class="flex items-center justify-between bg-red-600 border-b border-gray-200 px-4 p-3">
                <button id="openSidebar" class="text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class=" w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="flex items-center flex-1 mx-4">
                    <input class="border rounded-md h-10 w-1/3 p-2" type="text" placeholder="Search">
                </div>

                <div class="flex items-center pr-4 text-gray-200">
                    <button class="text-wrap rounded-md p-2 text-black bg-gray-200 hover:bg-gray-300">
                        Add new
                    </button>
                </div>

                <button class="w-10 flex items-center  pr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path fill="#ffffff"
                            d="M224 0c-17.7 0-32 14.3-32 32l0 19.2C119 66 64 130.6 64 208l0 18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416l384 0c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8l0-18.8c0-77.4-55-142-128-156.8L256 32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z" />
                    </svg>
                </button>

                <div class="flex items-center pr-4">
                    <button
                        class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                        <img class="inline-block size-[38px] rounded-full"
                            src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=300&h=300&q=80"
                            alt="Avatar">
                    </button>
                </div>
            </div>