@extends('layouts.templates.att.master')
@push('CSS')

@endpush

@section('Content')
@if(count($total_mem) > 0)
<?php
    $current_branch = explode(' ', $total_mem[0]->full_current_address)[3] ?? ""
?>
<div class="bg-white mt-2 mx-3 shadow-lg">
    <h1 class="text-center font-siemreap my-2 text-xl font-bold"> បញ្ជីតារាងទិន្នន័យបច្ចុប្បន្នភាពយុវជន និងអ្នកស្ម័គ្រចិត្តកាកបាទក្រហមកម្ពុជា </h1>
    <h2 class="text-center font-siemreap mb-2 text-xl font-bold"> សាខាកាកបាទក្រហមកម្ពុជា {{$current_branch}} </h2>
<div class="w-full overflow-scroll my-3 max-h-[760px]">
    <table class="min-w-full border-collapse border-2 border-slate-400 ">
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
            @foreach($total_mem as $mem)
                @include('totalmembranch.partials.memtable')
            @endforeach
        </tbody>
    </table>
</div>
</div>
@else
    <p> no data available </p>
@endif
@endsection

@push('JS')
<script>
    $(".hoverablebranch").on("dblclick",function() {
        window.location = "{{ url('/') }}/member/"+$(this).attr('data-id');
    })
</script>
@endpush
