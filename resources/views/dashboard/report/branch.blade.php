@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')

<div class="p-4">
    <div class="p-4 shadow-md rounded-lg bg-white">
        <h1 class="text-center text-gray-800 font-moul">សាខា</h1>
        <hr>
       
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5 h-[33rem] no-scrollbar">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-battambang text-sm">
                            ឈ្មោះ ខេត្ត
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                            <div class="ps-3">
                                <a href="{{ route('list-of-name') }}" class="text-base font-battambang font-normal">ខេត្ត កំពង់ស្ពឺ</a>
                            </div>  
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-battambang font-normal">ខេត្ត កំពង់ស្ពឺ</div>
                            </div>  
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-battambang font-normal">ខេត្ត កំពង់ស្ពឺ</div>
                            </div>  
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-battambang font-normal">ខេត្ត កំពង់ស្ពឺ</div>
                            </div>  
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-battambang font-normal">ខេត្ត កំពង់ស្ពឺ</div>
                            </div>  
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-battambang font-normal">ខេត្ត កំពង់ស្ពឺ</div>
                            </div>  
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-battambang font-normal">ខេត្ត កំពង់ស្ពឺ</div>
                            </div>  
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-battambang font-normal">ខេត្ត កំពង់ស្ពឺ</div>
                            </div>  
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>

</div>

@endsection

@push('JS')
@endpush
