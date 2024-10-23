@extends('layouts.templates.att.master')
@push('CSS')

@endpush

@section('Content')
@if(count($total_mem) > 0)
<?php
    $current_branch = explode(' ', $total_mem[0]->full_current_address)[3] ?? ""
?>
<div class="bg-white mt-2 mx-3 shadow-lg">
    <h1 class="text-center font-siemreap my-2 text-xl font-bold"> បញ្ជីតារាងទិន្នន័យបច្ចុប្បន្នភាពយុវជន និងអ្នកស្ម័គ្រចិត្តកាកបាទក្រហមកម្ពុជា </h1>
    <h2 class="text-center font-siemreap mb-2 text-xl font-bold"> សាខាកាកបាទក្រហមកម្ពុជា {{$current_branch}} </h2>

    

    <div class="flex justify-end space-x-2 mb-4 mt-10">
        <div class="tab_head_container">
            <div class="page_limit">
              {{-- <span>Shows</span> --}}
              <select id="table_size" class="text-gray-700 bg-gray-300 py-2 rounded">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
              </select>
              <span>entries</span>
            </div>
        </div>
        <button id="export_pdf" class="bg-gray-500 text-white px-4 py-2 rounded">Export PDF</button>
        <button id="export_excel" class="bg-green-500 text-white px-4 py-2 rounded">Export Excel</button>
        <a href="{{ route('createmember') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            <i class="fas fa-edit"></i> New
        </a>
        <button id="delete" class="bg-red-500 text-white px-4 py-2 rounded">Delete Multi</button>
    </div>

    <div class="w-full overflow-scroll my-3 max-h-[760px] table">
        <table>
            <thead class=" font-siemreap bg-slate-200 border-collapse border-t-2 border-black">
            <tr>
                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                    ល.រ
                </th>
                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                    គោត្តមនាម-នាម
                </th>
                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                    ភេទ
                </th>
                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                    ថ្ងៃខែឆ្នាំកំណើត
                </th>
                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                    គ្រឹះស្ថានសិក្សា
                </th>
                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                    តួនាទី
                </th>
                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                    កម្រិតសិក្សា
                </th>
                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                    ឆ្នាំសិក្សា
                </th>
                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                    អាស័យដ្ធានបច្ចុប្បន្ន
                </th>
                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                    ទូរស័ព្ទផ្ទាល់ខ្លួន
                </th>
                <th class="px-2 py-3 text-pretty border-x-2 border-black uppercase">
                    action
                </th>
            </tr>
            </thead>
            <tbody class="bg-white font-siemreap">
                @foreach($total_mem as $mem)
                    @include('totalmembranch.partials.memtable')
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-end mt-8 footer">
            <span>Showing 1 to 10 of 60 entries</span>
            <div class="px-7 py-15 bg-transparent cursor-pointer index_buttons"></div>
        </div>
    </div>
</div>
@else
    <p> no data available </p>
@endif
@endsection

