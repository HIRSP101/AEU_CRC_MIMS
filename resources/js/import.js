import ExcelJS from "exceljs";
import constructSheetTable from "./sheetTable";
var sheetObj = {};
var activeSheet = "";
const branch_dict = {
    រាជធានីភ្នំពេញ: 1,
    ខេត្តសៀមរាប: 2,
    ខេត្តបាត់ដំបង: 3,
    ខេត្តព្រះសីហនុ: 4,
    ខេត្តកំពង់ចាម: 5,
    ខេត្តកំពត: 6,
    ខេត្តកណ្ដាល: 7,
    ខេត្តព្រះវិហារ: 8,
    ខេត្តតាកែវ: 9,
    ខេត្តបន្ទាយមានជ័យ: 10,
    ខេត្តពោធិសាត់: 11,
    ខេត្តស្វាយរៀង: 12,
    ខេត្តកំពង់ធំ: 13,
    ខេត្តកំពង់ស្ពឺ: 14,
    ខេត្តព្រៃវែង: 15,
    ខេត្តកែប: 16,
    ខេត្តប៉ៃលិន: 17,
    ខេត្តស្ទឹងត្រែង: 18,
    ខេត្តឧត្តរមានជ័យ: 19,
    ខេត្តរតនៈគិរី: 20,
    ខេត្តកោះកុង: 22,
    ខេត្តត្បូងឃ្មុំ: 23,
    ខេត្តក្រចេះ: 24,
    ខេត្តកំពង់ឆ្នាំង: 25,
    ខេត្តមណ្ឌលគិរី: 27,
};

var khDict = {
    "នាម គោត្តនាម": "name_kh",
    "ឈ្មោះឡាតាំង": "name_en",
    "ភេទ": "gender",
    "ថ្ងៃខែឆ្នាំកំណើត": "date_of_birth",
    "ទីកន្លែងកំណើត": "pob_provience_city",
    "គ្រឹះស្ថានសិក្សា": "institute_id",
    "តួនាទី": "type",
    "កម្រិតសិក្សា": "education_level",
    "ទទួលបានវគ្គបណ្ដុះបណ្ដាល": "training_received",
    "ពិការភាព": "member_status",
    "ឆ្នាំសិក្សា": "acadmedic_year",
    "ថ្ងៃខែឆ្នាំចូលជាសមាជិក": "registration_date",
    "អាសយដ្ឋានបច្ចុប្បន្ន": "full_current_address",
    "ទូរស័ព្ទផ្ទាល់ខ្លួន/តេលេក្រាម": "phone_number",
    "ទូរស័ព្ទអាណាព្យាបាល": "guardian_phone",
    "ទំហំអាវ": "shirt_size",
    "ផ្ទះលេខ": "home_no",
    "ផ្លូវលេខ": "street_no",
    "ភូមិ": "village",
    "ឃុំ/សង្កាត់": "commune_sangkat",
    "ស្រុក/ខណ្ឌ": "district_khan",
    "ខេត្តរាជធានី": "provience_city",
};

