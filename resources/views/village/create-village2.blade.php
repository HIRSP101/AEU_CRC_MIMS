@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    @php

    @endphp
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <div class="bg-white px-[10%] py-[5%] rounded-lg shadow-md w-[97%] h-[95%]">
            <div class="text-center text-2xl font-bold mb-6 font-siemreap">
                <h1>បង្កើតស្រុក/ខណ្ឌ</h1>
            </div>
            <form action="{{ route('storedistrict') }}" method="POST">
                @csrf
                <div class="grid gap-3">
                    <div>
                        <label class="md:w-full block font-siemreap uppercase tracking-wide mb-2" for="districtName">
                            <h1>ឈ្មោះស្រុក/ខណ្ឌ</h1>
                        </label>
                        <input
                            class="appearance-none md:w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-siemreap"
                            name="district_name" id="districtName" type="text" required>
                    </div>
                    <div>
                        <label for="branch_id" class="block font-siemreap mb-2">ខេត្ត/ក្រុង</label>
                        <select name="branch_id" id="branch_id"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 font-siemreap">
                            @foreach($branches as $b)

                                <option>
                                    {{ $b->branch_kh }}
                                </option>

                            @endforeach
                        </select>
                    </div>
                    {{-- <div>
                        <label for="registration_date" class="font-siemreap">ថ្ងៃចូលសមាជិក</label>
                        <input type="date" name="registration_date" id="registration_date"
                            class="appearance-none md:w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-siemreap"
                            required>
                    </div> --}}
                    <div>
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded font-siemreap">បង្កើត</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('JS')

@endpush