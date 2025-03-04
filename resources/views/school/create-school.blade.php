@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    @php
    
    @endphp
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <div class="bg-white px-[10%] py-[5%] rounded-lg shadow-md w-[97%] h-[95%]">
            <div class="text-center text-2xl font-bold mb-6 font-siemreap">
                <h1>បង្កើតសាលារៀន​</h1>
            </div>

            <form action="{{ route('school.store', ['id' => $branch->branch_id, 'v_id' => $village->district_id]) }}" method="POST">
                @csrf
                <div class="grid gap-4">
                    <div>
                        <label for="school_name" class="block font-siemreap mb-2">ឈ្មោះសាលារៀន</label>
                        <input type="text" name="school_name" id="school_name" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="type" class="block font-siemreap mb-2">ប្រភេទ</label>
                            <select name="type" id="type" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 font-siemreap">
                                <option value="អនុវិទ្យាល័យ">អនុវិទ្យាល័យ</option>
                                <option value="វិទ្យាល័យ">វិទ្យាល័យ</option>
                                <option value="សាកលវិទ្យាល័យ">សាកលវិទ្យាល័យ</option>
                            </select>
                        </div>
                        <div>
                            <label for="registration_date" class="block font-siemreap mb-2">ថ្ងៃចូលសមាជិក</label>
                            <input type="date" name="registration_date" id="registration_date" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="village_name" class="block font-siemreap mb-2">ភូមិ</label>
                            <input type="text" name="village_name" id="village_name" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
                        </div>
                        <div>
                            <label for="khom" class="block font-siemreap mb-2">ឃុំ</label>
                            <input type="text" name="khom" id="khom" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
                        </div>
                        <div>
                            <label for="district_id" class="block font-siemreap mb-2">ស្រុក/ខណ្ឌ</label>
                            <select name="district_id" id="district_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 font-siemreap">
                                @foreach($villages as $v)
                                    <option value="{{ $v->district_id }}" {{ $v->district_id == $village->district_id ? 'selected' : '' }}>
                                        {{ $v->district_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="branch_id" class="block font-siemreap mb-2">ខេត្ត/ក្រុង</label>
                            <select name="branch_id" id="branch_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 font-siemreap">
                                @foreach($branches as $b)
                                    <option value="{{ $b->branch_id }}" {{ $b->branch_id == $branch->branch_id ? 'selected' : '' }}>
                                        {{ $b->branch_kh }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 font-siemreap">បង្កើត</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('JS')
    <script>
        document.getElementById("branch_id").addEventListener("change", function() {
            let branchId = this.value;
            fetch(`/getVillages/${branchId}`)
            .then(response => response.json())
            .then(data => {
                let villageSelect = document.getElementById("district_id");
                villageSelect.innerHTML = "";
                    data.forEach(village => {
                        let option = document.createElement("option");
                        option.value = village.district_id;
                        option.textContent = village.district_name;
                        villageSelect.appendChild(option);
                    });
            });
        });

    </script>
@endpush
