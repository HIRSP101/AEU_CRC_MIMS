@extends('layouts.templates.att.master')
@push('CSS')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

@section('Content')

<div class="bg-white m-5 shadow-lg rounded-lg">
    <div class="flex justify-between items-center mb-4 mt-14 px-4">
        <div class="tab_filter_container flex items-center space-x-2">
            <a href="{{ route('link-member') }}"
                class="bg-red-500 text-white px-4 py-2 rounded font-battambang">ត្រលប់ក្រោយ</a>
        </div>
    </div>
    @if(count($link) > 0)
        @foreach ($link as $branch => $links)
            <div class="m-5">
                <h2 class="text-lg font-bold bg-gray-300 text-center font-battambang mt-5 py-3">{{ $branch }}</h2>
                <table class="min-w-max w-full table-auto font-siemreap">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm font-battambang text-center">
                            <th class="py-3 w-1/3">ល.រ</th>
                            <th class="py-3 w-1/3">ឆ្នាំសិក្សា</th>
                            <th class="py-3 w-1/3">សកម្មភាព</th>
                        </tr>
                    </thead>
                    @foreach ($links as $link)
                        <tr data-id="{{$link->id}}" class="border-b border-gray-200 hover:bg-gray-100 link-row text-center">
                            <td class="py-3 w-1/3">
                                {{$loop->iteration }}
                            </td>
                            <td class="py-3 w-1/3">
                                {{$link->academic_year}}
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