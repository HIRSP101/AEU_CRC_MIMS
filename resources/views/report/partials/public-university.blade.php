@extends('layouts.templates.att.master')
@push('CSS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('Content')
    <?php
    $i = 0;
    ?>
    <div class="bg-white mt-2 mx-2 px-3 shadow-lg h-max-full rounded-lg">
        <h1 class="text-center font-khmer my-2 text-lg text-blue-800 mt-5">តារាងទិន្នន័យគ្រឹះស្ថានសិក្សា បណ្តាញយុវជន ទីប្រឹក្សាយុវជន នឹងយុវជន</h1>
        <h1 class="text-center font-khmer my-2 text-lg text-blue-800">នៃសាខាកាកបាទក្រហមកម្ពុជា ២៥ រាជធានី ខេត្ត</h1>
        <h2 class="text-center font-khmer mb-2 text-lg text-blue-800">បច្ចុប្បន្នភាពឆ្នាំ២០២៤</h2>
        <div class="flex justify-between items-center mt-5">
            <div>
                <button id="export_pdf" class="bg-gray-500 text-white mt-2 px-4 py-2 rounded">Export PDF</button>
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
                      <th rowspan="3" class="border border-gray-700 p-2 font-semibold font-battambang">ល.រ</th>
                      <th rowspan="3" class="border border-gray-700 p-2 font-semibold font-battambang">ក្រុង/ស្រុក</th>
                      <th rowspan="3" class="border border-gray-700 p-2 font-semibold font-battambang">ចំនួនគ្រឹះស្ថានសិក្សា</th>
                      <th rowspan="3" class="border border-gray-700 p-2 font-semibold font-battambang">ឈ្មោះគ្រឹះស្ថានសិក្សា</th>
                      <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">មានបណ្ដាញ</th>
                      <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">យុវជន</th>
                      <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">ពិការភាព</th>
                      <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">ទីប្រឹក្សា</th>
                      <th colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">ពិការភាព</th>
                      <th rowspan="2" colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">ចំនួនយុវជនទទួលវគ្គ បណ្ដុះបណ្ដាល មូលដ្ឋាន</th>
                      <th rowspan="2" colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">ចំនួនយុវជនបានទទួល ឯកសណ្ឋាន</th>
                    </tr>
                    <tr class="bg-gray-100">
                      <th colspan="2" class="border border-gray-700 font-semibold p-2 font-battambang">យុវជន កក្រក</th>                    
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
                        <th class="border border-gray-700 font-semibold font-battambang p-2">-</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">-</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">-</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">-</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">-</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">-</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">-</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">-</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">ប្រុស</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">ស្រី</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">ស្រីសរុប</th>
                        <th class="border border-gray-700 font-semibold font-battambang p-2">ប្រុស</th>
                    </tr>
                  </thead>
            
                  <!-- Table Body -->
                  <tbody>
                    <!-- Row 1 -->
                    @foreach ($branchesreport as $brreport) 
                        @php
                      
                        $i++;
                        @endphp
                        <tr>
                        <td class="border border-gray-700 font-normal font-battambang p-2">{{$i}}</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">{{$brreport->branch_kh}}</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">{{$brreport->total_ms + $brreport->total_hs}}</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">{{$brreport->branch_kh}}</td>         
                        <td class="border border-gray-700 font-normal font-battambang p-2">-</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">-</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">{{$brreport->total_mem}}</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">{{$brreport->total_wm}}</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">-</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">-</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">{{$brreport->total_ls}}</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">{{$brreport->total_ls_wm}}</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">-</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">-</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">-</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">-</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                        <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                    </tr>

                        @endforeach
                         <!-- Summary Row -->
                         <tr class="bg-gray-100">
                            <td colspan="2" class="border border-gray-700 p-2 font-semibold font-battambang">សរុប</td>
                            <td class="border border-gray-700 font-battambang p-2 font-semibold">16</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                            <td class="border border-gray-700 font-normal font-battambang p-2">0</td>
                        </tr>

                  </tbody>
                </table>
                <p class="font-battambang font-medium text-center mt-2">រៀបចំដោយ៖ ការិយាល័យអភិវឌ្ឍន៍ នៃនាយកដ្ឋានធនធានមនុស្ស កក្រក</p>
            </div>
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
