@extends('layouts.templates.att.master')
@push('CSS')
@endpush
<?php 
?>
@section('Content')
<div class="bg-[#fff] rounded-lg max-w-1000px m-5 p-5 shadow-md font-battambang">
    <h1 class="text-2xl font-medium text-center font-koulen text-blue-600">
        {{ $title }}
    </h1>
    <div class="mt-14">
        <div id="loadingSpinner"
            class="fixed top-0 left-0 z-50 w-screen h-screen bg-gray-300 bg-opacity-50 h-full hidden">
            <p id="textload" class="hidden textload text-center font-siemreap">សូមរងចាំ...</p>
            <p id="textsucc" class="hidden textload text-center font-siemreap">បញ្ចូលជោគជ័យ</p>
            <div id="spinner" class="spinner hidden"></div>
            <div id="tick" class="hidden text-center text-green-500 text-6xl">✔</div>
            <div class="flex justify-center items-center mt-2">
                <button id="ok" class="hidden w-32 text-center bg-green-500 text-white px-4 py-2 rounded">OK</button>
            </div>
        </div>
        <div id="SheetSelectAlert"
            class="fixed top-0 left-0 z-50 w-screen h-screen bg-gray-300 bg-opacity-50 h-full hidden">
            <p id="textsuccAlert" class="hidden textload text-center font-siemreap">សូមជ្រើសរើសទិន្នន័យ</p>
            <div id="tickAlert" class="hidden text-center text-green-500 text-6xl">!</div>
            <div class="flex justify-center items-center mt-2">
                <button id="okAlert"
                    class="hidden w-32 text-center bg-green-500 text-white px-4 py-2 rounded">OK</button>
            </div>
        </div>
        <div id="SheetSelectAlertIfAlready"
            class="fixed top-0 left-0 z-50 w-screen h-screen bg-gray-300 bg-opacity-50 h-full hidden">
            <p id="textsuccAlertIfAlready" class="hidden textload text-center font-siemreap">
                ទិន្នន័យនេះត្រូវបានបញ្ចូលរួចរាល់សូមជ្រើសរើសទិន្នន័យផ្សេងទៀត</p>
            <div id="tickAlertIfAlready" class="hidden text-center text-green-500 text-6xl">!</div>
            <div class="flex justify-center items-center mt-2">
                <button id="okAlertIfAlready"
                    class="hidden w-32 text-center bg-green-500 text-white px-4 py-2 rounded">OK</button>
            </div>
        </div>
        <div class="flex flex-row gap-4">
            <!-- First Select Option -->
            <div class="flex-1">
                <label for="branch_name"
                    class="font-semibold font-siemreap block text-lg font-medium text-gray-700 mb-1">ខេត្ត/រាជធានី</label>
                @if (auth()->user()->hasRole('admin'))
                    <select id="branch_name"
                        class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">--------------------------------</option>
                    </select>
                @else
                    <input
                        class=" w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 "
                        type="text" disabled id="branch_name">
                @endif
            </div>
            <div class="flex-1">
                <label for="district-select"
                    class="font-semibold font-siemreap block text-lg font-medium text-gray-700 mb-1">ស្រុក/ខណ្ឌ</label>
                <select id="district-select"
                    class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">--------------------------------</option>
                </select>
            </div>

            <div class="flex-1">
                <label for="school-select"
                    class="font-semibold font-siemreap block text-lg font-medium text-gray-700 mb-1">វិទ្យាល័យ/សាកលវិទ្យាល័យ</label>
                <select id="school-select"
                    class="w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">--------------------------------</option>
                </select>
            </div>
        </div>
    </div>

    <div id="import-section" class="hidden mt-5">
        @include('dataimport.partials.sheetselector')
        <div class="flex items-center justify-center w-full">
            <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400 font-siemreap"><span
                            class="font-semibold font-siemreap">ចុចដើម្បីបញ្ចូល</span>
                        ឬ ទាញនឹងទម្លាក់</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">xlsx, xls</p>
                </div>
                <input id="dropzone-file" type="file" class="hidden" />
            </label>
        </div>
    </div>
</div>
@endsection

@push('JS')
    @vite(['resources/js/import.js'])
@endpush