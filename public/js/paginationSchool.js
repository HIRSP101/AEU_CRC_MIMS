export default function setuppagination(array, attr_arr, updateroute) {
    let table_size = 10;
    let current_index = 1;
    let array_length = array.length;
    let max_index = Math.ceil(array_length / table_size);

    function updateDisplay() {
        const start_index = (current_index - 1) * table_size;
        const end_index = Math.min(start_index + table_size, array_length);

        $("#paginationText").text(
            `បង្ហាញពី ${
                start_index + 1
            } ដល់ ${end_index} នៃចំនួនសរុប ${array_length}`
        );

        const $tbody = $("#schoolTableBody").empty();
        for (let i = start_index; i < end_index; i++) {
            const item = array[i];
            const tr = generateTableRow(item, attr_arr, updateroute);
            $tbody.append(tr);
        }

        updatePaginationButtons();
    }

    function generateTableRow(item, attr_arr, updateroute) {
        return `
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-2 pl-5 text-left">${item[attr_arr[0]]}</td>
                <td class="py-2 text-center">${item[attr_arr[1]]}</td>
                <td class="py-2 text-center">${item[attr_arr[2]]}</td>
                <td class="py-2 text-center">${item[attr_arr[3]]}</td>
                <td class="py-2 text-center">
                    <a href="/${updateroute}/${
            item[attr_arr[0]]
        }" class="text-blue-500">កែប្រែ</a>
                    <button class="btn-delete text-red-500" data-id="${
                        item[attr_arr[0]]
                    }">លុប</button>
                </td>
            </tr>
        `;
    }

    function updatePaginationButtons() {
        const $indexButtons = $(".index_buttons").empty();

        $indexButtons.append(
            `<button ${
                current_index === 1 ? "disabled" : ""
            } class="bg-gray-300 px-3 rounded ml-3" onclick="prev()">Previous</button>`
        );

        const maxVisiblePages = 3;
        const startPage = Math.max(1, current_index - 1);
        const endPage = Math.min(max_index, startPage + maxVisiblePages - 1);

        for (let i = startPage; i <= endPage; i++) {
            $indexButtons.append(
                `<button class="${
                    i === current_index
                        ? "bg-blue-500 text-white"
                        : "bg-gray-300"
                } px-3 rounded" onclick="setPage(${i})">${i}</button>`
            );
        }

        $indexButtons.append(
            `<button ${
                current_index === max_index ? "disabled" : ""
            } class="bg-gray-300 px-3 rounded" onclick="next()">Next</button>`
        );
    }

    window.setPage = function (index) {
        current_index = index;
        updateDisplay();
    };

    window.next = function () {
        if (current_index < max_index) {
            current_index++;
            updateDisplay();
        }
    };

    window.prev = function () {
        if (current_index > 1) {
            current_index--;
            updateDisplay();
        }
    };

    updateDisplay();
}
