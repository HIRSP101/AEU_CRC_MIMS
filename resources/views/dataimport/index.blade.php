@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    @include('dataimport.partials.sheetselector')
    <div class="p-4">
        <button class="bg-red-400 w-auto h-auto mx-3" id="member_submit">submit</button>
        <input type="file" id="file-input">
        <button id="upload-btn">Upload</button>

    </div>


@endsection

@push('JS')
@vite(['resources/js/import.js'])
@endpush
