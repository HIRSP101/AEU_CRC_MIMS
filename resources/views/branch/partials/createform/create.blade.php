@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    @php

    @endphp
    <div class="bg-[#fff] p-2 rounded-lg max-w-1000px m-5 shadow-md font-siemreap">

        <div class="grid grid-cols-7 ">
            <div class=" text-2xl col-span-6 flex flex-col items-center justify-center mb-10 ml-24">
                <h1>បង្កើតសាខា</h1>
            </div>
            <div class="">
                <img class="image w-28 h-32 bg-red-300" src="" alt="">
            </div>
        </div>
        <div class="mt-5">
            <form action="{{ route('branch.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="container">
                    <div class="flex mb-6 mx-3">
                        <div class="block w-1/2 mb-6 md:mb-0 px-3">
                            <label class="md:w-full block uppercase tracking-wide text-gray-700 mb-2" for="branchName">
                                <h1>
                                    ឈ្មោះសាខា
                                </h1>
                            </label>
                            <input
                                class="appearance-none md:w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                name="branchName" id="branchName" type="text">
                        </div>
                        <div class="block  md:w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="typOfBranch">
                                ប្រភេទស្ថាប័ន
                            </label>
                            <select name="typeofBranch" id="typOfBranch"
                                class="w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 ">
                                <option value="">---</option>
                                <option value="សាធារណះ">សាធារណះ</option>
                                <option value="ឯកជន">ឯកជន</option>
                            </select>
                        </div>
                        <div class="w-1/3 px-3 block">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="branchLevel">
                                កម្រិត
                            </label>
                            <select name="branchLevel" id="branchLevel"
                                class="w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 ">
                                <option value="">---</option>
                                <option value="សាកលវិទ្យាល័យ">សាកលវិទ្យាល័យ</option>
                            </select>
                        </div>
                        <div class="w-1/2 px-3 block">
                            <label class="block uppercase tracking-wide text-gray-700" for="image">
                                រូបភាព
                            </label>
                            <input
                                class="appearance-none w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="image" type="file" select="image/*" id="image">
                        </div>
                    </div>
                    <hr>
                    <h1 class="m-5">
                        ទីតាំងរបស់សាខា ឬអនុសាខា
                    </h1>
                    <div class="flex mx-3 mt-3 mb-6">
                        <div class="w-1/4 block px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="village">
                                ភូមិ
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="village" id="village" type="text">
                        </div>
                        <div class="w-1/4 px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="district">
                                ឃុំ
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="district" id="district" type="text">
                        </div>
                        <div class="w-1/4 block px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="communceOrKhan">
                                ស្រុក/ខណ្ឌ
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="communceOrKhan" id="communceOrKhan" type="text">
                        </div>
                        <div class="w-1/4 px-3">
                            <label class="block uppercase tracking-wide text-gray-700  mb-2" for="provinceOrCity">
                                ក្រុង/ខេត្ត
                            </label>
                            <select name="provinceOrCity" id="provinceOrCity"
                                class="w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 ">
                                <option value="">---</option>
                                @foreach ($total_mem_branches as $branch)
                                    <option value="{{ $branch->branch_kh }} {{ $branch->branch_id }}">
                                        {{ $branch->branch_kh }}</option>
                                @endforeach

                            </select>
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
            <hr class="border border-1 m-5">
            <h1 class="text-center text-2xl">
                តារាងសាខា​
            </h1>
            <div class="w-full overflow-scroll mx-3 my-3 max-h-[760px]">
                <div class="w-full overflow-scroll my-3 max-h-[760px] table">
                    <table class="min-w-full border-collapse border-1 border-slate-400 ">
                        <thead class=" font-siemreap bg-slate-200 border-collapse border-t-2 border-black">
                            <tr>
                                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                                    ល.រ
                                </th>
                                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                                    ឈ្មោះសាខា
                                </th>
                                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                                    ប្រភេទ
                                </th>
                                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                                    គ្រឹះស្ថានសិក្សា
                                </th>
                                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                                    ទីតាំង
                                </th>
                                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                                    ថ្ងៃខែឆ្នាំបង្កើត
                                </th>
                                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                                    ថ្ងៃខែឆ្នាំចូល
                                </th>
                                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                                    រូបភាព
                                </th>
                                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

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
