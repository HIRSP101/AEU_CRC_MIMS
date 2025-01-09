@extends('layouts.templates.att.master')
@push('CSS')

@endpush

@section('Content')
    <?php
    $current_branch = "";
    $total_mem_detail = "";
    ?>
@if(count($total_mem) > 0)
<?php
    $current_branch = explode(' ', $total_mem[0]->full_current_address)[3] ?? "";
     $total_mem_detail = array();
        for ($i = 0; $i < count($total_mem); $i++) {
            $total_mem_detail[$i] = array(
             $total_mem[$i]->member_id
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
            ,$total_mem[$i]->shirt_size
            );
        }
?>
<div class="bg-white mt-2 mx-3 shadow-lg">
    <h1 class="text-center font-siemreap my-2 text-xl font-bold"> បញ្ជីតារាងទិន្នន័យបច្ចុប្បន្នភាពយុវជន និងអ្នកស្ម័គ្រចិត្តកាកបាទក្រហមកម្ពុជា </h1>
    <h2 class="text-center font-siemreap mb-2 text-xl font-bold"> សាខាកាកបាទក្រហមកម្ពុជា {{$current_branch}} </h2>

    <div class="flex justify-between items-center mb-4 mt-14 px-4">
        <!-- Search Bar -->
        <div class="tab_filter_container flex items-center space-x-2">
            <input type="text" id="tab_filter_text" class="border border-gray-300 px-2 py-2 rounded" placeholder="Search...">
            <button id="tab_filter_btn" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
        </div>
        
        <!-- Buttons Group -->
        <div class="flex items-center space-x-2">
            <div class="tab_head_container flex items-center space-x-2">
                <div class="page_limit flex items-center space-x-2">
                    <span>បង្ហាញ</span>
                    <select id="table_size" class="text-gray-700 bg-gray-300 py-2 px-2 rounded w-20">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                    </select>
                    
                </div>
                
                <div class="gender_sort flex items-center space-x-2">
                    <span>ភេទ</span>
                    <select id="gender_filter" class="text-gray-700 bg-gray-300 py-2 px-2 rounded w-28">
                        <option value="all">ទាំងអស់</option>
                        <option value="ស្រី">ស្រី</option>
                        <option value="ប្រុស">ប្រុស</option>
                    </select>
                </div>
                
                <div class="year_sort flex items-center space-x-2​">
                    <span>ឆ្នាំ</span>
                    <select id="filter_year" class="text-gray-700 bg-gray-300 py-2 px-2 rounded w-28">
                        <option value="all">ទាំងអស់</option>
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>
                </div>
            </div>
            {{-- <button id="export_pdf" class="bg-gray-500 text-white px-4 py-2 rounded">Export PDF</button> --}}
            <button id="export_excel" class="bg-green-500 text-white px-4 py-2 rounded">Export Excel</button>
            {{-- <a href="{{ route('createmember') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                <i class="fas fa-edit"></i> New
            </a> --}}
            <button id="delete" class="bg-red-500 text-white px-4 py-2 rounded">Delete Multi</button>
        </div>
    </div>
    
<div class="w-full overflow-scroll mx-3 my-3 max-h-[760px]">

       <div class="w-full overflow-scroll my-3 max-h-[760px] table">
           <table class="min-w-max w-full table-auto font-siemreap">
               <thead>
               <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                   <th class="py-3 pl-5 text-left">
           <table class="min-w-max w-full table-auto font-siemreap">
               <thead>
               <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                   <th class="py-3 pl-5 text-left">
                       ល.រ
                   </th>
                   <th class="py-3 text-center">
                   <th class="py-3 text-center">
                       គោត្តមនាម-នាម
                   </th>
                   <th class="py-3 text-center">
                   <th class="py-3 text-center">
                       ភេទ
                   </th>
                   <th class="py-3 text-center">
                   <th class="py-3 text-center">
                       ថ្ងៃខែឆ្នាំកំណើត
                   </th>
                   <th class="py-3 text-center">
                   <th class="py-3 text-center">
                       គ្រឹះស្ថានសិក្សា
                   </th>
                   <th class="py-3 text-center">
                   <th class="py-3 text-center">
                       តួនាទី
                   </th>
                   <th class="py-3 text-center">
                   <th class="py-3 text-center">
                       កម្រិតសិក្សា
                   </th>
                   <th class="py-3 text-center">
                   <th class="py-3 text-center">
                       action
                   </th>
               </tr>
               </thead>
               <tbody class="text-gray-600 text-sm font-light">
               <tbody class="text-gray-600 text-sm font-light">
               </tbody>
           </table>
           <div class="flex justify-end mt-8 footer">
               <span>Showing 1 to 10 of 60 entries</span>
               <div class="px-7 py-15 bg-transparent cursor-pointer index_buttons"></div>
           </div>
       </div>
</div>
   
   
@else
    <p class="font-siemreap"> មិនមានទិន្ទន័យគ្រប់គ្រង </p>
@endif
@endsection

@push('JS')
@vite(['resources/js/exportToExcel.js'])
<script type="module">
    import { handleTotalmem } from "{{ asset('js/handleTotalmem.js') }}";
    document.addEventListener('DOMContentLoaded', function () {
        var array = @json($total_mem);
        console.log(@json($total_fem));
        handleTotalmem(array);
        if (array.length > 0) {
            exportToExcel(@json($current_branch) ,@json($total_mem_detail)
                ,@json($total_total)
                ,@json($total_fem));
        }
    });
    /*@json($total_total)[0]["total_mem"], @json($total_fem)[0]["total_mem_fem"]*/
</script>
@endpush

