@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <div class="bg-[#fff] p-8 rounded-lg max-w-1000px m-5 shadow-md font-siemreap">
        <h2 class="text-2xl font-bold text-center siemreap-regular my-2 pb-3">ស្រុក</h2>
            {{-- search bar --}}
            <div class="filter_institute flex justify-end space-x-2 mt-12 mb-5">
                <input type="text" id="filter_box" class="border border-gray-300 px-2 py-2 rounded" placeholder="Search...">
                <button id="filter_institute_btn" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
            </div>
        <ul>
            @foreach ($villages as $village)
                <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 p-2 hover:ring-indigo-200 hover:rounded-lg my-2">
                    <a href="{{ url('/branch/' . $branchId . '/village/' . $village->village . '/school') }}">
                        <div class="flex justify-between items-center py-4 pl-6">
                            <div class="flex items-center">
                                <span class="text-lg siemreap-regular">{{ $village->village }}</span>
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
        $("input#ogbranchswitch").change(function(e) {
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
                    </li>
                `)
            })
        }
    </script>
@endpush
