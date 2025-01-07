@extends('layouts.templates.att.master')
@push('CSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('Content')
    <?php
    $i = 0;
    ?>
    <div class="bg-white mt-2 mx-2 px-2 shadow-lg">
        <h1 class="text-center font-siemreap my-2 text-lg font-bold">តារាងទិន្នន័យគ្រឹះស្ថានសិក្សា បណ្តាញយុវជន
            ទីប្រឹក្សាយុវជន នឹងយុវជន នៃសាខាកាកបាទក្រហមកម្ពុជា ២៥ រាជធានី ខេត្ត</h1>
        <h2 class="text-center font-siemreap mb-2 text-lg font-bold">បច្ចុប្បន្នភាពឆ្នាំ២០២៤</h2>
        <br>
        <button id="export_pdf" class="bg-gray-500 text-white px-4 py-2 rounded">Export PDF</button>
        <button id="export_excel" class="bg-green-500 text-white px-4 py-2 rounded">Export Excel</button>
        <div class="flex justify-end items-center">
            <div class="">
                <lable class="text-base text-gray-800 font-medium">Filter By Date</lable> <br>
                <input id="datepicker" class="border-2 border-gray-400 rounded-md px-3 py-2 w-64" type="text"
                    placeholder="Select a date">
            </div>
        </div>
        <div class="w-full overflow-scroll my-3 max-h-[760px] table">
            <table class="w-full">
                <thead class=" font-siemreap bg-slate-200 border-collapse border-t-2 border-black">
                    <tr>
                        <th rowspan="2" class="px-2 py-1 text-pretty border-x-2 border-black uppercase">
                            ល.រ
                        </th>
                        <th rowspan=2 class="px-2 py-1 text-pretty border-x-2 border-black uppercase">
                            សាខា កក្រក
                        </th>
                        <th colspan=4 class="px-2 py-1 text-pretty border-x-2 border-black uppercase">
                            បណ្តាញយុវជនគ្រឹះស្ថានសិក្សា ២០២៤
                        </th>
                        <th colspan=2 class="px-2 py-1 text-pretty border-x-2 border-black uppercase">
                            ទីប្រឹក្សា ២០២៤
                        </th>
                        <th colspan=2 class="px-2 py-1 text-pretty border-x-2 border-black uppercase">
                            យុវជន ២០២៤
                        </th>
                    </tr>
                    <tr>
                        <th class="px-2 py-1 text-pretty border-x-2 border-y-2 border-black uppercase">សរុប</th>
                        <th class="px-2 py-1 text-pretty border-x-2 border-y-2 border-black uppercase">អនុ.វិ</th>
                        <th class="px-2 py-1 text-pretty border-x-2 border-y-2 border-black uppercase">វិទ្យាល័យ</th>
                        <th class="px-2 py-1 text-pretty border-x-2 border-y-2 border-black uppercase">ខត្តមសិក្សា</th>
                        <th class="px-2 py-1 text-pretty border-x-2 border-y-2 border-black uppercase">សរុប</th>
                        <th class="px-2 py-1 text-pretty border-x-2 border-y-2 border-black uppercase">ស្រី</th>
                        <th class="px-2 py-1 text-pretty border-x-2 border-y-2 border-black uppercase">សរុប</th>
                        <th class="px-2 py-1 text-pretty border-x-2 border-y-2 border-black uppercase">ស្រី</th>
                    </tr>
                </thead>
                <tbody class="bg-white font-siemreap">
                    {{-- @foreach ($branchesreport as $brreport) 
                    @php
                     $i++;
                    @endphp
                    <tr class="border-collapse border-y-2 border-x-2 border-black">
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$i}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->branch_kh}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_ms + $brreport->total_hs}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_ms}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_hs}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">0</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_ls}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_ls_wm}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_mem}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_wm}}</td>
                    </tr>
                    @endforeach --}}

                    <tr class="border-collapse border-y-2 border-x-2 border-black">
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">pp</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">dd</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">dd</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">00</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">00</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">0</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">xx</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">ee</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">fddfdf</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">dfdf</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endsection

    @push('JS')
        @vite(['resources/js/exportToExcel_branch.js'])
        {{-- <script type="module">
        var data = @json($branchesreport);
        console.log(data);
        $("#export_excel").on("click", async () => {
        exportToExcel_branch(data);
        });
        </script> --}}

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
           flatpickr("#datepicker", {
                mode: "range",
                dateFormat: "d-F-Y",
                locale: {
                    // weekdays: {
                    //     shorthand: ["អា", "ច", "អ", "ពុ", "ព្រ", "សុ", "ស"], // Short weekdays
                    //     longhand: [
                    //         "អាទិត្យ",
                    //         "ច័ន្ទ",
                    //         "អង្គារ",
                    //         "ពុធ",
                    //         "ព្រហស្បតិ៍",
                    //         "សុក្រ",
                    //         "សៅរ៍"
                    //     ]
                    // },
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