$(document).ready(function () {
    var school_id = "";
    //start up code goes here
    getDistrctKhan();
    $.ajax({
        type: "GET",
        url: "/getBranchByUser",
        data: {},
        success: function (data) {
            $("#branch_name").val(data[0].branch_kh);
            
        },
        failure: function (response) {
            alert(response.responseText);
        },
        error: function (response) {
            alert(response.responseText);
        }
    });

    //select Change event on district and school
    $("#district-select").on("change", function () {
        var dId = $("#district-select").val();
        $("#import-section").addClass("hidden");
            getSchool(dId);
    });
    $("#school-select").on("change", function () {
        var sId = $("#school-select").val();
        school_id = sId;
        console.log(sId);
        
        $("#import-section").removeClass("hidden");
    });

    $("#sheetBtn").on("click", function (e) {
        e.preventDefault();
        $("#menu").addClass("hidden");
    });
    $("#dropzone-file").on("change", async function () {
        var columnNames = [];
        var startRow = 0;
        var lastRow = 0;
        var colValues = {};
        sheetObj = {};
        activeSheet = "";
        const fileInput = $("#dropzone-file")[0];
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onload = async function (event) {
                try {
                    const workbook = new ExcelJS.Workbook();
                    const fileArrayBuffer = event.target.result;

                    await workbook.xlsx.load(fileArrayBuffer);

                    workbook.eachSheet((worksheet, sheetId) => {
                        console.log(`Sheet Name: ${worksheet.name}, ${sheetId}`);

                        const allData = worksheet.getSheetValues();
                        console.log("All sheet data:", allData);
                        const rowCount = worksheet.rowCount;

                        let startRow = null;
                        let lastRow = null;
                        let colValues = {};

                        worksheet.eachRow((row, rowNumber) => {
                            const rowValues = row.values.slice(1);
                            if (rowValues.includes("ល.រ")) {
                                columnNames = rowValues.slice(1);
                                startRow = rowNumber;
                            }

                            if (rowValues.some(val => val && val.toString().includes("សរុបចំនួន"))) {
                                lastRow = rowNumber;
                            }
                        });

                        if (startRow && lastRow) {
                            for (let i = startRow; i < lastRow; i++) {
                                let row = worksheet.getRow(i);
                                let rowData = row.values.slice(2).map(cell => {
                                    if (cell && typeof cell === "object" && cell.result !== undefined) {
                                        return cell.result;
                                    }
                                    return cell !== null && cell !== undefined ? cell : null;
                                });
                                let rowObject = {};
                                columnNames.forEach((colName, index) => {
                                    let cellValue = rowData[index] || null;
                                    if (colName === "ថ្ងៃខែឆ្នាំកំណើត" && containsUnicodeNumber(cellValue)) {
                                        cellValue = translatekhdateToen(cellValue);
                                    }
                                    if (colName === "អាសយដ្ឋានបច្ចុប្បន្ន") {
                                        const addressParts = (cellValue || "").split(" ").filter(part => part.trim() !== "");
                                        const address = reverseCurrentArrayAddress(addressParts);
                                        rowObject["home_no"] = address[0] || null;
                                        rowObject["street_no"] = address[1] || null;
                                        rowObject["village"] = address[2] || null;
                                        rowObject["commune_sangkat"] = address[3] || null;
                                        rowObject["district_khan"] = address[4] || null;
                                        rowObject["provience_city"] = address[5] || null;
                                    }
                                    rowObject[khDict[colName]] = cellValue;
                                });

                                colValues[i] = rowObject;
                            }
                        }
                        sheetObj[worksheet.name] = colValues;


                    });

                    var btnElement = ``;
                    for (let i = 0; i < Object.keys(sheetObj).length; i++) {
                        btnElement += constructSheetBtn(
                            Object.keys(sheetObj)[i]
                        );
                    }
                    $("#menu").removeClass("hidden");
                    $("#sheetContainer").html(btnElement);
                    $("div#sheetContainer").on("click", "button", function (e) {
                        e.preventDefault();
                        $("div#sheetContainer")
                            .find("button")
                            .not(this)
                            .removeClass("bg-gray-800")
                            .addClass("bg-gray-300");
                        $(this)
                            .removeClass("bg-gray-800")
                            .addClass("bg-black")
                            .addClass("isactive");
                        $(this).attr("disabled", true);

                        activeSheet = $(this).text().trim();

                        constructSheetTable(sheetObj[activeSheet], columnNames);
                        console.log("sheetobj=>", sheetObj[activeSheet]);

                    });
                } catch (error) {
                    console.error("Error reading Excel file:", error);
                }
            };
            reader.readAsArrayBuffer(file);
        }
    });

    $("#sheetImport").on("click", function () {
        if (!activeSheet || !sheetObj[activeSheet]) {
            alert("No active sheet selected!");
            return;
        }

        let memberData = Object.values(sheetObj[activeSheet]);
        memberData = memberData.map(member => ({
            ...member,
            school_id: school_id 
        }));
        
        console.log("memberData=>", memberData);
        insertMember(memberData.slice(1));
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function insertMember(member) {
        $.ajax({
            url: "/importmember",
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify({ members: member }),
            success: function (response) {
                console.log("Success:", response);
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseText);
            }
        });
    }



    function constructSheetBtn(btntext = "") {
        var btnElement = `<button
                class="dark:text-gray-800 dark:hover:bg-gray-100 dark:bg-white sm:w-auto mt-4 text-base  text-center text-white py-6 px-6 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 bg-gray-800 hover:bg-black rounded-md">${btntext}
            </button>`;
        return btnElement;
    }
    function translatekhdateToen(datestr = "") {
        try {
            if (!datestr || typeof datestr !== "string") {
                throw new Error(
                    "Invalid input: The input string must be a non-empty string."
                );
            }

            // Split the date string into day, month, and date components
            const parts = datestr.split(" ");
            const [day_uni_str, month_uni_str, date_uni_str] = parts;

            // Month dictionary for translating Khmer month to numeric month
            const month_uni_dict = {
                មករា: "01",
                កុម្ភៈ: "02",
                មីនា: "03",
                មេសា: "04",
                ឧសភា: "05",
                មិថុនា: "06",
                កក្កដា: "07",
                សីហា: "08",
                កញ្ញា: "09",
                តុលា: "10",
                វិច្ឆិកា: "11",
                ធ្នូ: "12",
            };

            // Date unicode to number translation dictionary
            const date_unicode_val = {
                6112: "0",
                6113: "1",
                6114: "2",
                6115: "3",
                6116: "4",
                6117: "5",
                6118: "6",
                6119: "7",
                6120: "8",
                6121: "9",
            };

            // Helper function to translate Unicode characters to numbers
            const transNum = (str) => {
                return [...str]
                    .map(
                        (char) =>
                            date_unicode_val[char.codePointAt(0).toString()] ||
                            char
                    ) // Replace valid characters, keep others
                    .join("");
            };

            const transDayNum = transNum(day_uni_str);
            const transDateNum = transNum(date_uni_str);

            if (!month_uni_dict[month_uni_str]) {
                throw new Error(
                    `Invalid month: "${month_uni_str}" is not a recognized Khmer month.`
                );
            }

            const result = `${transDateNum}-${month_uni_dict[month_uni_str]}-${transDayNum}`;
            // console.log(result);
            return result;
        } catch (error) {
            console.error(`Error: ${error.message}`);
            return null; // Return null or handle the error as needed
        }
    }

    const regex = /[\u17E0-\u17E9]/;
    function containsUnicodeNumber(s) {
        return regex.test(s);
    }

    function reverseCurrentArrayAddress(addressParts) {

        const addressLength = Array(6).fill("");

        const trimmedParts = addressParts.map(part => part.trim()).filter(part => part !== "");

        let targetIndex = 5;
        for (let i = trimmedParts.length - 1; i >= 0 && targetIndex >= 0; i--) {
            addressLength[targetIndex] = trimmedParts[i];
            targetIndex--;
        }

        return addressLength;
    }

    $("#importBtn").on("click", function () {

    });


    // get district and khan automatically when user login by Id join to userbind
    function getDistrctKhan() {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: "GET",
                url: '/getDistrictByUserLogin',
                data: {},
                success: function (data) {
                    console.log(data);
                    var selectList = $('#district-select');
                    selectList.empty();
                    selectList.append(`<option value="">--------------------------------</option>`);
                    $.each(data, function (index, item) {
                        selectList.append($('<option>', {
                            value: item.district_id,
                            text: item.district_name
                        }));
                    });
                },
                failure: function (response) {
                    alert(response.responseText);
                },
                error: function (response) {
                    alert(response.responseText);
                }
            });
        });
    }

    // get school and khan automatically when user login by Id join to userbind  
    function getSchool(district_id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: "GET",
                url: `/getSchoolByDistrictId/${district_id}`,
                data: {},
                success: function (data) {
                    console.log(data);
                    var selectList = $('#school-select');
                    selectList.empty();
                    selectList.append(`<option value="">--------------------------------</option>`);
                    $.each(data, function (index, item) {
                        selectList.append($('<option>', {
                            value: item.school_id,
                            text: item.school_name
                        }));
                    });
                },
                failure: function (response) {
                    alert(response.responseText);
                },
                error: function (response) {
                    alert(response.responseText);
                }
            });

        });
    }

});
