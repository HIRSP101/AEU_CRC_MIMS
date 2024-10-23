import ExcelJS from 'exceljs';
import constructSheetTable from './sheetTable';
import {showLoading, hideLoading} from './loadingscreen';
var columnNames = [];
var colValues = {};
var idCounter = 0;
var todelIndex = 0;
var ignoreColIndexes = [];
var sheetObj = {};
var activeSheet = "";
var khDict = { "ល.រ": "member_id", "លេខកូដ": "member_code", "ឈ្មោះ (ខ្មែរ)": "name_kh", "ឈ្មោះ (អង់គ្លេស)": "name_en", "ភេទ": "gender", "ថ្ងៃខែឆ្នាំកំណើត": "date_of_birth", "ទីកន្លែងកំណើត": "pob_provience_city", "គ្រឹះស្ថានសិក្សា": "institute_id", "តួនាទី": "type", "កម្រិតសិក្សា": "education_level", "ឆ្នាំសិក្សា": "acadmedic_year", "ថ្ងៃខែឆ្នាំចូលជាសមាជិក": "registration_date", "ថ្ងៃផុតកំណត់": "expiration_date", "អាស័យដ្ឋានបច្ចុប្បន្ន": "full_current_address", "ទូរស័ព្ទផ្ទាល់ខ្លួន": "phone_number", "ទូរស័ព្ទអាណាព្យាបាល": "guardian_phone", "ហ្វេសបុក/អ៊ីម៉ែល": "email", "ទំហំអាវ": "shirt_size" }
$(document).ready(function () {
    $("#sheetBtn").click(function (e) {
        e.preventDefault();
        $("#menu").addClass("hidden");
    })

    $('#upload-btn').on('click', async function () {

        const fileInput = $('#file-input')[0];
       // console.log(fileInput);
        if (fileInput.files.length > 0) {
            showLoading();
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onload = async function (event) {
                try {
                    const workbook = new ExcelJS.Workbook();
                    const fileArrayBuffer = event.target.result;

                    await workbook.xlsx.load(fileArrayBuffer);

                    workbook.eachSheet((worksheet, sheetId) => {
                        console.log(`Sheet Name: ${worksheet.name}, ${sheetId}`);
                        idCounter = 0;
                        ignoreColIndexes = [];
                        columnNames = [];
                        colValues = {};
                        worksheet.eachRow({ includeEmpty: false }, (row, rowNumber) => {
                            var filledRows = fillEmptySlotsWithNull(row.values);
                            var splitValues = filledRows.map(value => {
                                if (value === "ល.រ") {
                                    idCounter++;
                                    console.log("*--->*--->*---->start cutting from here");
                                }
                                console.log(value instanceof Date ? value.toLocaleDateString() : "t");
                                value = value instanceof Date ? value.toLocaleDateString() : value;
                                return typeof value === 'object' ? (value?.result ?? value?.text ?? value) : value;
                            });

                            if (splitValues.length > 0 && idCounter > 0) {
                                delete splitValues[0];
                                if (idCounter > 0) {
                                    if (columnNames.length == 0) {
                                        columnNames = []; // handle edge-cases (stacked/merged header columns)
                                    }
                                    if (splitValues[1] == "ល.រ" && columnNames.length == 0) {
                                        for (let i = 1; i < splitValues.length; i++) {
                                            columnNames.push(splitValues[i]);
                                        }
                                    }
                                    for (let i = 1; i < columnNames.length; i++) {
                                        colValues[rowNumber] = {
                                            ...colValues[rowNumber],
                                            [khDict[columnNames[i]]]: splitValues[i + 1] == "-" ? null : splitValues[i + 1]
                                        };
                                    }
                                }
                            }
                        });
                        for (const key in colValues) {
                            if (colValues[key]["full_current_address"] !== null && colValues[key]["full_current_address"] !== undefined) {
                                for (var i = 0; i < colValues[key]["full_current_address"].split(' ').length; i++) {
                                    var splitVal = colValues[key]["full_current_address"].split(' ');
                                    if (splitVal[i].includes("ភូមិ")) {
                                        colValues[key]["village"] = splitVal[i];
                                    }
                                    if (splitVal[i].includes('ឃុំ') || splitVal[i].includes('សង្កាត់')) {
                                        colValues[key]["commune_sangkat"] = splitVal[i];
                                    }
                                    if (splitVal[i].includes('ស្រុក') || splitVal[i].includes('ខណ្ឌ') || splitVal[i].includes('ក្រុង')) {
                                        colValues[key]["district_khan"] = splitVal[i];
                                    }
                                    if (splitVal[i].includes('ខេត្ត') || splitVal[i].includes('រាជធានី')) {
                                        colValues[key]["provience_city"] = splitVal[i];
                                    }
                                }
                            }
                            /*
                            if (colValues[key]["member_code"] == "លេខកូដ") {
                                delete colValues[key];
                                }
                                */
                            }
                        sheetObj[worksheet.name] = colValues;

                         //insertMember(colValues);
                    });
                   // console.log(sheetObj);
                    hideLoading();
                    var btnElement = ``;
                    for(let i = 0; i < Object.keys(sheetObj).length; i++) {
                       btnElement += constructSheetBtn(Object.keys(sheetObj)[i]);
                    }
                    $("#menu").removeClass("hidden");
                    $("#sheetContainer").html(btnElement);
                    $("div#sheetContainer").on('click', 'button', function (e) {
                        e.preventDefault();
                        $("div#sheetContainer").find('button').not(this).removeClass('bg-gray-800').addClass('bg-gray-300');
                        $(this).removeClass('bg-gray-800').addClass('bg-black').addClass('isactive');
                        $(this).attr('disabled', true);

                        activeSheet = $(this).text().trim();
                        constructSheetTable(sheetObj[activeSheet]);
                        console.log(sheetObj[activeSheet]);
                    });


                        $("#sheetImport").click(function (e) {
                            e.preventDefault();
                            delete sheetObj[activeSheet][Object.keys(sheetObj[activeSheet])[0]];
                            if(activeSheet.length > 0) {
                                showLoading();
                                insertMember(sheetObj[activeSheet]);
                            } else {
                                console.log("please select a sheet to import!!");
                            }
                        })

                } catch (error) {
                    console.error('Error reading Excel file:', error);
                    hideLoading();
                }
            };
            reader.onerror = function (error) {
                console.error('Error reading file:', error);
            };
            reader.readAsArrayBuffer(file);
        } else {
            console.log('No file selected.');
        }
    });

    function fillEmptySlotsWithNull(arr) {
        return Array.from(arr, (_, i) => {
            if (!(i in arr)) return "-";
            else return arr[i];
        });
    }

    function insertMember(member) {
        $.ajax({
            type: 'POST',
            url: '/insertmemberfr',
            data: {
                member: member
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                hideLoading();
                console.log(response.message);
            },
            error: function (error) {
                hideLoading();
                console.error(error);
            }
        })
    }

    function constructSheetBtn(btntext = "") {
        var btnElement = `<button
                class="dark:text-gray-800 dark:hover:bg-gray-100 dark:bg-white sm:w-auto mt-4 text-base  text-center text-white py-6 px-6 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 bg-gray-800 hover:bg-black rounded-md">${btntext}
            </button>`
        return btnElement;
    }
});

