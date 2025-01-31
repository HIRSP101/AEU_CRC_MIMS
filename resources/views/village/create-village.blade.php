@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    @php
    
    @endphp
    <div class="bg-[#fff] p-2 rounded-lg max-w-1000px m-5 shadow-md font-siemreap">

        <div class="grid grid-cols-7 ">
            <div class=" text-2xl col-span-6 flex flex-col items-center justify-center mb-10 ml-24">
                <h1>បង្កើតស្រុក ភូមិ</h1>
            </div>
            
        </div>
        <div class="mt-5">
            <form action="{{ route('village.store', ['id' => $branch->branch_id]) }}" method="POST">
                @csrf
                {{-- Hidden input for branch_id --}}
                <input type="hidden" name="branch_id" value="{{ $branch->branch_id }}">
                <div class="container">
                    <div class="flex mb-6 mx-3">
                        <div class="block w-1/2 mb-6 md:mb-0 px-3">
                            <label class="md:w-full block uppercase tracking-wide text-gray-700 mb-2" for="villageName">
                                <h1>ឈ្មោះស្រុក ភូមិ</h1>
                            </label>
                            <input class="appearance-none md:w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                   name="village_name" id="villageName" type="text" required>
                            <label for="registration_date">Registration Date:</label>
                            <input type="date" name="registration_date" id="registration_date" required>
                                          
                        </div>
                    </div>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create Village</button>
                </div>
            </form>                          
        </div>
    </div>
@endsection

@push('JS')
    {{-- <script type="module">
        import {
            handleBranchform
        } from "{{ asset('js/handleBranchform.js') }}";
        document.addEventListener('DOMContentLoaded', function() {
            var array = @json($bhei_col);

            array.forEach(item => {
                item.full_address =
                    `${item.village} ${item.commune_sangkat} ${item.district_khan} ${item.provience_city}`;
            });

            console.log(array);
            handleBranchform(array);
        });
    </script> --}}
@endpush
