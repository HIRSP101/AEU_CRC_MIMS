import ajaxtoRoute from "./genericCalltoRoute.js";

export function setuppagination(array)
{
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
                `<tr class='border-collapse border-y-2 border-x-2 border-black hover:bg-slate-300 hoverablebranch' data-id="${user["member_id"]}" >` +
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
                "<td class='py-2 flex justify-center gap-5 action'>" +
                `<a class="bg-green-400 px-2 py-2" href='/member/" + user["member_id"] "'>edit</a>` +
                `<button class="bg-green-400 px-2 py-2 del-one" data-id="${user["member_id"]}">delete</button>` +
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

    $("#tab_filter_btn").click(function () {
        current_index = 1;
        start_index = 1;
        displayIndexButtons();
    })
    $(".hoverablebranch").on("click", function(e) {
        if ($(e.target).closest('td').hasClass('action')) {
            return;
        }

        $(this).toggleClass('bg-slate-300 marked');
    });

    $("#delete").on("click", function(e) {
        e.preventDefault();
        var arr = [];
        $(".marked").each(function () {
            arr.push($(this).attr('data-id'))
        });
        ajaxtoRoute("POST","/deletemember", arr)
    })
    $(".del-one").click(function(e) {
        e.preventDefault();
        ajaxtoRoute("POST","/deletemember", [$(this).attr('data-id')])
    })
}