@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    @php
    
    @endphp
    <div class="bg-[#fff] p-2 rounded-lg max-w-1000px m-5 shadow-md font-siemreap">

        <div class="grid grid-cols-7 ">
            <div class=" text-2xl col-span-6 flex flex-col items-center justify-center mb-10 ml-24">
                <h1>បង្កើតសាលារៀន​ ឬវិទ្យាល័យ</h1>
            </div>
            
        </div>
        <div class="mt-5">
            <form action="{{ route('school.store', ['id' => $branch->branch_id, 'v_id' => $village->village_id]) }}" method="POST">
                @csrf
                <div class="container">
                    <div class="flex mb-6 mx-3">
                        <div class="block w-1/2 mb-6 md:mb-0 px-3">
                            <label class="md:w-full block uppercase tracking-wide text-gray-700 mb-2" for="school_name">
                                <h1>ឈ្មោះសាលារៀន</h1>
                            </label>
                            <input class="appearance-none md:w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                   name="school_name" id="school_name" type="text" required>

                            <label for="type">ប្រភេទ</label>
                            <input type="text" name="type" id="type" required>

                            <label for="village_name">ភូមិ</label>
                            <input type="text" name="village_name" id="village_name" required>

                            <label for="district">ឃុំ</label>
                            <input type="text" name="district" id="district" required>

                            <label for="province">ខេត្ត</label>
                            <input type="text" name="province" id="province" required>

                            <label for="registration_date">ថ្ងៃចូលសមាជិក</label>
                            <input type="date" name="registration_date" id="registration_date" required>
                        </div>
                    </div>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create</button>
                </div>
            </form>                          
        </div>
    </div>
@endsection

@push('JS')
    
@endpush
