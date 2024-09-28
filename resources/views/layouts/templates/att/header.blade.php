<!DOCTYPE html>
<html lang="en">

<head>
    <title>CRC_MIMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/handlemodal.js') }}"></script>
    @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/css/style.css', 'public/js/script.js'])
    @stack("CSS")
</head>

<body>
    <div id="loading-overlay">
        <div class="loading-spinner"></div>
    </div>
    <div class="flex h-screen">
        @include('dashboard.partials.sidebar')
        <div id="body" class="transition-transform flex flex-col flex-1 overflow-y-auto bg-[#F1F5F9]">
            <div class="flex items-center justify-between h-16 bg-red-600 border-b border-gray-200 px-4 py-1">
                <button id="openSidebar" class="text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="flex items-center flex-1 mx-4">
                    @if(auth()->user()->hasRole('admin'))
                        <h1 class="text-white text-lg font-koulen">ទីស្នាក់ការកណ្តាល</h1>
                    @else
                        <h1 class="text-white text-lg font-koulen">សាខាថ្នាក់កណ្តាល:
                            {{auth()->user()->branch[0]->branch_kh}}
                        </h1>
                    @endif
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
                    <button id="dropdownToggle"
                        class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                        <img class="inline-block size-[38px] rounded-full" src="{{ auth()->user()->image ?? "" }}"
                            alt="Avatar">
                    </button>
                </div>
            </div>
            @include('dashboard.partials.user')
            @include('dashboard.partials.user.profile.profile_modal')