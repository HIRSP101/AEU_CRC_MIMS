@extends('layouts.templates.att.master')
@push('CSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('Content')
<?php
$i = 0;
$userBranchId = \App\Models\branch_bindding_user::where('user_id', auth()->id())->value('branch_id');
$branchName = \App\Models\branch::where('branch_id', $userBranchId)->value('branch_kh');
    ?>
<div class="bg-white m-5 p-5 shadow-lg h-max-full rounded-lg">
    @if(auth()->user()->hasRole('user'))
        <h1 class="text-center font-koulen my-2 text-2xl text-blue-600">តារាងទិន្នន័យគ្រឹះស្ថានសិក្សា
            ទីប្រឹក្សាយុវជន និងយុវជន</h1>
        <h1 class="text-center font-koulen my-2 text-2xl text-blue-600">នៃកាកបាទក្រហមកម្ពុជា​ ប្រចាំ​​ {{ $branchName }}
        </h1>
    @else
        <h1 class="text-center font-koulen my-2 text-2xl text-blue-600">តារាងទិន្នន័យគ្រឹះស្ថានសិក្សា
            ទីប្រឹក្សាយុវជន និងយុវជន</h1>
        <h1 class="text-center font-koulen my-2 text-2xl text-blue-600">នៃកាកបាទក្រហមកម្ពុជា​ ប្រចាំ​​សាខានីមួយៗ</h1>
    @endif
    <h2 class="text-center font-koulen mb-2 text-2xl text-blue-600">បច្ចុប្បន្នភាពឆ្នាំ {{ $selectedYear }}</h2>
    <div class="flex justify-between items-center mt-5">
        @canany(['3', '2'])
            <div>
                <button id="export_excel" class="bg-[#31bf7d] text-white px-4 py-2 rounded">Export Excel</button>
            </div>
        @endcanany
        <div class="filter_date flex items-center space-x-2">
            <span class="font-siemreap text-sm">ឆ្នាំ</span>
            <input id="dateRange" class="border-2 border-gray-400 rounded-md px-3 py-2 w-54" type="text"
                placeholder="Select a date">
        </div>
    </div>

    <div class="w-full my-3 table">

        <div class="w-full mb-5">
            <table class="table-auto border-collapse border border-gray-700 w-full text-center text-sm">
                <!-- Table Header -->
                <thead>
                    <tr class="bg-gray-100">
                        <th rowspan="3" class="border border-gray-700 p-2 font-semibold font-battambang">ល.រ</th>
                        <th rowspan="3" class="border border-gray-700 p-2 font-semibold font-battambang">ក្រុង/ស្រុក
                        </th>
                        <th rowspan="3" class="border border-gray-700 p-2 font-semibold font-battambang">
                            ចំនួនគ្រឹះស្ថានសិក្សា</th>
                        <th rowspan="3" class="border border-gray-700 p-2 font-semibold font-battambang">
                            ឈ្មោះគ្រឹះស្ថានសិក្សា</th>
                        <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">មានបណ្ដាញ</th>
                        <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">យុវជន</th>
                        <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">ពិការភាព</th>
                        <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">ទីប្រឹក្សា</th>
                        <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">ពិការភាព</th>
                        <th rowspan="2" colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">
                            ចំនួនយុវជនទទួលវគ្គ បណ្ដុះបណ្ដាល មូលដ្ឋាន</th>
                        <th rowspan="2" colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">
                            ចំនួនយុវជនបានទទួល ឯកសណ្ឋាន</th>
                    </tr>
                    <tr class="bg-gray-100">
                        <th colspan="2" class="border border-gray-700 font-semibold p-2 font-battambang">យុវជន កក្រក
                        </th>
                        <th class="border border-gray-700 p-2 font-semibold font-battambang">សរុប</th>
                        <th class="border border-gray-700 p-2 font-semibold font-battambang">ស្រី</th>
                        <th class="border border-gray-700 p-2 font-semibold font-battambang">សរុប</th>
                        <th class="border border-gray-700 p-2 font-semibold font-battambang">ស្រី</th>
                        <th class="border border-gray-700 p-2 font-semibold font-battambang">សរុប</th>
                        <th class="border border-gray-700 p-2 font-semibold font-battambang">ស្រី</th>
                        <th class="border border-gray-700 p-2 font-semibold font-battambang">សរុប</th>
                        <th class="border border-gray-700 p-2 font-semibold font-battambang">ស្រី</th>
                    </tr>
                    <tr>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">មាន</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">អត់</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">
                            {{ $branchWhole->total_mem ?? '0'}}</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">
                            {{ $branchWhole->total_mem_fem ?? '0'}}</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">0</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">0</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">
                            {{ $branchWhole->total_mem_advisor ?? '0'}}</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">
                            {{ $branchWhole->total_mem_fem_advisor ?? '0'}}</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">0</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">0</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">ស្រីសរុប</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">ប្រុស</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">ស្រីសរុប</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">ប្រុស</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @php
                        // $i = 1;
                        // $serialNumber = 1;
                        // $totalInstitude = 0;
                        $grouped = $district->groupBy('district_id');
                        $i = 1;
                    @endphp

                    {{-- @foreach ($groupedReports as $branch_kh => $reports)
                    @php
                    $rowSpan = count($reports);
                    @endphp --}}

                    @foreach ($grouped as $districtId => $schools)
                        @php 
                            $rowSpan = $schools->count(); 
                        @endphp

                        {{-- @foreach ($reports as $index => $brreport) --}}
                        @foreach ($schools as $index => $school)
                            <tr>
                                @if ($index === 0)
                                    {{-- <td class="border border-gray-700 font-normal font-battambang p-2"
                                        rowspan="{{ $rowSpan }}">{{ $i++ }}</td>
                                    <td class="border border-gray-700 font-normal font-battambang p-2" rowspan="{{ $rowSpan }}">{{
                                        $branch_kh }}</td>
                                    <td class="border border-gray-700 font-normal font-battambang p-2" rowspan="{{ $rowSpan }}">{{
                                        $rowSpan }}</td> --}}
                                    <td rowspan="{{ $rowSpan }}" class="border border-gray-700 font-normal font-battambang p-2">
                                        {{ $i++ }}</td>
                                    <td rowspan="{{ $rowSpan }}" class="border border-gray-700 font-normal font-battambang p-2">
                                        {{ $school->district_name }}</td>
                                    <td rowspan="{{ $rowSpan }}" class="border border-gray-700 font-normal font-battambang p-2">
                                        {{ $rowSpan }}</td>
                                @endif

                                {{-- Display institute_kh under "Phnom Penh" column if branch_id = 1 --}}
                                {{-- @if ($brreport->branch_id == 1) --}}
                                <td class="border border-gray-700 font-normal font-battambang p-2">
                                    {{ $school->school_name ?? '-' }}
                                </td>
                                {{-- @else --}}
                                {{-- <td class="border border-gray-700 font-normal font-battambang p-2">-</td> --}}
                                {{-- @endif --}}

                                {{-- Other columns --}}
                                <td class="border border-gray-700 font-normal font-battambang p-2">-</td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">-</td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">
                                    {{ $school->total_mem ?? '0' }}
                                </td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">
                                    {{ $school->total_mem_fem ?? '0' }}</td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">0</td>

                                <td class="border border-gray-700 font-normal font-battambang p-2">
                                    {{ $school->total_mem_advisor ?? '0' }}
                                </td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">
                                    {{ $school->total_mem_fem_advisor ?? '0' }}</td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                                <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            </tr>
                        @endforeach
                    @endforeach

                    <tr class="bg-gray-100">
                        <td colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">សរុប</td>
                        <td class="border border-gray-700 font-battambang p-2 font-semibold">
                            {{ $branchWhole->total_schools }}
                        </td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">
                            {{ $branchWhole->total_mem ?? 0 }}</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">
                            {{ $branchWhole->total_mem_fem ?? 0 }}</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">
                            {{ $branchWhole->total_mem_advisor ?? 0 }}</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">
                            {{ $branchWhole->total_mem_fem_advisor ?? 0 }}</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                    </tr>
                </tbody>

            </table>
            <p class="font-battambang font-medium text-center mt-2">រៀបចំដោយ៖ ការិយាល័យអភិវឌ្ឍន៍ នៃនាយកដ្ឋានធនធានមនុស្ស
                កក្រក</p>
        </div>

    </div>
    @endsection
    {{-- var data = @json($reports); --}}
    @push('JS')
        @vite(['resources/js/exportToExcelOptionTwo.js'])
        <script type="module">
            var data = @json($district);
            console.log(data);

            $("#export_excel").on("click", async () => {
                exportToExcelOptionTwo(data);
            });
            $("#dateRange").flatpickr({
                mode: "range",
                dateFormat: "Y-m-d",
                onClose: function (selectedDates, dateStr) {
                    if (selectedDates.length === 2) {
                        const startDate = selectedDates[0].toISOString().split('T')[0];
                        const endDate = selectedDates[1].toISOString().split('T')[0];
                        const url = new URL(window.location.href);
                        url.searchParams.set('start_date', startDate);
                        url.searchParams.set('end_date', endDate);
                        window.location.href = url.toString();
                    }
                },
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        {{--
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
        </script> --}}
    @endpush