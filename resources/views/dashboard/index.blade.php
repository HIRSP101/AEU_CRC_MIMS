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
        @include('dashboard.partials.first_sec_dashboard')
        <div class="">
            <hr class="h-px my-4 bg-red-600 p-[1px] border dark:bg-red-600">
        </div>
        <div class="">
            <h1 class="font-koulen text-blue-600 text-2xl">សាខា & អនុសាខា</h1>
        </div>
    <div class="mx-2 mt-2 bg-gray-200 rounded-md shadow-lg">

        <div class="p-1 flex flex-wrap items-center justify-center font-siemreap">
            @foreach ($branches as $key => $val)
                @if ($key == 4)
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
    <div class="">
        <hr class="h-px my-4 bg-red-600 p-[1px] border dark:bg-red-600">
    </div>
        <div class="flex items-center justify-center font-sans mt-5">
            <div class="w-full lg:w-5/6">
                <h1 class="text-center font-siemreap font-black text-2xl">តារាងទិន្នន័យនៃសាខា ក.ក្រ.ក្រ ២៥ រាជធានី ខេត្ត</h1>
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto font-siemreap">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 pl-5 text-left">សាខា</th>
                                <th class="py-3 text-center">សរុប</th>
                                <th class="py-3 text-center">ស្រី</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach($total_mem_branches as $total_mem_branch)
                                @include('dashboard.partials.summarized_mem_branch')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection

@push('JS')
    <script>

    </script>
@endpush
