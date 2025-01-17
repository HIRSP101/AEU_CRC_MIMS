@extends('layouts.templates.att.master')
@push('CSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('Content')
    <?php
    $i = 0;
    ?>
    <div class="bg-white mt-2 mx-2 px-3 shadow-lg rounded-lg">
        <h1 class="text-center moul-regular my-2 text-lg text-blue-800 font-bold mt-5">តារាងទិន្នន័យគ្រឹះស្ថានសិក្សា បណ្តាញយុវជន ទីប្រឹក្សាយុវជន នឹងយុវជន</h1>
        <h1 class="text-center moul-regular my-2 text-lg text-blue-800 font-bold">នៃសាខាកាកបាទក្រហមកម្ពុជា ២៥ រាជធានី ខេត្ត</h1>
        <h2 class="text-center moul-regular mb-2 text-lg font-bold text-blue-800">បច្ចុប្បន្នភាពឆ្នាំ២០២៤</h2>
        <div class="flex justify-between items-center mt-5">
            <div>
                <button id="export_pdf" class="bg-gray-500 text-white mt-2 px-4 py-2 rounded">Export PDF</button>
                <button id="export_excel" class="bg-[#1ba466] text-white px-4 py-2 rounded">Export Excel</button>
            </div>
            <div class="flex justify-end items-center">
                <input id="datepicker" class="border-2 border-gray-400 rounded-md px-3 py-2 w-64" type="text"
                    placeholder="Filter by date">
            </div>
        </div>
        <div class="w-full overflow-scroll my-3 max-h-[760px] table">
            <table class="w-full">
                <thead class=" font-battambang bg-gray-100 border-collapse border border-gray-700">
                    <tr>
                        <th rowspan="2" class="p-2 border border-gray-700 uppercase">
                            ល.រ
                        </th>
                        <th rowspan=2 class="p-2 border border-gray-700 uppercase">
                            សាខា កក្រក
                        </th>
                        <th colspan=4 class="p-2 border border-gray-700 uppercase">
                            បណ្តាញយុវជនគ្រឹះស្ថានសិក្សា ២០២៤
                        </th>
                        <th colspan=2 class="p-2 border border-gray-700 uppercase">
                            ទីប្រឹក្សា ២០២៤
                        </th>
                        <th colspan=2 class="p-2 border border-gray-700 uppercase">
                            យុវជន ២០២៤
                        </th>
                    </tr>
                    <tr>
                        <th class="p-2 border border-gray-700 uppercase">សរុប</th>
                        <th class="p-2 border border-gray-700 uppercase">អនុ.វិ</th>
                        <th class="p-2 border border-gray-700 uppercase">វិទ្យាល័យ</th>
                        <th class="p-2 border border-gray-700 uppercase">ខត្តមសិក្សា</th>
                        <th class="p-2 border border-gray-700 uppercase">សរុប</th>
                        <th class="p-2 border border-gray-700 uppercase">ស្រី</th>
                        <th class="p-2 border border-gray-700 uppercase">សរុប</th>
                        <th class="p-2 border border-gray-700 uppercase">ស្រី</th>
                    </tr>
                </thead>
                <tbody class="bg-white font-battambang">
                    @foreach ($branchesreport as $brreport)
                        @php
                            $i++;
                        @endphp
                        <tr class="border-collapse border border-gray-700">
                            <td class="p-2 text-sm text-center border border-gray-700 whitespace-nowrap">
                                {{ $i }}</td>
                            <td class="p-2 text-sm text-center border border-gray-700 whitespace-nowrap">
                                {{ $brreport->branch_kh }}</td>
                            <td class="p-2 text-sm text-center border border-gray-700 whitespace-nowrap">
                                {{ $brreport->total_ms + $brreport->total_hs }}</td>
                            <td class="p-2 text-sm text-center border border-gray-700 whitespace-nowrap">
                                {{ $brreport->total_ms }}</td>
                            <td class="p-2 text-sm text-center border border-gray-700 whitespace-nowrap">
                                {{ $brreport->total_hs }}</td>
                            <td class="p-2 text-sm text-center border border-gray-700 whitespace-nowrap">0</td>
                            <td class="p-2 text-sm text-center border border-gray-700 whitespace-nowrap">
                                {{ $brreport->total_ls }}</td>
                            <td class="p-2 text-sm text-center border border-gray-700 whitespace-nowrap">
                                {{ $brreport->total_ls_wm }}</td>
                            <td class="p-2 text-sm text-center border border-gray-700 whitespace-nowrap">
                                {{ $brreport->total_mem }}</td>
                            <td class="p-2 text-sm text-center border border-gray-700 whitespace-nowrap">
                                {{ $brreport->total_wm }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection

    @push('JS')
        @vite(['resources/js/exportToExcel_branch.js'])
        <script type="module">
            var data = @json($branchesreport);
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
