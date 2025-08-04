@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
<div class="bg-white m-5 shadow-lg rounded-lg">
    <div class="flex justify-between items-center mb-4 mt-14 px-4">
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
    @if(count($link) > 0)
        @foreach ($link as $branch => $links)
            <div class="m-5 ">
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
                                <td class="py-3">
                                    <button class="bg-red-500 text-white px-4 py-2 rounded delete-link"
                                        data-id="{{$link->id}}">លុប</button>
                                </td>
                            </tr>
                    @endforeach
                </table>
            </div>
        @endforeach
    @else
        <div class="flex flex-col items-center justify-center h-screen space-y-4">
            <img src="../images/not.png" alt="No Data" width="150" height="150">
            <p class="font-siemreap">មិនមានទិន្នន័យគ្រប់គ្រង</p>
        </div>
    @endif
</div>
@endsection
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
        $(".link-row").on("dblclick", function (e) {
            e.preventDefault();
            const linkId = $(this).data('id');
            console.log("Double clicked on link row");
            window.location.href = `/link-detail/${linkId}`;
        });
    </script>
@endpush