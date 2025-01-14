@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <div class="bg-[#fff] p-8 rounded-lg max-w-1000px m-5 shadow-md font-siemreap">
        <h2 class="text-2xl font-bold text-center siemreap-regular my-2 pb-3">គ្រឹះស្ថានឧត្តមសិក្សា កាកបាទក្រហមកម្ពុជា 25 រាជធានី-​ខេត្ត</h2>
            {{-- search bar --}}
            <div class="filter_institute flex justify-end space-x-2 mt-12 mb-5">
                <input type="text" id="filter_box" class="border border-gray-300 px-2 py-2 rounded" placeholder="Search...">
                <button id="filter_institute_btn" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
            </div>
        <ul>
            @foreach ($schools as $school)
                <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 p-2 hover:ring-indigo-200 hover:rounded-lg my-2">
                    <a href="{{ url('/branch/' . $branchId . '/village/' . $villageId . '/school/' . $school->bhei_id) }}">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img
                                    src="{{ $school->image }}"
                                    alt="Logo 1"
                                    class="ml-10 w-16 mr-8 rounded-full object-cover h-16"
                                />
                                <span class="text-lg siemreap-regular">{{ $school->institute_kh }}</span>
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
        window.location = "{{ url('/') }}/school"
    })
    const array = @json($schools);
        let originalArray = [...array];
        
        function updateSchoolList(data) {
            const ul = $("ul");
            ul.empty();
            data.forEach((item) => {
                ul.append(`
                    <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 p-2 hover:ring-indigo-200 hover:rounded-lg my-2">
                        <a href="/branch/${item.branch_id}/village/${item.village_id}/school/${item.bhei_id}">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <img
                                    src="${item.image}"
                                    alt="Logo 1"
                                    class="ml-10 w-16 mr-8 rounded-full object-cover h-16"
                                    />
                                    <span class="text-lg siemreap-regular">${item.institute_kh}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                `)
            })
        }
    </script>
@endpush
