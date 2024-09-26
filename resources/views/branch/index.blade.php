@extends('layouts.templates.att.master')
@push('CSS')

@endpush

@section('Content')
<div class="bg-[#fff] p-8 rounded-lg max-w-1000px m-5 shadow-md font-siemreap">

    <h2 class="text-2lg font-bold text-center siemreap-regular my-2 pb-3">សាខា កាកបាទក្រហមកម្ពុជា 25 រាជធានី-​ខេត្ត</h2>
    <ul>
        @foreach($total_mem_branches as $mem_br)
            @include('branch.partials.listbranch')
        @endforeach
    </ul>
</div>
@endsection

@push('JS')

@endpush
