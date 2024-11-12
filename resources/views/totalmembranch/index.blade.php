@extends('layouts.templates.att.master')
@push('CSS')

@endpush

@section('Content')
@if(count($total_mem) > 0)
<?php
    $current_branch = explode(' ', $total_mem[0]->full_current_address)[3] ?? "";
     $total_mem_detail = array();
        for ($i = 0; $i < count($total_mem); $i++) {
            $total_mem_detail[$i] = array($total_mem[$i]->member_id
            ,$total_mem[$i]->name_kh
            ,$total_mem[$i]->name_en
            ,$total_mem[$i]->gender
            ,$total_mem[$i]->date_of_birth
            ,$total_mem[$i]->member_type
            ,$total_mem[$i]->institute_id
            ,$total_mem[$i]->education_level
            ,$total_mem[$i]->registration_date
            ,$total_mem[$i]->full_current_address
            ,$total_mem[$i]->phone_number
            ,$total_mem[$i]->guardian_phone
            ,$total_mem[$i]->shirt_size);
        }
?>
<div class="bg-white mt-2 mx-3 shadow-lg">
    <h1 class="text-center font-siemreap my-2 text-xl font-bold"> បញ្ជីតារាងទិន្នន័យបច្ចុប្បន្នភាពយុវជន និងអ្នកស្ម័គ្រចិត្តកាកបាទក្រហមកម្ពុជា </h1>
    <h2 class="text-center font-siemreap mb-2 text-xl font-bold"> សាខាកាកបាទក្រហមកម្ពុជា {{$current_branch}} </h2>
    <div class="tab_filter_container">
        <input type="text" id="tab_filter_text">
        <button id="tab_filter_btn" class="active">search</button>
    </div>
    
    <div class="flex justify-end space-x-2 mb-4 mt-10">
        <div class="tab_head_container">
            <div class="page_limit">
              {{-- <span>Shows</span> --}}
              <select id="table_size" class="text-gray-700 bg-gray-300 py-2 rounded">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>

              </select>
              <span>entries</span>
            </div>
        </div>
        <button id="export_pdf" class="bg-gray-500 text-white px-4 py-2 rounded">Export PDF</button>
        <button id="export_excel" class="bg-green-500 text-white px-4 py-2 rounded">Export Excel</button>
           <a href="{{ route('createmember') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
               <i class="fas fa-edit"></i> New
           </a>
           <button id="delete" class="bg-red-500 text-white px-4 py-2 rounded">Delete Multi</button>
       </div>
<div class="w-full overflow-scroll mx-3 my-3 max-h-[760px]">
    
       <div class="w-full overflow-scroll my-3 max-h-[760px] table">
           <table>
               <thead class=" font-siemreap bg-slate-200 border-collapse border-t-2 border-black">
               <tr>
                   <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                       ល.រ
                   </th>
                   <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                       គោត្តមនាម-នាម
                   </th>
                   <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                       ភេទ
                   </th>
                   <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                       ថ្ងៃខែឆ្នាំកំណើត
                   </th>
                   <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                       គ្រឹះស្ថានសិក្សា
                   </th>
                   <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                       តួនាទី
                   </th>
                   <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                       កម្រិតសិក្សា
                   </th>
                   <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                       ឆ្នាំសិក្សា
                   </th>
                   <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                       អាស័យដ្ធានបច្ចុប្បន្ន
                   </th>
                   <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                       ទូរស័ព្ទផ្ទាល់ខ្លួន
                   </th>
                   <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                       action
                   </th>
               </tr>
               </thead>
               <tbody class="bg-white font-siemreap">
               </tbody>
           </table>
           <div class="flex justify-end mt-8 footer">
               <span>Showing 1 to 10 of 60 entries</span>
               <div class="px-7 py-15 bg-transparent cursor-pointer index_buttons"></div>
           </div>
       </div>
</div>
@else
    <p> no data available </p>
@endif
@endsection

@push('JS')
@vite(['resources/js/exportToExcel.js'])
<script type="module">
    import { handleTotalmem } from "{{ asset('js/handleTotalmem.js') }}";
    document.addEventListener('DOMContentLoaded', function () {
        var array = @json($total_mem);
        handleTotalmem(array);
        exportToExcel(@json($current_branch)
        ,@json($total_mem_detail)
        ,@json($total_total)[0]["total_mem"]
        ,@json($total_fem)[0]["total_mem_fem"]);
    });
</script>
@endpush

