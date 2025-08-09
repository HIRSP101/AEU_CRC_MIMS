@extends('layouts.templates.att.master')
@push('CSS')
@endpush
@section('Content')

<div class="bg-white m-5 p-5 shadow-lg rounded-lg">
    <h1 class="text-2xl font-medium text-center font-koulen text-blue-600">
        {{ $title }}
    </h1>
    <div class="flex justify-between items-center mb-4 mt-14 ">
        <div class="tab_filter_container flex items-center space-x-2">
            <a href="{{ route('link-report') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded font-battambang">របាយការណ៍</a>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('create-link') }}" id="delete"
                class="bg-green-500 text-white px-4 py-2 rounded font-battambang">បង្កើត
                Link</a>
        </div>
    </div>
    @if (auth()->user()->branch_bindding_user[0]->branch == null)
        @if (count($link) == 0)
            <div class="flex flex-col items-center justify-center h-screen space-y-4">
                <img src={{asset('images/not.png')}} alt="No Data" width="150" height="150">
                <p class="font-siemreap">មិនមានទិន្នន័យគ្រប់គ្រង</p>
            </div>
        @else
            @foreach ($link as $branch => $links)
                <div>
                    <h2 class="text-lg font-bold bg-gray-300 text-center font-battambang mt-5 py-3">{{ $branch }}</h2>
                    <table class="min-w-max w-full table-auto font-siemreap">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm font-battambang">
                                <th class="py-3">ល.រ</th>
                                <th class="py-3">ឆ្នាំសិក្សា</th>
                                <th class="py-3">តំណរភ្ជាប់</th>
                                <th class="py-3">សកម្មភាព</th>
                            </tr>
                        </thead>
                        @foreach ($links as $link)
                            <tr data-id="{{$link->id}}" class="border-b border-gray-200 hover:bg-gray-100 text-center link-row">
                                <td class="py-3">{{$loop->iteration }}</td>
                                <td class="py-3">{{$link->academic_year}}</td>
                                <td class="py-3">
                                    <button class="bg-red-500 text-white px-4 py-2 rounded copy-link"
                                        data-id="{{$link->token}}">Link</button>
                                </td>
                                <td class="py-3 w-1/3 ">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded update_btn"
                                        data-id="{{$link->id}}">កែប្រែ</button>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded delete_btn"
                                        data-id="{{$link->id}}">លុប</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endforeach
        @endif
        @push('JS')
            <script>
                $(document).on('click', '.delete-link', function () {
                    const linkId = $(this).data('id');
                    console.log("Link ID to delete:", linkId);
                    if (confirm("តើអ្នកពិតជាចង់លុប Link នេះទេ?")) {
                        $.ajax({
                            url: "{{ route('link-delete') }}",
                            type: 'DELETE',
                            data: {
                                id: linkId,
                            },
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            success: function (response) {
                                alert(response.message);
                                if (response.status === 200) {
                                    location.reload();
                                }
                            },
                            error: function (error) {
                                console.error("Error deleting link:", error);
                            }
                        });
                    }
                });
                $(document).on('click', '.copy-link', function () {
                    const linkToken = $(this).data('id');
                    const link = `${window.location.origin}/member-registration/${linkToken}`;
                    navigator.clipboard.writeText(link).then(() => {
                        alert("Link ត្រូវបានចម្លងទៅកាន់ Clipboard រួចរាល់!");
                    }).catch(err => {
                        console.error("Failed to copy link:", err);
                    });
                });
                $(document).on('click', '.update_btn', function () {
                    const linkId = $(this).data('id');
                    window.location.href = `/link-report/${linkId}/edit`;
                });
                $(".link-row").on("dblclick", function (e) {
                    e.preventDefault();
                    const linkId = $(this).data('id');
                    console.log("Double clicked on link row");
                    window.location.href = `/link-detail/${linkId}`;
                });
            </script>
        @endpush
    @elseif(auth()->user()->hasRole('admin') && $admin && $option == 1)
        @if (count($link) == 0)
            <div class="flex flex-col items-center justify-center h-screen space-y-4">
                <img src={{asset('images/not.png')}} alt="No Data" width="150" height="150">
                <p class="font-siemreap">មិនមានទិន្នន័យគ្រប់គ្រង</p>
            </div>
        @else
            @foreach ($link as $branch => $links)
                <div>
                    <h2 class="text-lg font-bold bg-gray-300 text-center font-battambang mt-5 py-3">{{ $branch }}</h2>
                    <table class="min-w-max w-full table-auto font-siemreap">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm font-battambang">
                                <th class="py-3">ល.រ</th>
                                <th class="py-3">ឆ្នាំសិក្សា</th>
                                <th class="py-3">តំណរភ្ជាប់</th>
                                <th class="py-3">សកម្មភាព</th>
                            </tr>
                        </thead>
                        @foreach ($links as $link)
                            <tr data-id="{{$link->id}}" class="border-b border-gray-200 hover:bg-gray-100 text-center link-row">
                                <td class="py-3">{{$loop->iteration }}</td>
                                <td class="py-3">{{$link->academic_year}}</td>
                                <td class="py-3">
                                    <button class="bg-red-500 text-white px-4 py-2 rounded copy-link"
                                        data-id="{{$link->token}}">Link</button>
                                </td>
                                <td class="py-3 w-1/3 ">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded update_btn"
                                        data-id="{{$link->id}}">កែប្រែ</button>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded delete_btn"
                                        data-id="{{$link->id}}">លុប</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endforeach
        @endif
        @push('JS')
            <script>
                $(document).on('click', '.delete-link', function () {
                    const linkId = $(this).data('id');
                    console.log("Link ID to delete:", linkId);
                    if (confirm("តើអ្នកពិតជាចង់លុប Link នេះទេ?")) {
                        $.ajax({
                            url: "{{ route('link-delete') }}",
                            type: 'DELETE',
                            data: {
                                id: linkId,
                            },
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            success: function (response) {
                                alert(response.message);
                                if (response.status === 200) {
                                    location.reload();
                                }
                            },
                            error: function (error) {
                                console.error("Error deleting link:", error);
                            }
                        });
                    }
                });
                $(document).on('click', '.copy-link', function () {
                    const linkToken = $(this).data('id');
                    const link = `${window.location.origin}/member-registration/${linkToken}`;
                    navigator.clipboard.writeText(link).then(() => {
                        alert("Link ត្រូវបានចម្លងទៅកាន់ Clipboard រួចរាល់!");
                    }).catch(err => {
                        console.error("Failed to copy link:", err);
                    });
                });
                $(document).on('click', '.update_btn', function () {
                    const linkId = $(this).data('id');
                    window.location.href = `/link-report/${linkId}/edit`;
                });
                $(".link-row").on("dblclick", function (e) {
                    e.preventDefault();
                    const linkId = $(this).data('id');
                    console.log("Double clicked on link row");
                    window.location.href = `/link-detail/${linkId}`;
                });
            </script>
        @endpush
    @elseif(auth()->user()->hasRole('admin') && $admin && $option == 2)    
        @if (count($link) == 0)
            <div class="flex flex-col items-center justify-center h-screen space-y-4">
                <img src={{asset('images/not.png')}} alt="No Data" width="150" height="150">
                <p class="font-siemreap">មិនមានទិន្នន័យគ្រប់គ្រង</p>
            </div>
        @else
            @foreach ($link as $branch => $links)
                <div>
                    <h2 class="text-lg font-bold bg-gray-300 text-center font-battambang mt-5 py-3">{{ $branch }}</h2>
                    <table class="min-w-max w-full table-auto font-siemreap">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm font-battambang">
                                <th class="py-3">ល.រ</th>
                                <th class="py-3">ឆ្នាំសិក្សា</th>
                                <th class="py-3">តំណរភ្ជាប់</th>
                                <th class="py-3">សកម្មភាព</th>
                            </tr>
                        </thead>
                        @foreach ($links as $link)
                            <tr data-id="{{$link->id}}" class="border-b border-gray-200 hover:bg-gray-100 text-center link-row">
                                <td class="py-3">{{$loop->iteration }}</td>
                                <td class="py-3">{{$link->academic_year}}</td>
                                <td class="py-3">
                                    <button class="bg-red-500 text-white px-4 py-2 rounded copy-link"
                                        data-id="{{$link->token}}">Link</button>
                                </td>
                                <td class="py-3 w-1/3 ">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded update_btn"
                                        data-id="{{$link->id}}">កែប្រែ</button>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded delete_btn"
                                        data-id="{{$link->id}}">លុប</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endforeach
        @endif
        @push('JS')
            <script>
                $(document).on('click', '.delete_btn', function () {
                    const linkId = $(this).data('id');
                    // console.log("Link ID to delete:", linkId);
                    if (confirm("តើអ្នកពិតជាចង់លុប Link នេះទេ?")) {
                        $.ajax({
                            url: "{{ route('link-delete') }}",
                            type: 'DELETE',
                            data: {
                                id: linkId,
                            },
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            success: function (response) {
                                alert(response.message);
                                if (response.status === 200) {
                                    location.reload();
                                }
                            },
                            error: function (error) {
                                console.error("Error deleting link:", error);
                            }
                        });
                    }
                });
                $(document).on('click', '.copy-link', function () {
                    const linkToken = $(this).data('id');
                    const link = `${window.location.origin}/member-registration/${linkToken}`;
                    navigator.clipboard.writeText(link).then(() => {
                        alert("Link ត្រូវបានចម្លងទៅកាន់ Clipboard រួចរាល់!");
                    }).catch(err => {
                        console.error("Failed to copy link:", err);
                    });
                });
                $(document).on('click', '.update_btn', function () {
                    const linkId = $(this).data('id');
                    window.location.href = `/link-report/${linkId}/edit`;
                });
                $(".link-row").on("dblclick", function (e) {
                    e.preventDefault();
                    const linkId = $(this).data('id');
                    window.location.href = `/link-detail-approved/${linkId}`;
                });
            </script>
        @endpush
    @elseif(auth()->user()->hasRole('admin') && !$admin)
            <ul>
                <li class="border-b bg-slate-50 rounded-lg hover:bg-indigo-50 hover:ring-indigo-200 hover:rounded-lg mb-5">
                    <a href="{{route(name: 'link-institute')}}">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="https://img.icons8.com/external-gradak-royyan-wijaya/24/external-building-gradak-medical-solidarity-gradak-royyan-wijaya.png"
                                    alt="Logo 1" class="ml-5  mr-5 rounded-lg object-cover h-8" />
                                <span class="text-lg font-battambang">គ្រឹះស្ថានឧត្តមសិក្សា</span>
                            </div>
                            <div class="grid grid-rows-2 m-5 place-items-end content-between gap-8">
                                <span class="text-xs font-battambang">
                                    ស.ម <strong>{{$membersPerHei[0]->total_members ?? 0}} នាក់</strong>
                                </span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    @endif
</div>
@endsection