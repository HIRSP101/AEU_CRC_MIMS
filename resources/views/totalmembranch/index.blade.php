@extends('layouts.templates.att.master')
@push('CSS')

@endpush

@section('Content')
@if(count($total_mem) > 0)
<?php
   // dd($total_mem);
  // $current_branch = $total_mem[0]->branch_name;
    $current_branch = explode(' ', $total_mem[0]->full_current_address)[3] ?? "";
   // print_r($current_branch);
    $total_mem_detail = array();
    for ($i = 0; $i < count($total_mem); $i++) {
        $total_mem_detail[$i] = array($total_mem[$i]->member_id,$total_mem[$i]->name_kh,$total_mem[$i]->name_en, $total_mem[$i]->gender, $total_mem[$i]->date_of_birth, $total_mem[$i]->member_type, $total_mem[$i]->institute_id, $total_mem[$i]->education_level, $total_mem[$i]->registration_date, $total_mem[$i]->full_current_address, $total_mem[$i]->phone_number, $total_mem[$i]->guardian_phone, $total_mem[$i]->shirt_size);
    }

?>
<div class="bg-white mt-2 mx-3 shadow-lg">
    <h1 class="text-center font-siemreap my-2 text-xl font-bold"> បញ្ជីតារាងទិន្នន័យបច្ចុប្បន្នភាពយុវជន និងអ្នកស្ម័គ្រចិត្តកាកបាទក្រហមកម្ពុជា </h1>
    <h2 class="text-center font-siemreap mb-2 text-xl font-bold"> សាខាកាកបាទក្រហមកម្ពុជា {{$current_branch}} </h2>

    
    <div class="tab_filter_container"> 
        <input type="text" id="tab_filter_text">
        <button id="tab_filter_btn" class="active">search</button>
    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>

