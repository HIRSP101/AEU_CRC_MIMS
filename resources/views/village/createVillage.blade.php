@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    @php
    
    @endphp
    <div class="bg-[#fff] p-2 rounded-lg max-w-1000px m-5 shadow-md font-siemreap">

        <div class="grid grid-cols-7 ">
            <div class=" text-2xl col-span-6 flex flex-col items-center justify-center mb-10 ml-24">
                <h1>បង្កើតស្រុក ភូមិ</h1>
            </div>
            <div class="">
                <img class="image w-28 h-32 bg-red-300" src="" alt="">
            </div>
        </div>
        <div class="mt-5">
            <form action="{{ route('village.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="container">
                    <div class="flex mb-6 mx-3">
                        <div class="block w-1/2 mb-6 md:mb-0 px-3">
                            <label class="md:w-full block uppercase tracking-wide text-gray-700 mb-2" for="branchName">
                                <h1>
                                    ឈ្មោះស្រុក ភូមិ
                                </h1>
                            </label>
                            <input
                                class="appearance-none md:w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                name="branchName" id="branchName" type="text">
                        </div>
                    </div>
                    <hr>
                    <h1 class="m-5">
                        ថ្ងៃខែឆ្នាំ​ចូល និងបង្កើត
                    </h1>
                    <div class="flex mx-3 mt-3 mb-6">
                        <div class="w-1/3 block px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="createDate">
                                ថ្ងៃខែឆ្នាំបង្កើត
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="createDate" id="createDate" type="date">
                        </div>
                        <div class="w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="recruitementDate">
                                ថ្ងៃខែឆ្នាំចូល
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="recruitementDate" id="recruitementDate" type="date">
                        </div>
                        <div class="w-1/3 px-3 flex mt-6">
                            <div class="w-1/2">
                                <button
                                    class="w-full border-solid m-2 border-2 bg-green-500 p-2 rounded-md hover:bg-green-600 active:bg-green-700 focus:outline-none focus:ring focus:ring-green-300"
                                    type="submit" id="submit_btn">យល់ព្រម
                                </button>
                            </div>
                            <div class="w-1/2">
                                <button
                                    class="w-full border-solid m-2 border-2 bg-red-500 p-2 rounded-md hover:bg-red-600 active:bg-red-700 focus:outline-none focus:ring focus:ring-red-300"
                                    type="button" id="clear_btn">លុប
                                </button>
                            </div>
                        </div>

                    </div>
            </form>

        </div>
    </div>
@endsection

@push('JS')
    <script type="module">
        import {
            handleBranchform
        } from "{{ asset('js/handleBranchform.js') }}";
        document.addEventListener('DOMContentLoaded', function() {
            var array = @json($bhei_col);

            array.forEach(item => {
                item.full_address =
                    `${item.village} ${item.commune_sangkat} ${item.district_khan} ${item.provience_city}`;
            });

            console.log(array);
            handleBranchform(array);
        });
    </script>
@endpush
