import { showLoading, hideLoading } from './loadingscreen';

export default function constructSheetTable(sheetObj = {}, header = []) {
    if (Object.keys(sheetObj).length === 0) {
        console.warn("Sheet data is empty!");
        return;
    }

    let tableHeader = `<tr>`;
    let tableRows = ``;
    let tableStructure = `<div class="w-full overflow-scroll max-h-[450px] my-4 rounded-md border border-black">
        <table class="min-w-full divide-y divide-black font-siemreap">
        <thead class="bg-gray-600 text-white text-xs uppercase tracking-wider">`;

    const sheetEntries = Object.entries(sheetObj);


    const firstRowData = sheetEntries[0]?.[1] || {};
    let columnNames = Object.keys(firstRowData);
    const excludeColumns =
        ["current_home_no", "current_street_no", "current_village", "current_commune_sangkat", "current_district_khan", "current_provience_city",
            "pob_home_no", "pob_street_no", "pob_village", "pob_commune_sangkat", "pob_district_khan", "pob_provience_city"
        ];

    columnNames = columnNames.filter(col => !excludeColumns.includes(col));

    header.forEach((col) => {
        tableHeader += `<th class="px-6 py-3 text-left whitespace-nowrap">${col}</th>`;
    });
    tableHeader += `</tr>`;
    tableStructure += tableHeader + `</thead><tbody class="bg-white divide-y divide-gray-200">`;

    function formatDate(dateString) {
        if (!dateString) return "-";
        let date = new Date(dateString);
        if (isNaN(date.getTime())) return dateString; // Return as is if invalid date
        return date.toLocaleDateString("en-GB", { day: "2-digit", month: "2-digit", year: "numeric" }); // Format as DD-MM-YYYY
    }

    sheetEntries.slice(1).forEach(([rowIndex, rowData]) => {
        tableRows += `<tr>`;
        columnNames.forEach((colName) => {
            let cellValue = rowData[colName] || "-";
            if (colName === "registration_date") {
                cellValue = formatDate(cellValue);
            }
            tableRows += `<td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">${cellValue}</td>`;
        });

        tableRows += `</tr>`;
    });

    tableStructure += tableRows + `</tbody></table></div>`;
    $("#sheetTable").html(tableStructure);
}
