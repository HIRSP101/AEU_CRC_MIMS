@extends('layouts.templates.att.master')
@push('CSS')
@endpush
@if ($option == 1)
    @section('Content')
    <div class="bg-[#fff] rounded-lg max-w-1000px m-5 p-5 shadow-md font-battambang">
        <h1 class="text-2xl font-medium text-center font-koulen  text-blue-600">{{$title}}</h1>
        {{-- search bar --}}
         <div class="flex justify-between items-center mb-4 mt-14 ">
        <div class="tab_filter_container flex items-center space-x-2">
            <a href="{{ route('link-member') }}"
                class="bg-red-500 text-white px-4 py-2 rounded font-battambang">ត្រលប់ក្រោយ</a>
        </div>

        <div class="flex items-center space-x-3">
             <input type="text" id="filter_box" class="border border-gray-300 px-4 py-2 rounded-lg" placeholder="Search...">
            <button id="filter_institute_btn" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
        </div>
    </div>
        <ul>
            @foreach ($total_member_institute as $mem_tute)
                {{-- @include('institude.partials.list_institude') --}}
            @endforeach
        </ul>
    </div>
    @endsection
    @push('JS')
        <script>
            $("input#ogbranchswitch").change(function (e) {
                window.location = "{{ url('/') }}/institute"
            })
            const array = @json($total_member_institute);
            let originalArray = [...array];

            function updateInstituteList(data) {
                const ul = $("ul");
                ul.empty();
                data.forEach((item) => {
                    ul.append(`
                                            <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 hover:ring-indigo-200 hover:rounded-lg mb-5">
                                                <a href="/link-institute/${item.bhei_id}">
                                                    <div class="flex justify-between items-center">
                                                        <div class="flex items-center">
                                                            <img
                                                                src="${item.image}"
                                                                alt="Logo 1"
                                                                class="ml-5  mr-5 rounded-lg object-cover h-16"
                                                            />
                                                            <span class="text-lg font-battambang">${item.institute_kh}</span>
                                                        </div>
                                                        <div class="grid grid-rows-2 m-5 place-items-end content-between gap-8">
                                                            <span class="text-xs font-battambang">
                                                                ស.ម <strong>${item.total_members ?? 0} នាក់</strong>
                                                            </span>
                                                             <span class="text-xs font-battambang">
                                                                តំណរភ្ជាប់ <strong>${item.total_links ?? 0}</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        `)
                })
            }

            $("#filter_institute_btn").click(function () {
                const filterText = $("#filter_box").val().toLowerCase();

                const filteredArray = array.filter((item) => item.institute_kh?.toLowerCase().includes(filterText));

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
@elseif($option == 2)
    @section('Content')
    <div class="bg-[#fff] rounded-lg max-w-1000px m-5 p-5 shadow-md font-battambang">
        <h1 class="text-2xl font-medium text-center font-koulen  text-blue-600">{{$title}}</h1>
        {{-- search bar --}}
        <div class="filter_institute flex justify-end space-x-2 mt-5 mb-5 ">
            <input type="text" id="filter_box" class="border border-gray-300 px-4 py-2 rounded-lg" placeholder="Search...">
            <button id="filter_institute_btn" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
        </div>
        <ul>
            @foreach ($total_member_institute as $mem_tute)
                {{-- @include('institude.partials.list_institude') --}}
            @endforeach
        </ul>
    </div>
    @endsection

    @push('JS')
        <script>
            $("input#ogbranchswitch").change(function (e) {
                window.location = "{{ url('/') }}/institute"
            })
            const array = @json($total_member_institute);
            let originalArray = [...array];

            function updateInstituteList(data) {
                const ul = $("ul");
                ul.empty();
                data.forEach((item) => {
                    ul.append(`
                                            <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 hover:ring-indigo-200 hover:rounded-lg mb-5">
                                                <a href="/link-report-institute/${item.bhei_id}">
                                                    <div class="flex justify-between items-center">
                                                        <div class="flex items-center">
                                                            <img
                                                                src="${item.image}"
                                                                alt="Logo 1"
                                                                class="ml-5  mr-5 rounded-lg object-cover h-16"
                                                            />
                                                            <span class="text-lg font-battambang">${item.institute_kh}</span>
                                                        </div>
                                                        <div class="grid grid-rows-2 m-5 place-items-end content-between gap-8">
                                                            <span class="text-xs font-battambang">
                                                                ស.ម <strong>${item.total_members ?? 0} នាក់</strong>
                                                            </span>
                                                             <span class="text-xs font-battambang">
                                                                តំណរភ្ជាប់ <strong>${item.total_links ?? 0}</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        `)
                })
            }

            $("#filter_institute_btn").click(function () {
                const filterText = $("#filter_box").val().toLowerCase();

                const filteredArray = array.filter((item) => item.institute_kh?.toLowerCase().includes(filterText));

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
@endif