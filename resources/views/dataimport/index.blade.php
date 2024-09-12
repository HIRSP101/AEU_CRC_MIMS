@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')

    <div class="p-4">
        @foreach ($fieldNames as $key => $val)
            <label>{{ $key }}</label>
            @if (strpos($key, 'date') || strpos($key, 'dob') || $key == 'date_of_birth')
                <input id="{{ $key }}" type="date">
            @else
                <input id="{{ $key }}" type="text">
            @endif
            <br>
        @endforeach
        <button class="bg-red-400 w-auto h-auto mx-3" id="member_submit">submit</button>
        <input type="file" id="file-input">
        <button id="upload-btn">Upload</button>
    </div>

@endsection

@push('JS')
    <script>

    </script>
@endpush
