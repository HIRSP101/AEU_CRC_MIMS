@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <div class="bg-[#fff] p-5 rounded-lg max-w-1000px m-5 shadow-md font-battambang">
        <h1 class="text-2xl font-medium text-center font-koulen text-blue-600">ស្រុក/ខណ្ឌ នៃខេត្ត/ក្រុង
            {{ $branch->branch_kh }}
        </h1>
        <div class="filter_institute flex justify-end space-x-2 mt-5 mb-5 ">
            <a href="{{ route('village.create', ['id' => $branchId]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                បង្កើតស្រុក
            </a>
        </div>
        <ul>
            <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50  hover:ring-indigo-200 hover:rounded-lg mb-5 text-2xl ">
                <a href="{{ route('wholebranch', ['id' => $branchId]) }}">
                    <div class="flex justify-between items-center py-5 pl-5">
                        <div class="flex items-center">
                            <span class="text-lg font-battambang">សរុប </span>
                        </div>
                        <div class="grid grid-rows-2 m-5 place-items-end content-between gap-8 ">
                            <span class="text-xs font-battambang ">
                                ស.ម <strong>{{ $branchWhole->total_mem ?? 0 }} នាក់</strong>
                            </span>
                            <span class="text-xs font-battambang">
                                {{ $branchWhole->total_schools ?? 0 }} អនុសាខា
                            </span>
                        </div>
                    </div>
                </a>
            </li>
            @foreach ($villages as $village)
                <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 hover:ring-indigo-200 hover:rounded-lg mb-5">
                    <a href="{{ url('/branch/' . $branchId . '/village/' . $village->district_id . '/school') }}">
                        <div class="flex justify-between items-center py-5 pl-5">
                            <div class="flex items-center">
                                <span class="text-lg font-battambang">{{ $village->district_name }}</span>
                            </div>
                            <div class="grid grid-rows-2 m-5 place-items-end content-between gap-8">
                                <span class="text-xs font-battambang">
                                    ស.ម <strong>{{ $village->total_mem ?? 0 }} នាក់</strong>
                                </span>
                                <span class="text-xs font-battambang">
                                    {{ $village->total_schools ?? 0 }} អនុសាខា
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
        $("input#ogbranchswitch").change(function (e) {
            window.location = "{{ url('/') }}/village"
        })
        const array = @json($villages);
        let originalArray = [...array];

        function updateVillageList(data) {
            const ul = $("ul");
            ul.empty();
            data.forEach((item) => {
                ul.append(`
                                    <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 p-2 hover:ring-indigo-200 hover:rounded-lg my-2">
                                        <a href="/branch/${item.branch_id}/village/${item.village}/school">
                                            ${item.village}
                                        </a>
                                        <div class="grid grid-rows-2 m-2 place-items-end content-between gap-8">
                                            <span class="text-xs font-battambang">ស.ម <strong>${item.total_mem} នាក់</strong></span>
                                            <span class="text-xs font-battambang">${item.total_institutes} អនុសាខា</span>
                                        </div>
                                    </li>
                                `)
            })
        }
    </script>
@endpush