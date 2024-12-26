import ExcelJS from 'exceljs';
import constructSheetTable from './sheetTable';
import { showLoading, hideLoading } from './loadingscreen';
var columnNames = [];
var colValues = {};
var idCounter = 0;
var todelIndex = 0;
var ignoreColIndexes = [];
var sheetObj = {};
var activeSheet = "";
const branch_dict = {
    "រាជធានីភ្នំពេញ": 1, "ខេត្តសៀមរាប": 2, "ខេត្តបាត់ដំបង": 3,
    "ខេត្តព្រះសីហនុ": 4, "ខេត្តកំពង់ចាម": 5, "ខេត្តកំពត": 6,
    "ខេត្តកណ្ដាល": 7, "ខេត្តព្រះវិហារ": 8, "ខេត្តតាកែវ": 9,
    "ខេត្តបន្ទាយមានជ័យ": 10, "ខេត្តពោធិសាត់": 11, "ខេត្តស្វាយរៀង": 12,
    "ខេត្តកំពង់ធំ": 13, "ខេត្តកំពង់ស្ពឺ": 14, "ខេត្តព្រៃវែង": 15,
    "ខេត្តកែប": 16, "ខេត្តប៉ៃលិន": 17, "ខេត្តស្ទឹងត្រែង": 18,
    "ខេត្តឧត្តរមានជ័យ": 19, "ខេត្តរតនៈគិរី": 20, "ខេត្តកោះកុង": 22,
    "ខេត្តត្បូងឃ្មុំ": 23, "ខេត្តក្រចេះ": 24, "ខេត្តកំពង់ឆ្នាំង": 25, "ខេត្តមណ្ឌលគិរី": 27
};

