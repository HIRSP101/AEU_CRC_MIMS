@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <div class="bg-[#fff] p-5 rounded-lg max-w-1000px m-5 shadow-md font-battambang">
        <h1 class="text-2xl font-medium text-center font-koulen text-blue-600">
            ស្រុក/ខណ្ឌ នៃខេត្ត/ក្រុង {{ $branch->branch_kh }}
        </h1>
        <div class="filter_institute flex justify-between items-center mt-14 mb-5">
            {{-- Left side: Create District --}}
            @canany(['2', '3'])
                <a href="{{ route('village.create', ['id' => $branchId]) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    បង្កើតស្រុក
                </a>
            @endcanany

            {{-- Right side: Search --}}
            <div class="flex space-x-2">
                <input type="text" id="filter_box" class="border border-gray-300 px-2 py-2 rounded-lg"
                    placeholder="Search...">
                <button id="filter_district_btn" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    Search
                </button>
            </div>
        </div>

        <ul id="district-list"></ul>
    </div>
@endsection

@push('JS')
    <script>
        const array = @json($villages);
        let originalArray = [...array];

        function updateVillageList(data) {
            const ul = $("#district-list");
            ul.empty();

            // Always add summary block first
            ul.append(`
                                <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 hover:ring-indigo-200 mb-5 text-2xl">
                                    <a href="{{ route('wholebranch', ['id' => $branchId]) }}">
                                        <div class="flex justify-between items-center py-5 pl-5">
                                            <div class="flex items-center">
                                                <span class="text-lg font-battambang">សរុប </span>
                                            </div>
                                            <div class="grid grid-rows-2 m-5 place-items-end content-between gap-8">
                                                <span class="text-xs font-battambang">
                                                    ស.ម <strong>{{ $branchWhole->total_mem ?? 0 }} នាក់</strong>
                                                </span>
                                                <span class="text-xs font-battambang">
                                                    {{ $branchWhole->total_schools ?? 0 }} អនុសាខា
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            `);

            // Then add filtered districts
            data.forEach((item) => {
                ul.append(`
                                    <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 hover:ring-indigo-200 mb-5">
                                        <a href="/branch/{{ $branchId }}/village/${item.district_id}/school">
                                            <div class="flex justify-between items-center py-5 pl-5">
                                                <div class="flex items-center">
                                                    <span class="text-lg font-battambang">${item.district_name}</span>
                                                </div>
                                                <div class="grid grid-rows-2 m-5 place-items-end content-between gap-8">
                                                    <span class="text-xs font-battambang">
                                                        ស.ម <strong>${item.total_mem ?? 0} នាក់</strong>
                                                    </span>
                                                    <span class="text-xs font-battambang">
                                                        ${item.total_schools ?? 0} អនុសាខា
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                `);
            });
        }

        // Button search
        $("#filter_district_btn").click(function () {
            const filterText = $("#filter_box").val().toLowerCase();
            const filteredData = array.filter((item) =>
                item.district_name.toLowerCase().includes(filterText)
            );
            updateVillageList(filteredData);
        });

        // Reset when empty input
        $("#filter_box").on("input", function () {
            if ($(this).val() === "") {
                updateVillageList(originalArray);
            }
        });

        // Initial load
        updateVillageList(originalArray);
    </script>
@endpush