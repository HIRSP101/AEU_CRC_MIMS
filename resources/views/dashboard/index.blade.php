@extends('layouts.templates.att.master')
@push('CSS')
    <style>
        .flip-image {
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .flip-image.flipped {
            transform: rotateX(180deg);
        }
    </style>
@endpush

@section('Content')
    <div class="mx-2 mt-2 bg-gray-200 rounded-md shadow-lg">
        <div class="p-1 flex flex-wrap items-center justify-center">
            @foreach ($branches as $key => $val)
                @if ($key == 3)
                    <div class="p-1 flex flex-wrap items-center justify-center">
                @endif
                @include('dashboard.partials.branch_card')
            @endforeach
        </div>
    </div>
    <div class="relative">
        <div class="flex justify-end p-2">
                <img id="toggleButton" class="flip-image w-[32px] h-[32px]" src="{{ asset('images/icons/dropdown.svg') }}" />
        </div>
    </div>
    </div>
@endsection

@push('JS')
    <script>
        $(document).ready(function() {
            $("#toggleButton").click(function() {
                $(".collapsibleContent").slideToggle();
                $(this).toggleClass('flipped');
            });
        });
    </script>
@endpush