var khDict = { "ល.រ": "member_id", "លេខកូដ": "member_code", "ឈ្មោះ (ខ្មែរ)": "name_kh", "ឈ្មោះ (អង់គ្លេស)": "name_en", "ភេទ": "gender", "ថ្ងៃខែឆ្នាំកំណើត": "date_of_birth", "ទីកន្លែងកំណើត": "pob_provience_city", "គ្រឹះស្ថានសិក្សា": "institute_id", "តួនាទី": "type", "កម្រិតសិក្សា": "education_level", "ឆ្នាំសិក្សា": "acadmedic_year", "ថ្ងៃខែឆ្នាំចូលជាសមាជិក": "registration_date", "ថ្ងៃផុតកំណត់": "expiration_date", "អាស័យដ្ឋានបច្ចុប្បន្ន": "full_current_address", "ទូរស័ព្ទផ្ទាល់ខ្លួន": "phone_number", "ទូរស័ព្ទអាណាព្យាបាល": "guardian_phone", "ហ្វេសបុក/អ៊ីម៉ែល": "email", "ទំហំអាវ": "shirt_size" }
$(document).ready(function () {

    $("#sheetBtn").change(function (e) {
        e.preventDefault();
        $("#menu").addClass("hidden");
    })



    $('#dropzone-file').on('change', async function () {

        const fileInput = $('#dropzone-file')[0];
        // console.log(fileInput);
        if (fileInput.files.length > 0) {
           // showLoading();
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
                                        columnNames = []; // Handle edge-cases (stacked/merged header columns)
                                    }
                                    if (splitValues[1] == "ល.រ" && columnNames.length == 0) {
                                        for (let i = 1; i < splitValues.length; i++) {
                                            columnNames.push(splitValues[i]);
                                        }
                                    }
                                    for (let i = 1; i < columnNames.length; i++) {
                                        if (khDict[columnNames[i]] == "date_of_birth") {  // Convert localized date to std date format for mysql (YYYY/MM/dd)
                                            if (splitValues[i + 1] != "ថ្ងៃខែឆ្នាំកំណើត") {
                                                if (containsUnicodeNumber(splitValues[i + 1])) {
                                                    colValues[rowNumber] = {
                                                        ...colValues[rowNumber],
                                                        [khDict[columnNames[i]]]: translatekhdateToen(splitValues[i + 1])
                                                    };
                                                }
                                            }
                                        } else {
                                            colValues[rowNumber] = {
                                                ...colValues[rowNumber],
                                                [khDict[columnNames[i]]]: splitValues[i + 1] == "-" ? null : splitValues[i + 1]

                                            };
                                        }


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
                        console.log(colValues);
                        //insertMember(colValues);
                    });
                    // console.log(sheetObj);
                   // hideLoading();
                    var btnElement = ``;
                    for (let i = 0; i < Object.keys(sheetObj).length; i++) {
                        btnElement += constructSheetBtn(Object.keys(sheetObj)[i]);
                    }
                    $("#menu").removeClass("hidden");
                    $("#sheetContainer").html(btnElement);
                    $("div#sheetContainer").on('click', 'button', function (e) {
                        e.preventDefault();
                        initializeProgressTracking();
                        $("div#sheetContainer").find('button').not(this).removeClass('bg-gray-800').addClass('bg-gray-300');
                        $(this).removeClass('bg-gray-800').addClass('bg-black').addClass('isactive');
                        $(this).attr('disabled', true);

                        activeSheet = $(this).text().trim();
                        constructSheetTable(sheetObj[activeSheet]);
                        // console.log(sheetObj[activeSheet]);
                    });


                    $("#sheetImport").click(function (e) {
                        e.preventDefault();
                        delete sheetObj[activeSheet][Object.keys(sheetObj[activeSheet])[0]];
                        if (activeSheet.length > 0) {
                          //  showLoading();
                            var formData = new FormData();
                            formData.append('members', JSON.stringify(sheetObj[activeSheet]));
                            //console.log(formData);
                            insertMember(formData);
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
    /*
    function insertMember(member) {
        $.ajax({
            type: 'POST',
            url: '/createmember',
            data: member,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response.message);
                hideLoading();
            },
            error: function (error) {
                console.error(error);
            }
        })
    }
    */


    function updateProgress(percentage, status = null) {
        $('#progressBar').css('width', `${percentage}%`);
        $('#progressPercentage').text(`${percentage}%`);

        if (status) {
            $('#progressStatus').text(status);
        } else if (percentage === 100) {
            $('#progressStatus').text('Import completed successfully!');
        } else {
            $('#progressStatus').text('Processing...');
        }
    }

    function showProgressBar() {
        $('#progressContainer').removeClass('hidden');
        updateProgress(0, 'Starting import...');
    }

    function hideProgressBar() {
        setTimeout(() => {
            $('#progressContainer').addClass('hidden');
            updateProgress(0);
        }, 2000);
    }

    // Modify your existing insertMember function
    function insertMember(member) {
        showProgressBar();
       // showLoading();

        $.ajax({
            type: 'POST',
            url: '/createmember',
            data: member,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                updateProgress(100, 'Import completed successfully!');
                console.log(response.message);
                setTimeout(() => {
                    hideLoading();
                    hideProgressBar();
                }, 1000);
            },
            error: function (error) {
                updateProgress(0, 'Error occurred during import');
                console.error(error);
                hideLoading();
                setTimeout(() => {
                    hideProgressBar();
                }, 3000);
            }
        });
    }

    function initializeProgressTracking() {

        const progressBarHtml = `
            <div id="progressContainer" class="hidden mt-4 w-full">
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mb-2">
                    <div id="progressBar" class="bg-blue-600 h-2.5 rounded-full transition-all duration-300" style="width: 0%"></div>
                </div>
                <div class="flex justify-between">
                    <span id="progressStatus" class="text-sm text-gray-500">Processing...</span>
                    <span id="progressPercentage" class="text-sm text-gray-500">0%</span>
                </div>
            </div>
        `;
        $("#sheetContainer").after(progressBarHtml);

        // Initialize Echo listener
        window.Echo.channel('import-progress')
            .listen('.import.progress', (e) => {
                updateProgress(e.progress);
            });
    }

    function constructSheetBtn(btntext = "") {
        var btnElement = `<button
                class="dark:text-gray-800 dark:hover:bg-gray-100 dark:bg-white sm:w-auto mt-4 text-base  text-center text-white py-6 px-6 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 bg-gray-800 hover:bg-black rounded-md">${btntext}
            </button>`
        return btnElement;
    }
    function translatekhdateToen(datestr = "") {
        try {
            if (!datestr || typeof datestr !== "string") {
                throw new Error("Invalid input: The input string must be a non-empty string.");
            }

            // Split the date string into day, month, and date components
            const parts = datestr.split(" ");
            if (parts.length !== 3) {
                throw new Error("Invalid format: The input string must be in 'day month date' format.");
            }

            const [day_uni_str, month_uni_str, date_uni_str] = parts;

            // Month dictionary for translating Khmer month to numeric month
            const month_uni_dict = {
                "មករា": "01", "កុម្ភៈ": "02", "មីនា": "03", "មេសា": "04", "ឧសភា": "05",
                "មិថុនា": "06", "កក្កដា": "07", "សីហា": "08", "កញ្ញា": "09", "តុលា": "10",
                "វិច្ឆិកា": "11", "ធ្នូ": "12"
            };

            // Date unicode to number translation dictionary
            const date_unicode_val = {
                "6112": "0", "6113": "1", "6114": "2", "6115": "3", "6116": "4", "6117": "5",
                "6118": "6", "6119": "7", "6120": "8", "6121": "9"
            };

            // Helper function to translate Unicode characters to numbers
            const transNum = (str) => {
                return [...str]
                    .map(char => date_unicode_val[char.codePointAt(0).toString()] || char) // Replace valid characters, keep others
                    .join('');
            };

            const transDayNum = transNum(day_uni_str);
            const transDateNum = transNum(date_uni_str);

            if (!month_uni_dict[month_uni_str]) {
                throw new Error(`Invalid month: "${month_uni_str}" is not a recognized Khmer month.`);
            }

            const result = `${transDateNum}/${month_uni_dict[month_uni_str]}/${transDayNum}`;
            // console.log(result);
            return result;
        } catch (error) {
            console.error(`Error: ${error.message}`);
            return null;  // Return null or handle the error as needed
        }
    }


    const regex = /[\u17E0-\u17E9]/;
    function containsUnicodeNumber(s) {
        return regex.test(s);
    }
});

