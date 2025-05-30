@extends('layouts.templates.att.master')
@push('CSS')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

@section('Content')

<div class="bg-white mt-2 mx-3 shadow-lg">
        <div class="flex justify-between items-center mb-4 mt-14 px-4">
        <div class="tab_filter_container flex items-center space-x-2">
            <a href="{{ route('link-member') }}"
                class="bg-red-500 text-white px-4 py-2 rounded font-battambang">ត្រលប់ក្រោយ</a>
        </div>
    </div>
    <div class="w-full overflow-scroll mx-3 my-3 max-h-[760px]">
        <div class="w-full overflow-scroll my-3 max-h-[760px] table">
            <table class="min-w-max w-full table-auto font-siemreap">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 pl-5 text-left">
                            ល.រ
                        </th>
                        <th class="py-3 pl-20">
                            ឆ្នាំសិក្សា
                        </th>
                        <th class="py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="tableLinkBody" class="text-gray-600 text-sm font-light">
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('JS')
<script>
    $('#tableLinkBody').empty();
    const linkByUserId = @json($linkByUserId);
    if (linkByUserId.length > 0) {
        linkByUserId.forEach((link, index) => {
            $('#tableLinkBody').append(`
                            <tr data-id="${link.id}" class="border-b border-gray-200 hover:bg-gray-100 link-row">
                                <td class="py-3 pl-5 text-left whitespace-nowrap">
                                    ${index + 1}
                                </td>
                                <td class="py-3 pl-20 text-center">
                                    ${link.academic_year}
                                </td>
                                <td class="py-3 text-center">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded update_btn" data-id="${link.id }">កែប្រែ</button>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded delete_btn"   data-id="${link.id }">លុប</button>
                                </td>
                             </tr>`);
        });
    } else {
        $('#tableLinkBody').append(`
                                        <tr>
                                            <td colspan="4" class="text-center py-3">មិនមាន Link ទេ</td>
                                        </tr>
                                    `);
    }

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
    $("#tableLinkBody").on("dblclick", ".link-row", function (e) {
            e.preventDefault();
            const linkId = $(this).data('id');
            window.location.href = `/link-detail/${linkId}`;
        });
    
</script>
@endpush