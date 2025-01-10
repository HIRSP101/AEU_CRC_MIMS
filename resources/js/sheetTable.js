import {showLoading, hideLoading} from './loadingscreen';

export default function constructSheetTable(sheetObj = {}) {
    showLoading();
    var tableHeader = `<tr>`;
    var tableValue = ``;
    var tableStructure = `<div class="w-full overflow-scroll max-h-[450px] my-4 rounded-md border-solid border-2 border-black">
    <table class="min-w-full divide-y divide-black font-siemreap"><thead class="bg-gray-600 ">`;
    const sheetEntries = Object.entries(sheetObj);
    // get table header
    const [fKey, fVal] = sheetEntries[0];

    for (const [key, value] of Object.entries(fVal)) {
        tableHeader += `<th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">${value}</th>`;
    }
    tableHeader += `</tr>`
    tableStructure += tableHeader + `</thead><tbody class="bg-white divide-y divide-gray-200">`;
    // generate the rest of the table here
    sheetEntries.slice(1).forEach(([basekey, basevalue]) => {
        tableValue +=  `<tr>`;
        for (const[subkey, subValue] of Object.entries(basevalue)) {
            if(subkey != 'village' && subkey != 'commune_sangkat' && subkey != 'district_khan' && subkey != 'provience_city') {
                tableValue += `<td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">${subValue}</td>`
            } else {
                tableValue += '';
            }
        }
        tableValue += `</tr>`;
    });
    tableStructure += tableValue + `</tbody></table></div>`;
    $("#sheetTable").html(tableStructure);
    hideLoading();
}
