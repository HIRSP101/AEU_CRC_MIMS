@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <div class="bg-[#fff] p-5 rounded-lg max-w-1000px m-5 shadow-md font-battambang">
        <h1 class="text-2xl font-medium text-center font-koulen text-blue-600">
            គ្រឹះស្ថានសិក្សា កាកបាទក្រហមកម្ពុជានៃស្រុក/ខណ្ឌ {{ $village->district_name }}
        </h1>

        <div class="filter_institute flex justify-between items-center mt-14 mb-5">
            {{-- Left: create school --}}
            @canany(['2', '3'])
                <a href="{{ route('school.create', ['id' => $branchId, 'v_id' => $villageId]) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    បង្កើតសាលារៀន​
                </a>
            @endcanany

            {{-- Right: search --}}
            <div class="flex space-x-2">
                <input type="text" id="filter_box" class="border border-gray-300 px-2 py-2 rounded-lg"
                    placeholder="Search...">
                <button id="filter_school_btn" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
            </div>
        </div>

        <ul id="school-list">
            @foreach ($schools as $school)
                <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 hover:ring-indigo-200 hover:rounded-lg mb-5">
                    <a href="{{ url('/branch/' . $branchId . '/village/' . $villageId . '/school/' . $school->school_id) }}">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <span class="text-lg font-battambang ml-5">{{ $school->school_name }}</span>
                            </div>
                            <div class="grid grid-rows-2 m-5 place-items-end content-between gap-8">
                                <span class="text-xs font-battambang">
                                    ស.ម <strong>{{ $school->total_mem ?? 0 }} នាក់</strong>
                                </span>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@push('JS')
    <script>
        const array = @json($schools);
        let originalArray = [...array];

        function updateSchoolList(data) {
            const ul = $("#school-list");
            ul.empty();

            data.forEach((item) => {
                ul.append(`
                        <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 p-2 hover:ring-indigo-200 hover:rounded-lg my-2">
                            <a href="/branch/${item.branch_id}/village/${item.village_id}/school/${item.school_id}">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <img src="${item.image ?? '/default.png'}"
                                             alt="Logo"
                                             class="ml-10 w-16 mr-8 rounded-full object-cover h-16"/>
                                        <span class="text-lg font-battambang">${item.school_name}</span>
                                    </div>
                                    <div class="grid grid-rows-2 m-5 place-items-end content-between gap-8">
                                        <span class="text-xs font-battambang">
                                            ស.ម <strong>${item.total_mem ?? 0} នាក់</strong>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    `);
            });
        }

        // Button search
        $("#filter_school_btn").click(function () {
            const filterText = $("#filter_box").val().toLowerCase();
            const filteredData = array.filter((item) =>
                item.school_name.toLowerCase().includes(filterText)
            );
            updateSchoolList(filteredData);
        });

        // Live search reset
        $("#filter_box").on("input", function () {
            if ($(this).val() === "") {
                updateSchoolList(originalArray);
            }
        });

        // Initial render
        updateSchoolList(originalArray);
    </script>
@endpush