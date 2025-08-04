@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
@if(count($total_mem) > 0)
    <div class="bg-white m-5 shadow-lg rounded-lg">
        <h1 class="text-center mt-7 font-siemreap my-2 font-bold text-2xl"> បញ្ជីរាយនាមសមាជិកចុះឈ្មោះថ្មី ក្នុងឆ្នាំសិក្សា
            {{$total_mem[0]->academic_year}} 
            @if (!$approved)
            (បណ្តោះអាសន្ន)
            @endif
        </h1>

        <div class="flex justify-between items-center mb-4 mt-14 px-4">
            <!-- Search Bar -->
            <div class="tab_filter_container flex items-center space-x-2">
                <input type="text" id="tab_filter_text" class="border border-gray-300 px-2 py-2 rounded"
                    placeholder="Search...">
                <button id="tab_filter_btn" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
            </div>

            <!-- Buttons Group -->
            <div class="flex items-center space-x-3">
                <div class="tab_head_container flex items-center space-x-4">
                    <div class="page_limit flex items-center space-x-2">
                        <span class="font-siemreap text-sm">បង្ហាញ</span>
                        <select id="table_size"
                            class="text-gray-700 bg-gray-300 py-2 px-2 rounded w-20 font-siemreap text-sm">
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                        </select>
                    </div>

                    <div class="gender_sort flex items-center space-x-2">
                        <span class="font-siemreap text-sm">ភេទ</span>
                        <select id="gender_filter"
                            class="text-gray-700 bg-gray-300 py-2 px-2 rounded w-28 font-siemreap text-sm">
                            <option value="all">ទាំងអស់</option>
                            <option value="ស្រី">ស្រី</option>
                            <option value="ប្រុស">ប្រុស</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full overflow-scroll mx-3 my-3 max-h-[760px]">
            <div class="w-full overflow-scroll my-3 max-h-[760px] table">
                <table class="min-w-max w-full table-auto font-siemreap" id="dataTable">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 pl-5 text-left">
                                ល.រ
                            </th>
                            <th class="py-3 text-center">
                                គោត្តមនាម-នាម
                            </th>
                            <th class="py-3 text-center">
                                ភេទ
                            </th>
                            <th class="py-3 text-center">
                                ថ្ងៃខែឆ្នាំកំណើត
                            </th>
                            <th class="py-3 text-center">
                                គ្រឹះស្ថានសិក្សា
                            </th>

                            <th class="py-3 text-center">
                                តួនាទី
                            </th>

                            <th class="py-3 text-center">
                                កម្រិតសិក្សា
                            </th>

                            <th class="py-3 text-center">
                                ថ្ងៃចុះឈ្មោះ
                            </th>

                            <th class="py-3 text-center">
                                action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">

                    </tbody>
                </table>
                @if (!$approved)
                    <div class="text-end mt-7">
                        <button id="btn_ok" class="bg-blue-500 text-white px-4 py-2 rounded font-battambang">យល់ព្រម</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
@else
    <div class="flex flex-col items-center justify-center h-screen space-y-4">
        <img src="../images/not.png" alt="No Data" width="150" height="150">
        <p class="font-siemreap">មិនមានទិន្នន័យគ្រប់គ្រង</p>
    </div>
@endif

@endsection
@push('JS')
    <script type="module">
        import { totalmemlinkcontroll } from "{{ asset('js/totalmemlinkcontroll.js') }}";
        document.addEventListener('DOMContentLoaded', function () {
            var array = @json($total_mem);
            totalmemlinkcontroll(array);
        });
    </script>
@endpush