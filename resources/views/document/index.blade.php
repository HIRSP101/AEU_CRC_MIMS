@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <div class="bg-[#fff] p-8 rounded-lg max-w-1000px m-5 shadow-md font-battambang">
        <h2 class="text-2xl font-medium text-center font-battambang my-2 pb-3">គ្រឹះស្ថានឧត្តមសិក្សា កាកបាទក្រហមកម្ពុជា 25 រាជធានី-​ខេត្ត</h2>
            {{-- search bar --}}
            <div class="filter_institute flex justify-end space-x-2 mt-12 mb-5">
                <input type="text" id="filter_box" class="border border-gray-300 px-2 py-2 rounded-xl" placeholder="Search...">
                <button id="filter_school_btn" class="bg-blue-500 text-white px-4 py-2 rounded-xl">Search</button>
            </div>
        <ul>
            @foreach ($document as $docs)
                {{-- <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 p-2 hover:ring-indigo-200 hover:rounded-lg my-2">
                    <a href="{{ url('/document/' . $docs->branch_id . '/' . $docs->village_id . '/' . $docs->school_id) }}">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <span class="text-lg siemreap-regular">{{ $docs->school_name }}</span>
                            </div>
                            <div class="grid grid-rows-2 m-2 place-items-end content-between gap-8">
                                <span class="text-xs siemreap-regular">
                                    ស.ម <strong>{{ $docs->total_mem ?? 0 }} នាក់</strong>
                                </span>
                            </div>
                        </div>
                    </a>
                </li> --}}
            @endforeach
        </ul>
    </div>
@endsection

@push('JS')
    <script>
        $("input#ogbranchswitch").change(function(e) {
        window.location = "{{ url('/') }}/document"
    })
    const array = @json($document);
        let originalArray = [...array];
        
        function updateInstituteList(data) {
            const ul = $("ul");
            ul.empty();
            data.forEach((item) => {
                ul.append(`
                    <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 p-2 hover:ring-indigo-200 hover:rounded-lg my-2">
                        <a href="/document/${item.school_id}">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <span class="text-lg font-battambang ml-4">${item.school_name}</span>
                                </div>
                                <div class="grid grid-rows-2 m-2 place-items-end content-between gap-8">
                                    <span class="text-xs font-battambang">
                                        ស.ម <strong>${item.total_mem ?? 0} នាក់</strong>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                `)
            })
        }

        $("#filter_school_btn").click(function () {
            const filterText = $("#filter_box").val().toLowerCase();

            const filteredArray = array.filter((item) => item.school_name?.toLowerCase().includes(filterText));

            updateInstituteList(filteredArray);
        });

        $("#filter_box").on("input", function () {
            if ($(this).val() === "") {
                updateInstituteList(originalArray);
            }
        });
        updateInstituteList(originalArray);
    </script>
@endpush
