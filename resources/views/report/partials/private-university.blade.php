@extends('layouts.templates.att.master')
@push('CSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('Content')
    <?php
    $i = 0;
        ?>
    <div class="bg-white mt-2 mx-2 px-3 shadow-lg h-max-full rounded-lg">
        <h1 class="text-center font-khmer my-2 text-lg text-blue-800 mt-5">តារាងទិន្នន័យគ្រឹះស្ថានសិក្សា
            ទីប្រឹក្សាយុវជន នឹងយុវជន</h1>
        <h1 class="text-center font-khmer my-2 text-lg text-blue-800">នៃកាកបាទក្រហមកម្ពុជា ប្រចាំគ្រឹះស្ថានឧត្តមសិក្សា​​ (ឯកជន)</h1>
        <h2 class="text-center font-khmer mb-2 text-lg text-blue-800">បច្ចុប្បន្នភាពឆ្នាំ២០២៤</h2>
        <div class="flex justify-between items-center mt-5">
            <div>
                <button id="export_excel" class="bg-[#31bf7d] text-white px-4 py-2 rounded">Export Excel</button>
            </div>
            <div class="flex justify-end items-center">
                <input id="datepicker" class="border-2 border-gray-400 rounded-md px-3 py-2 w-64" type="text"
                    placeholder="Filter by date">
            </div>
        </div>
        <div class="w-full overflow-scroll my-3 max-h-[760px] table">

            <div class="w-full mb-5">
                <table class="table-auto border-collapse border border-gray-700 w-full text-center text-sm">
                    <!-- Table Header -->
                    <thead>
                        <tr class="bg-gray-100">
                            <th rowspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">ល.រ</th>
                            <th rowspan="2" colspan="4" class="border border-gray-700 p-2 font-semibold font-battambang">
                                គ្រឹះស្ថានឧត្តមសិក្សា</th>
                            <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">
                                បច្ចុប្បន្នភាពទីប្រឹក្សា</th>
                            <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">
                                បច្ចុប្បន្នភាពយុវជន</th>
                        </tr>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-700 p-2 font-semibold font-battambang">សរុប</th>
                            <th class="border border-gray-700 p-2 font-semibold font-battambang">ស្រី</th>
                            <th class="border border-gray-700 p-2 font-semibold font-battambang">សរុប</th>
                            <th class="border border-gray-700 p-2 font-semibold font-battambang">ស្រី</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        <!-- Row 1 -->
                        @foreach ($branchhei_private as $brreport)
                            @php

                                $i++;
                            @endphp
                            <tr>
                                <td class="border border-gray-700 font-normal font-battambang p-2">{{$i}}</td>
                                <td colspan="4" class="border border-gray-700 font-normal font-battambang p-2">
                                    {{$brreport->institute_kh}}
                                </td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">
                                    {{ $brreport->total_mem_advisor }}
                                </td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">
                                    {{$brreport->total_mem_fem_advisor}}
                                </td>
                                </td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">{{$brreport->total_mem}}</td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">{{$brreport->total_mem_fem}}
                                </td>
                                </td>
                            </tr>

                        @endforeach
                        <!-- Summary Row -->
                        <tr class="bg-gray-100">
                            <td colspan="5" class="border border-gray-700 p-2 font-semibold font-battambang">សរុប</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">
                                {{ $branchWhole->total_mem_advisor}}
                            </td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">
                                {{ $branchWhole->total_mem_fem_advisor}}</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">
                                {{ $branchWhole->total_mem}}
                            </td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">
                                {{ $branchWhole->total_mem_fem}}</td>
                        </tr>

                    </tbody>
                </table>
                <p class="font-battambang font-medium text-center mt-2">រៀបចំដោយ៖ ការិយាល័យអភិវឌ្ឍន៍ នៃនាយកដ្ឋានធនធានមនុស្ស
                    កក្រក</p>
            </div>
        </div>
    </div>
@endsection

    @push('JS')
        @vite(['resources/js/exportToExcel_branch.js'])
        <script type="module">
            var data = @json($branchhei_private);
            console.log(data);
            $("#export_excel").on("click", async () => {
                exportToExcel_branch(data);
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            flatpickr("#datepicker", {
                mode: "range",
                dateFormat: "d-F-Y",
                locale: {
                    months: {
                        shorthand: [
                            "មក", "កុ", "មី", "មេ", "ឧស", "មិ",
                            "កក", "សី", "កញ", "តុ", "វិ", "ធ"
                        ],
                        longhand: [
                            "មករា",
                            "កុម្ភៈ",
                            "មីនា",
                            "មេសា",
                            "ឧសភា",
                            "មិថុនា",
                            "កក្កដា",
                            "សីហា",
                            "កញ្ញា",
                            "តុលា",
                            "វិច្ឆិកា",
                            "ធ្នូ"
                        ]
                    }
                }
            });
        </script>
    @endpush