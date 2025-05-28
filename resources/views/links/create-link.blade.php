@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <div class="p-4 bg-gray-100 font-battambang my-3">
        <div class="p-4 bg-white shadow-md rounded-lg">
            <div class="grid grid-cols-6 ">
                <div class="col-span-5 flex flex-col items-center justify-center mb-10 ml-44">
                    <h1 class="mb-1 text-[18px] font-khmer mt-9">បង្កើត <span class="font-battambang">Link</span></h1>
                </div>
            </div>

            @csrf
            <div class="flex flex-wrap -mx-3 mt-3 mb-6">
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700  mb-2">
                        ឆ្នាំសិក្សា
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        type="text" required>
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700  mb-2">
                        ថ្ងៃចាប់ផ្តើមទទួលពាក្យ
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        type="text" required>
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700  mb-2">
                        ថ្ងៃឈប់ទទួលពាក្យ
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        type="text" required>
                </div>
            </div>
            <div class="flex justify-center">
                <button id="create-link" class="bg-green-500 text-white px-10 py-2 rounded font-battambang">បង្កើត
                </button>
            </div>
            <div class="grid grid-cols-3 hidden" id="link-generate">
                <div class="w-full col-span-2 px-3">
                    <div
                        class="mt-10 pl-5 appearance-none block w-full text-sm bg-gray-200 text-gray-700 border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white">
                        aaaaaaaaaaaa
                    </div>
                </div>
                <div class="w-full">
                    <button class="bg-gray-500 text-white px-7 mt-10 py-2 rounded font-battambang">Copy</button>
                </div>
                <div class="mt-7 ml-4">
                    <a href="{{ route('link-member') }}"
                        class="bg-gray-500 text-white px-7 py-2 rounded font-battambang">Back</a>
                </div>
            </div>
        </div>
@endsection
    @push('JS')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.getElementById('create-link').addEventListener('click', function (e) {
                    e.preventDefault();
                    document.getElementById('link-generate').classList.remove('hidden');
                })
            })
        </script>
    @endpush