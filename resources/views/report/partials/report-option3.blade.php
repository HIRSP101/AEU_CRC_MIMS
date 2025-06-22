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
        <h1 class="text-center font-khmer my-2 text-lg text-blue-800">នៃកាកបាទក្រហមកម្ពុជា ២៥ រាជធានី/ខេត្ត និងគ្រឹះស្ថានឧត្តមសិក្សា</h1>
        <h2 class="text-center font-khmer mb-2 text-lg text-blue-800">បច្ចុប្បន្នភាពឆ្នាំ២០២៤</h2>
        <div class="flex justify-between items-center mt-5">
            <div>
                <button id="export_excel" class="bg-[#31bf7d] text-white px-4 py-2 rounded">Export Excel</button>
            </div>
            <div class="flex justify-end items-center">
                <input id="datepicker" class="border-2 border-gray-400 rounded-xl px-3 py-2 w-64" type="text"
                    placeholder="Filter by date">
            </div>
        </div>

        <div class="w-full my-3 table">

            <div class="w-full mb-5">
                <table class="table-auto border-collapse border border-gray-700 w-full text-center text-sm">
                    <!-- Table Header -->
                    <thead>
                        <tr class="bg-gray-100">
                            <th rowspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">ល.រ</th>
                            <th rowspan="2" colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">សាខា កក្រក</th>
                            
                            <th colspan="4" class="border border-gray-700 p-2 font-semibold font-battambang">បណ្ដាញយុវជនគ្រឹះស្ថានសិក្សា ២០២៥</th>
                            <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">ទីប្រឹក្សា ២០២៥</th>
                            <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">យុវជន ២០២៥</th>
                        </tr>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-700 p-2 font-semibold font-battambang">សរុប</th>
                            <th class="border border-gray-700 p-2 font-semibold font-battambang">អនុ.វិ</th>
                            <th class="border border-gray-700 p-2 font-semibold font-battambang">វិទ្យាល័យ</th>
                            <th class="border border-gray-700 p-2 font-semibold font-battambang">ឧត្តមសិក្សា</th>
                            <th class="border border-gray-700 p-2 font-semibold font-battambang">សរុប</th>
                            <th class="border border-gray-700 p-2 font-semibold font-battambang">ស្រី</th>
                            <th class="border border-gray-700 p-2 font-semibold font-battambang">សរុប</th>
                            <th class="border border-gray-700 p-2 font-semibold font-battambang">ស្រី</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @php
                            $grouped = $branch_and_count_member->groupBy('branch_id');
                            $i = 1;
                        @endphp

                        @foreach ($grouped as $branchId => $schools)
                            @php 
                                $rowSpan = $schools->count(); 
                            @endphp

                            @foreach ($schools as $index => $school)
                                <tr>
                                    @if ($index === 0)
                                    <td rowspan="{{ $rowSpan }}" class="border border-gray-700 font-normal font-battambang p-2">{{ $i++ }}</td>
                                    
                                    @endif

                                    <td colspan="2" class="border border-gray-700 font-normal font-battambang p-2">{{ $school->branch_kh }}</td>

                                    @php
                                        $schoolTypes = $school_types_per_branch[$school->branch_id] ?? null;
                                        $universities = $universities_per_branch[$school->branch_id]->total_university ?? 0;

                                        $secondary = $schoolTypes->total_secondary_school ?? 0;
                                        $high = $schoolTypes->total_high_school ?? 0;
                                    @endphp
                                    <td class="border border-gray-700 font-normal font-battambang p-2">{{ $secondary + $high + $universities }}</td>
                                    <td class="border border-gray-700 font-normal font-battambang p-2">{{ $secondary }}</td>
                                    <td class="border border-gray-700 font-normal font-battambang p-2">{{ $high }}</td>
                                    <td class="border border-gray-700 font-normal font-battambang p-2">{{ $universities }}</td>

                                    <td class="border border-gray-700 font-normal font-battambang p-2">{{ $school->total_mem_advisor }}</td>
                                    <td class="border border-gray-700 font-normal font-battambang p-2">{{ $school->total_mem_fem_advisor }}</td>

                                    <td class="border border-gray-700 font-normal font-battambang p-2">{{ $school->total_mem }}</td>
                                    <td class="border border-gray-700 font-normal font-battambang p-2">{{ $school->total_mem_fem }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                        
                        <tr>
                            <td colspan="2" class="border border-gray-700 p-2 font-battambang">26</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">គ្រឹះស្ថានឧត្តមសិក្សា</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2"> {{ $universities_per_branch->sum('total_university') }}</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">{{ $total_member_all_university->sum('total_mem_advisor')}}</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2"> {{ $total_member_all_university->sum('total_mem_fem_advisor') }}</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2"> {{ $total_member_all_university->sum('total_mem') }}</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2"> {{ $total_member_all_university->sum('total_mem_fem')}}</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td colspan="3" class="border border-gray-700 p-2 font-semibold font-battambang">សរុប</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">{{ $school_types_per_branch->sum('total_secondary_school') + $school_types_per_branch->sum('total_high_school') + $universities_per_branch->sum('total_university') }}</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">{{ $school_types_per_branch->sum('total_secondary_school') }}</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">{{ $school_types_per_branch->sum('total_high_school') }}</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2"> {{ $universities_per_branch->sum('total_university') }}</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2"> {{ $branchWhole->total_mem_advisor }}</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">{{ $branchWhole->total_mem_fem_advisor }}</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2"> {{ $branchWhole->total_mem }}</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2"> {{ $branchWhole->total_mem_fem }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
@endsection
    @push('JS')
        @vite(['resources/js/exportToExcelOptionThree.js'])
        <script type="module">
            var data = @json($branch_and_count_member);
            console.log(data);
            
            $("#export_excel").on("click", async () => {
                exportToExcelOptionThree(data);
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