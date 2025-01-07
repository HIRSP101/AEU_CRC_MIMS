@extends('layouts.templates.att.master')
@push('CSS')
@endpush
    
@section('Content')
    
    <div class="bg-[#fff] p-8 rounded-lg max-w-1000px m-5 shadow-md font-siemreap">
        <h2 class="text-2lg font-bold text-center siemreap-regular my-2 pb-3">សាខា កាកបាទក្រហមកម្ពុជា វិទ្យាស្ថានកម្រិតខ្ពស់</h2>
        <label class="inline-flex items-center me-5 cursor-pointer">
            {{-- <span class="mx-3 text-sm font-medium text-gray-900 dark:text-gray-300">ខេត្ត</span> --}}
            {{-- <input type="checkbox" value="" id="branchswitch" class="sr-only peer" @if (Route::currentRouteName() == 'branchhei') checked @endif>
            <div
                class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600">
            </div> --}}
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-500">ឧត្តមសិក្សា</span>
        </label>
        <ul>
            @foreach ($total_mem_branchhei as $mem_br)
                @include('branch_hei.partials.listbranch')
            @endforeach
        </ul>
    </div>
    @php
    // dd($total_mem_branchhei);
    @endphp
@endsection

@push('JS')

<script> 
    $("input#branchswitch").change(function(e) {
        window.location = "{{ url('/') }}/branch"
    })
</script>

@endpush
