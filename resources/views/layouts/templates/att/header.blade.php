<!DOCTYPE html>
<html lang="en">

<head>
    <title>CRC_MIMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/handlemodal.js') }}"></script>

    <!-- Correct usage of @vite -->
    @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/css/style.css'])

    @stack('CSS')
</head>

<body>
    <div id="loading-overlay">
        <div class="loading-spinner"></div>
    </div>
    <div class="flex h-screen">
        @include('dashboard.partials.sidebar')
        <div id="body" class="transition-transform flex flex-col flex-1 overflow-y-auto bg-[#F1F5F9]">
            <div class="flex items-center justify-between h-16 bg-cover bg-center bg-no-repeat border-b border-gray-200 px-4 py-1"
                style="background-image: url('{{ asset('images/FoC.png') }}');">
                <button id="openSidebar" class="text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="flex items-center flex-1 mx-4">
                    @if (auth()->user()->hasRole('admin'))
                        <h1 class="text-white text-lg font-koulen">ទីស្នាក់ការកណ្តាល</h1>
                    @else
                        <h1 class="text-white text-lg font-koulen">សាខាថ្នាក់កណ្តាល:
                            {{ auth()->user()->branch_bindding_user[0]->branch->branch_kh }}</h1>
                    @endif
                </div>

                <div class="flex items-center pr-4">
                    <button id="dropdownToggle"
                        class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                        <img class="inline-block size-[38px] rounded-full" src="{{ auth()->user()->image ?? '' }}"
                            alt="Avatar">
                    </button>
                </div>
            </div>

            @include('dashboard.partials.user')
            @include('dashboard.partials.user.profile.profile_modal')
