@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
<?php 
    $i = 0;
    $total_mem_bhei = 0;
    $total_wm_bhei = 0;
    foreach($branchesreport as $bheirep) {
        $total_mem_bhei .= $bheirep->total_mem;
    }
    dd($total_bhei); 
?>
<div class="bg-white mt-2 mx-2 px-2 shadow-lg">
    <h1 class="text-center font-siemreap my-2 text-lg font-bold">តារាងទិន្នន័យគ្រឹះស្ថានសិក្សា បណ្តាញយុវជន ទីប្រឹក្សាយុវជន នឹងយុវជន នៃសាខាកាកបាទក្រហមកម្ពុជា ២៥ រាជធានី ខេត្ត</h1>
    <h2 class="text-center font-siemreap mb-2 text-lg font-bold">បច្ចុប្បន្នភាពឆ្នាំ២០២៤</h2>
    <br>
    <button id="export_pdf" class="bg-gray-500 text-white px-4 py-2 rounded">Export PDF</button>
    <button id="export_excel" class="bg-green-500 text-white px-4 py-2 rounded">Export Excel</button>
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
                    @foreach ($branchesreport as $brreport) 
                    @php
                     $i++;
                    @endphp
                    <tr class="border-collapse border-y-2 border-x-2 border-black">
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$i}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->branch_kh}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_ms + $brreport->total_hs + $brreport->total_hei }}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_ms}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_hs}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_hei}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_ls}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_ls_wm}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_mem}}</td>
                        <td class="px-2 py-1 text-sm text-center border-x-2 border-black whitespace-nowrap">{{$brreport->total_wm}}</td>
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

@endpush