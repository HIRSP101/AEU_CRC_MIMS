@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <div class="bg-[#fff] p-8 rounded-lg max-w-1000px m-5 shadow-md font-siemreap">
        <h2 class="text-2xl font-bold text-center siemreap-regular my-2 pb-3 mb-10">ស្រុក/ភូមិ នៃខេត្ត/ក្រុង
            {{ $branch->branch_kh }}
        </h2>
        <div class="filter_institute flex justify-end space-x-2 mt-12 mb-5">
            <a href="{{ route('village.create', ['id' => $branchId]) }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                New Village
            </a>
        </div>
        <ul>
            @foreach ($villages as $village)
                <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 p-2 hover:ring-indigo-200 hover:rounded-lg my-2">
                    <a href="{{ url('/branch/' . $branchId . '/village/' . $village->district_id . '/school') }}">
                        <div class="flex justify-between items-center py-4 pl-6">
                            <div class="flex items-center">
                                <span class="text-lg siemreap-regular">{{ $village->district_name }}</span>
                            </div>
                            <div class="grid grid-rows-2 m-2 place-items-end content-between gap-8">
                                <span class="text-xs siemreap-regular">
                                    ស.ម <strong>{{ $village->total_mem ?? 0 }} នាក់</strong>
                                </span>
                                <span class="text-xs siemreap-regular">
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
                                    <span class="text-xs siemreap-regular">ស.ម <strong>${item.total_mem} នាក់</strong></span>
                                    <span class="text-xs siemreap-regular">${item.total_institutes} អនុសាខា</span>
                                </div>
                            </li>
                        `)
            })
        }
    </script>
@endpush