@push('JS')
<script>
    

    $(".hoverablebranch").on("dblclick",function() {
        window.location = "{{ url('/') }}/member/"+$(this).attr('data-id');
    })
    $(".hoverablebranch").on("click",function() {
        $(this).toggleClass('bg-slate-300 marked')
    })
    $("#delete").on("click", function(e) {
        e.preventDefault();
        var arr = [];
        $(".marked").each(function () {
            // console.log($(this).attr('data-id'))
            arr.push($(this).attr('data-id'))
        });
        if (confirm('Are you sure you want to delete these user?')) {
            $.ajax({
                type: 'POST',
                url: '/delete_member',
                data: {
                    arr: arr
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log(response.message);
                    location.reload();
                },
                error: function (error) {
                    console.error(error);
                }
            })
        }
        console.log(arr)
    })
    
    $(document).ready(function() {
        $('.delete_one').on("click", function(e) {
            e.preventDefault();
        
            var memberId = $(this).attr('data-id');
        
            if (confirm('Are you sure you want to delete this member?')) {
                $.ajax({
                    type: 'POST',
                    url: '/delete_member_one',
                    data: {
                        member_id: memberId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.message) {
                            alert(response.message);
                            location.reload();
                        }
                    },
                    error: function (xhr) {
                        var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Failed to delete the member';
                        alert(errorMessage);
                    }
                });
            }
        });

        
    });
    
    var array = @json($total_mem);

    var array_length = 0;
    var table_size = 10;
    var start_index = 1;
    var end_index = 0;
    var current_index = 1;
    var max_index = 0;

    function preLoadCalculations() {
        array_length = array.length;
        max_index = array_length / table_size;

        if (array_length % table_size > 0) {
            max_index++;
        }
    }
    function displayIndexButtons() {
        preLoadCalculations();
        $(".index_buttons button").remove();
        $(".index_buttons").append('<button class="bg-gray-300 px-3 rounded" onclick="prev();">Previous</button>');

        for (var i = 1; i <= max_index; i++) {
            $(".index_buttons").append(
            '<button class="ml-2 bg-gray-300 px-3 rounded" onclick="indexPagination(' +
                i +
                ')" index="' +
                i +
                '">' +
                i +
                "</button>"
            );
        }
        $(".index_buttons").append('<button class="ml-2 bg-gray-300 px-3 rounded" onclick="next();">Next</button>');
        highlightIndexButton();
    }
    function highlightIndexButton() {
        start_index = (current_index - 1) * table_size + 1;
        end_index = start_index + table_size - 1;

        if (end_index > array_length) {
            end_index = array_length;
        }

        $(".footer span").text(
            "Showing " +
            start_index +
            " to " +
            end_index +
            " of " +
            array_length +
            " entries"
        );
        $(".index_buttons button").removeClass("active");
        $(".index_buttons button[index='" + current_index + "']").addClass("active");

        displayTableRows();
    }
    function displayTableRows() {
        $(".table table tbody tr").remove();
        var tab_start = start_index - 1;
        var tab_end = end_index;
        
        for (var i = tab_start; i < tab_end; i++) {
            var user = array[i];
            var tr =
            "<tr class='border-collapse border-y-2 border-x-2 border-black hover:bg-slate-300 hoverablebranch'>" +
                "<td class='px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap'>" + user["member_id"] + "</td>" +
                "<td class='px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap'>" + user["name_kh"] + "</td>" +
                "<td class='px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap'>" + user["gender"] + "</td>" +
                "<td class='px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap'>" + user["date_of_birth"] + "</td>" +
                "<td class='px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap'>" + user["institute_id"] + "</td>" +
                "<td class='px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap'>" + user["member_type"] + "</td>" +
                "<td class='px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap'>" + user["education_level"] + "</td>" +
                "<td class='px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap'>" + user["acadmedic_year"] + "</td>" +
                "<td class='px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap'>" + user["full_current_address"] + "</td>" +
                "<td class='px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap'>" + user["phone_number"] + "</td>" +
                "<td class='py-2 flex justify-center gap-5'>" +
                    "<a href='/member/" + user["member_id"] + "/edit'>" +
                        "<i class='text-green-400 fas fa-edit'></i>" +
                    "</a>" + 
                    "<button class='delete_one' data-id='" + user["member_id"] + "'>" +
                        "<i class='text-red-400 fas fa-trash'></i>" +
                    "</button>" +
                "</td>" +
            "</tr>";

            $(".table table tbody").append(tr);
        }
    }
    displayIndexButtons();

    function next() {
        if (current_index < max_index) {
            current_index++;
            highlightIndexButton();
        }
    }

    function prev() {
        if (current_index > 1) {
            current_index--;
            highlightIndexButton();
        }
    }

    function indexPagination(index) {
        current_index = parseInt(index);
        highlightIndexButton();
    }
    
    $("#table_size").change(function () {
        table_size = parseInt($(this).val());
        current_index = 1;
        start_index = 1;
        displayIndexButtons();
    });
</script>
@endpush
