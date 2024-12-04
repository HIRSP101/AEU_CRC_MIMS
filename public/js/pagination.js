export default function setuppagination(array, attr_arr, updateroute) {
    let array_length = array.length;
    let table_size = 10;
    let start_index = 1;
    let end_index = 0;
    let current_index = 1;
    let max_index = Math.ceil(array_length / table_size);

    function preLoadCalculations() {
        array_length = array.length;
        max_index = Math.ceil(array_length / table_size);
    }

    function next() {
        if (current_index < max_index) {
            current_index++;
            updateDisplay();
        }
    }

    function prev() {
        if (current_index > 1) {
            current_index--;
            updateDisplay();
        }
    }

    function indexPagination(index) {
        current_index = parseInt(index);
        updateDisplay();
    }

    function displayIndexButtons() {
        preLoadCalculations();
        const $indexButtons = $(".index_buttons").empty();

        $indexButtons.append('<button class="bg-gray-300 px-3 rounded" onclick="prev();">Previous</button>');

        for (let i = 1; i <= max_index; i++) {
            $indexButtons.append(
                `<button class="ml-2 bg-gray-300 px-3 rounded" onclick="indexPagination(${i})" data-index="${i}">${i}</button>`
            );
        }

        $indexButtons.append('<button class="ml-2 bg-gray-300 px-3 rounded" onclick="next();">Next</button>');

        updateDisplay();
    }

    function updateDisplay() {
        start_index = (current_index - 1) * table_size + 1;
        end_index = Math.min(start_index + table_size - 1, array_length);

        $(".footer span").text(`Showing ${start_index} to ${end_index} of ${array_length} entries`);
        $(".index_buttons button").removeClass("active");
        $(`.index_buttons button[data-index='${current_index}']`).addClass("active");

        displayTableRows();
    }

    function displayTableRows() {
        const $tbody = $(".table table tbody").empty();
        const tab_start = start_index - 1;
        const tab_end = end_index;

        for (let i = tab_start; i < tab_end; i++) {
            const item = array[i];
            const tr = generateTableRow(item, attr_arr);
            $tbody.append(tr);
        }
    }

    function generateTableRow(item, attr_arr) {
        var {origin} = window.location;
        let rowHTML = `<tr class='border-collapse border-y-2 border-x-2 border-black hover:bg-slate-300 hoverablebranch' data-id="${item[attr_arr[0]]}">`;
        console.log(item);
        attr_arr.forEach(attr => {
            if (attr == "image") {
                rowHTML += `<td class='px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap'><img src="${origin}/${item[attr]}" class="object-contain w-auto h-[64px] mx-0 my-0 px-0 py-0"></td>`;
            } else {
                rowHTML += `<td class='px-2 py-4 text-sm text-center border-x-2 border-black whitespace-nowrap'>${item[attr]}</td>`;    
            }
        });
    
        rowHTML += `
            <td class='py-2 flex justify-center gap-5 action'>
                <a class="bg-green-400 px-2 py-2 edit" data-id="${item[attr_arr[0]]}" href='/${updateroute}/${item[attr_arr[0]]}'>edit</a>
                <button class="bg-green-400 px-2 py-2 del-one" data-id="${item[attr_arr[0]]}">delete</button>
            </td>
        </tr>`;
    
        return rowHTML;
    }
    

    displayIndexButtons();

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
    });

    window.next = next;
    window.prev = prev;
    window.indexPagination = indexPagination;
}