<script>
    
    total_member = @json($total_mem_detail);
    total_stu = @json($total_total)[0]["total_mem"];
    total_stu_fem = @json($total_fem)[0]["total_mem_fem"];
    current_branch = @json($current_branch);
    console.log(total_stu);
    document.getElementById("export_excel").addEventListener("click", function () {
    // Create a new instance of a Workbook
    const workbook = new ExcelJS.Workbook();
    const worksheet = workbook.addWorksheet(current_branch);
    var tableData = total_member;

    // Merge cells for the title (if needed)
    worksheet.mergeCells("A1:M1");
    worksheet.getCell("A1").value =
        "ឯកសារយោងសំរាប់ការបញ្ជាក់ព័ត៌មាននៃការសិក្សា និងការងារ";
    worksheet.getCell("A1").font = {
        name: "Khmer OS Muol Light",
        size: 10,
    };
    worksheet.getCell("A1").alignment = { horizontal: "center" };
    worksheet.mergeCells("A2:M2");
    worksheet.getCell("A2").value = `សាខាកាកបាទក្រហមកម្ពុជា ${current_branch}`;
    worksheet.getCell("A2").font = {
        name: "Khmer OS Muol Light",
        size: 10,
    };
    worksheet.getCell("A2").alignment = { horizontal: "center" };

    // Create a table with headers
    worksheet.addTable({
        name: "MyTable", // Name of the table
        ref: "A3", // Starting point for the table (first cell)
        headerRow: true, // Indicate that the first row is a header row
        style: {
            theme: "",
            showRowStripes: false,
        },
        columns: [
            { name: "ល.រ" },
            { name: "ឈ្មោះ(ខ្មែរ)" },
            { name: "ឈ្មោះ(ឡាតាំង)" },
            { name: "ភេទ" },
            { name: "ថៃ្ង​ ខែ ឆ្នាំកំណើត" },
            { name: "តួនាទី" },
            { name: "គ្រឹះស្ថានសិក្សា" },
            { name: "កម្រិតសិក្សា" },
            { name: "ថ្ងៃចូលសមាជិក" },
            { name: "អាស័យដ្ឋានបច្ចប្បន្ន" },
            { name: "លេខទូរសព្ទ័រផ្ទាលខ្លួន" },
            { name: "លេខទូរសព្ទ័រអាណាព្យាបាល" },
            { name: "ទំហំអាវ" },
        ],
        rows: tableData,
    });
    // set column center
    // id
    worksheet.getColumn(1).alignment = {
        vertical: "middle",
        horizontal: "center",
    };
    // gender
    worksheet.getColumn(4).alignment = {
        vertical: "middle",
        horizontal: "center",
    };
    // DOB
    worksheet.getColumn(5).alignment = {
        vertical: "middle",
        horizontal: "center",
    };
    // postions
    worksheet.getColumn(6).alignment = {
        vertical: "middle",
        horizontal: "center",
    };
    // school
    worksheet.getColumn(7).alignment = {
        vertical: "middle",
        horizontal: "center",
    };
    // grade
    worksheet.getColumn(8).alignment = {
        vertical: "middle",
        horizontal: "center",
    };
    // date join member
    worksheet.getColumn(9).alignment = {
        vertical: "middle",
        horizontal: "center",
    };
    // address
    worksheet.getColumn(10).alignment = {
        vertical: "middle",
        horizontal: "center",
    };
    // phome number
    worksheet.getColumn(11).alignment = {
        vertical: "middle",
        horizontal: "center",
    };
    // phone number
    worksheet.getColumn(12).alignment = {
        vertical: "middle",
        horizontal: "center",
    };
    // size
    worksheet.getColumn(13).alignment = {
        vertical: "middle",
        horizontal: "center",
    };

    // Apply header style
    const headerRow = worksheet.getRow(3);
    headerRow.eachCell((cell) => {
        cell.fill = null; // Ensure no background color
        cell.font = {
            name: "Khmer OS Muol Light",
            size: 10,
        };
        cell.alignment = { vertical: "middle", horizontal: "center" };
    });

    // Add border only to table cells (assuming the table starts from row 4)
    const startRow = 3; // Adjust as necessary
    for (let i = startRow; i <= worksheet.lastRow.number; i++) {
        const row = worksheet.getRow(i);
        row.eachCell({ includeEmpty: true }, function (cell) {
            cell.border = {
                top: { style: "thin" },
                left: { style: "thin" },
                bottom: { style: "thin" },
                right: { style: "thin" },
            };
        });
    }
    // customize font in table
    const rowCount = tableData.length;
    for (let rowIndex = 0; rowIndex < rowCount; rowIndex++) {
        const row = worksheet.getRow(rowIndex + 4); // Row number starts from 4 (A4)
        row.eachCell((cell) => {
            cell.font = {
                name: "Khmer OS Battambang", // Set your desired font
                size: 10,
            };
        });
    }

    // Adjust column widths
    worksheet.columns = [
        { width: 5 }, // 'លេខរៀង'
        { width: 25 }, // 'ឈ្មោះ'
        { width: 30 }, // 'ឈ្មោះអង់គ្លេស'
        { width: 5 }, // 'ភេទ'
        { width: 25 }, // 'កាលបរិច្ឆេទកំណើត'
        { width: 18 }, // 'តួនាទី'
        { width: 25 }, // 'គ្រឹះស្ថានសិក្សា'
        { width: 15 }, // 'កម្រិតសិក្សា'
        { width: 25 }, // 'ថ្ងៃចូលសមាជិក'
        { width: 45 }, // 'អាស័យអាស័យដ្ឋានបច្ចុប្បន្ន'
        { width: 30 }, // 'លេខទូរស័ព្ទផ្ទាលខ្លួន'
        { width: 35 }, // 'លេខទូរស័ព្ទអាណាព្យាបាល'
        { width: 10 }, // 'ទំហំអាវ'
    ];

    // Add title after the table
    const rowAfterTable = 3 + tableData.length + 1; // Row after the table ends
    worksheet.mergeCells(`A${rowAfterTable}:I${rowAfterTable}`);
    worksheet.getCell(`A${rowAfterTable}`).value =
        `បញ្ចប់បញ្ជីត្រឹមចំនួន ${total_stu} នាក់ (ស្រី ${total_stu_fem} នាក់)`;
    worksheet.getCell(`A${rowAfterTable}`).font = {
        name: "Khmer OS Battambang", // Set your desired font
        size: 10,
    };
    worksheet.getCell(`A${rowAfterTable}`).alignment = {
        vertical: "middle",
        horizontal: "left",
    };

    worksheet.mergeCells(`J${rowAfterTable}:M${rowAfterTable}`);
    worksheet.getCell(`J${rowAfterTable}`).value =
        "រាជធានីភ្នំពេញ ថ្ងៃទី      ខែ មិថុនា ឆ្នាំ ២០១៥";
    worksheet.getCell(`J${rowAfterTable}`).font = {
        name: "Khmer OS Battambang", // Set your desired font
        size: 10,
    };
    worksheet.getCell(`J${rowAfterTable}`).alignment = {
        vertical: "middle",
        horizontal: "center",
    };
    worksheet.mergeCells(`J${rowAfterTable + 1}:M${rowAfterTable + 1}`);
    worksheet.getCell(`J${rowAfterTable + 1}`).value = "អ្នកធ្វើតារាង";
    worksheet.getCell(`J${rowAfterTable + 1}`).font = {
        name: "Khmer OS Battambang", // Set your desired font
        size: 10,
    };
    worksheet.getCell(`J${rowAfterTable + 1}`).alignment = {
        vertical: "middle",
        horizontal: "center",
    };

    // Generate Excel and download it
    workbook.xlsx
        .writeBuffer()
        .then(function (buffer) {
            const blob = new Blob([buffer], {
                type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            });
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "បញ្ជីសាខាកាកបាទក្រហមកម្ពុជា.xlsx";
            link.click();
        })
        .catch(function (error) {
            console.log("Error creating Excel file:", error);
        });
});

   // console.log(total_member);
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
        //filterRankList();
        array_length = array.length;
        max_index = array_length / table_size;
        //max_index = parseInt(array_length / table_size)

        if (array_length % table_size > 0) {
            max_index++;
        }
    }

    // function filterRankList() {
    //     var tab_filter_text = $("#tab_filter_text").val();

    //     if (tab_filter_text != '') {
    //         var temp_array = rankList.filter(function(object) {
    //             return (
    //                 object.rank.toString().includes(tab_filter_text) ||
    //                 object.name_kh.toUpperCase().includes(tab_filter_text.toUpperCase())
                    
    //             )
    //         })
    //         array = temp_array;
    //     }
    //     else {
    //         array = rankList;
    //     }

    //     array_length = array.length;
    //     displayIndexButtons();
    // }

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

    $("#tab_filter_btn").click(function() {
        current_index = 1;
        start_index = 1;
        displayIndexButtons();
    })
    

</script>

@endpush
