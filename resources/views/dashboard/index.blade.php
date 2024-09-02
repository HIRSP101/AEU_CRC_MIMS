@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
<div id="test_j" class="p-4">
    <h1 class="text-2xl font-bold">Welcome to my dashboard!</h1>
    <p class="mt-2 text-gray-600">This is an example dashboard using Tailwind CSS.</p>
</div>
@endsection

@push('JS')
<script>
    $("test_j").click(function (){
        alert("Hello!!");
    })
</script>
@endpush
