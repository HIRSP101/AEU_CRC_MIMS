@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <div class="flex justify-center items-center bg-white">
        <div class="bg-white px-[10%] py-[5%] rounded-lg shadow-md w-[97%] mt-4">
            <div class="text-center text-2xl font-koulen mb-6 text-blue-600">
                <h1>កែប្រែគ្រឹះស្ថានសិក្សា</h1>
            </div>
            <form action="{{ route('updatePost', ['type' => 'institute', 'id' => $institute->bhei_id]) }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="institute_kh" class="block font-siemreap mb-2">ឈ្មោះគ្រឹះស្ថានសិក្សា</label>
                        <input type="text" name="institute_kh" id="institute_kh"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 font-siemreap"
                            value="{{ $institute->institute_kh }}" required>
                    </div>
                    <div>
                        <label for="typeUniversity" class="block font-siemreap mb-2">ប្រភេទ</label>
                        <select name="typeUniversity" id="typeUniversity" class="w-full border rounded px-3 py-2">
                            <option value="សាធារណៈ" {{ $institute->type == 'សាធារណៈ' ? 'selected' : '' }}>សាធារណៈ</option>
                            <option value="ឯកជន" {{ $institute->type == 'ឯកជន' ? 'selected' : '' }}>ឯកជន</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mt-4">
                    <div class="mb-4">
                        <label for="image" class="block font-siemreap mb-2">
                            រូបភាព
                        </label>

                        <div
                            class="relative flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded py-2 bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer">
                            <span class="text-sm text-gray-500">ចុចដើម្បីជ្រើសរើសឯកសាររូបភាព</span>
                            <input type="file" name="image" id="image" class="absolute inset-0 opacity-0 cursor-pointer">
                        </div>
                    </div>
                    <div>
                        <label for="registered_at" class="block font-siemreap mb-2">ថ្ងៃចូលសមាជិក</label>
                        <input type="date" name="registered_at" id="registered_at"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                            value="{{ $institute->registered_at }}" required>
                    </div>
                    <div>
                        <label for="district_khan" class="block font-siemreap mb-2">ស្រុក/ខណ្ឌ</label>
                        <select name="district_khan" id="district_khan"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 font-siemreap">
                            @foreach($districts as $d)
                                <option value="{{ $d->district_khan }}">
                                    {{ $d->district_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label for="village" class="block font-siemreap mb-2">ភូមិ</label>
                        <input type="text" name="village" id="village"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                            value="{{ $institute->village }}" required>
                    </div>

                    <div>
                        <label for="commune_sangkat" class="block font-siemreap mb-2">សង្កាត់</label>
                        <input type="text" name="commune_sangkat" id="commune_sangkat"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                            value="{{ $institute->commune_sangkat }}" required>
                    </div>

                    <div>
                        <label for="branch_id" class="block font-siemreap mb-2">ខេត្ត/ក្រុង</label>
                        <select name="branch_id" id="branch_id"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 font-siemreap">
                            @foreach($branches as $b)
                                <option value="{{ $b->branch_id }}">
                                    {{ $b->branch_kh }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit"
                        class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 font-siemreap">កែប្រែ</button>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
@push('JS')

@endpush