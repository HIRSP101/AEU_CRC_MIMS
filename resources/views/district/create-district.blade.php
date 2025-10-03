@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <?php
    foreach ($districts as $d) {
        $total_mem_detail[] = [
            $d->district_id,
            $d->district_name ?: '',
            $d->branch_kh ?: '',
        ];
    }
                                                    ?>
    <div class="flex justify-center h-screen bg-white">
        <div class="bg-white w-full m-5 rounded-lg shadow-md p-5">
            <div class="text-center mt-5 font-koulen text-blue-600 text-2xl">
                <h1>បង្កើតស្រុក/ខណ្ឌ</h1>
            </div>
            <form action="{{ route('district.store', ['id' => $branch->branch_id]) }}" method="POST">
                @csrf
                <div class="flex gap-3 items-end mt-12">
                    <!-- District Name -->
                    <div class="flex-1">
                        <label class="block font-siemreap uppercase tracking-wide mb-2" for="districtName">
                            <h1>ឈ្មោះស្រុក/ខណ្ឌ</h1>
                        </label>
                        <input
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 font-siemreap"
                            name="district_name" id="districtName" type="text" required>
                    </div>

                    <!-- Province -->
                    <div class="flex-1">
                        <label for="branch_id" class="block font-siemreap mb-2">ខេត្ត/ក្រុង</label>
                        <select name="branch_id" id="branch_id"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 font-siemreap">
                            @foreach($branches as $b)
                                <option value="{{ $b->branch_id }}">{{ $b->branch_kh }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex-shrink-0 mt-8">
                        <button type="submit"
                            class="bg-green-500 text-white w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 font-siemreap">បង្កើត</button>
                    </div>
                </div>
            </form>
            {{-- Table --}}
            <div class="w-full overflow-hidden max-h-[760px] mt-10">
                <table class="min-w-max w-full table-auto font-siemreap">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-2 pl-5 text-left">លេខរៀង</th>
                            <th class="py-2 text-center">ស្រុក</th>
                            <th class="py-2 text-center">រាជធានី/ខេត្ត</th>
                            <th class="py-2 text-center">action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light" id="districtTableBody"></tbody>
                </table>

                {{-- Pagination --}}
                <div class="flex justify-end mt-8">
                    <span id="paginationText" class="font-siemreap text-sm"></span>
                    <div class="flex gap-2 index_buttons"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('JS')
    <script type="module">
        import { handleTotalDistrict } from "{{ asset('js/handleTotalDistrict.js') }}";

        document.addEventListener('DOMContentLoaded', function () {
            var array = @json($districts);
            handleTotalDistrict(array);
        });
    </script>
@endpush