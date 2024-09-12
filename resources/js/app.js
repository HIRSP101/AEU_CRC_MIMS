import ExcelJS from 'exceljs';
var columnNames = [];
var colValues = {};
var idCounter = 0;
var todelIndex = 0;
var ignoreColIndexes = [];
var khDict = {"ល.រ" : "member_id" ,"គោត្តមនាម-នាម" : "name_kh", "ឈ្មោះឡាតាំង" : "name_en", "ភេទ" : "gender", "ថ្ងៃខែឆ្នាំកំណើត" : "date_of_birth", "តួនាទី" : "type", "គ្រឹះស្ថានសិក្សា" : "institute_id","ឆ្នាំសិក្សា" : "acadmedic_year", "អាស័យដ្ឋានបច្ចុប្បន្ន" : "full_current_address", "ផុត" : "expiration_date", "ជំនាញ" : "major","លេខទូរស័ព្ទ" : "phone_number","ទំហំអាវ" : "shirt_size"}
$(document).ready(function () {

    $('#upload-btn').on('click', async function () {
        const fileInput = $('#file-input')[0];
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onload = async function (event) {
                try {
                    const workbook = new ExcelJS.Workbook();
                    const fileArrayBuffer = event.target.result;

                    await workbook.xlsx.load(fileArrayBuffer);

                    workbook.eachSheet((worksheet, sheetId) => {
                        console.log(`Sheet Name: ${worksheet.name}`);
                        idCounter = 0;
                        ignoreColIndexes = [];
                        columnNames = [];
                        worksheet.eachRow({ includeEmpty: false }, (row, rowNumber) => {
                            var splitValues = row.values.map(value => {
                                console.log(value);
                              //  console.log(value instanceof Date ? value.toLocaleDateString() : value);
                                value = value !== null ? value : "";
                                value = value instanceof Date ? value.toLocaleDateString() : value;
                                if (value !== null && value !== undefined && value.length > 0) {
                                    var [...rest] = value !== null ? value.split(',') : "";
                                    if (rest[0].trim() == "ល.រ" || rest[0].trim() == "លរ") {
                                        idCounter++;
                                        console.log("*--->*--->*---->start cutting from here");
                                    }
                                    /*else if (rest[0].trim() == "សរុប៖") {
                                        console.log("*--->*--->*---->stop cutting here!!");
                                    }*/
                                    return rest[0].trim();
                                }
                               // console.log(`Row ${rowNumber} with split values:`, typeof value === 'number' ? value : value["result"]);
                                return typeof value === 'number' ? value : (typeof value["result"] === 'number' ? value["result"] : 0);
                            });

                            if (splitValues.length > 0) {

                                for (const key in splitValues) {
                                    if (splitValues[key] == "ល.រ" || splitValues[key] == "ឆ្នាំសិក្សា") {
                                        ignoreColIndexes.push(key);
                                    }
                                }
                              //  console.log(ignoreColIndexes);
                               // delete splitValues[todelIndex];
                                //splitValues = [...new Set(splitValues)];
                                splitValues = splitValues.filter((item, index) => {

                                    if (index == ignoreColIndexes[0] || index == ignoreColIndexes[1]) {
                                        return true;
                                    }

                                    return splitValues.indexOf(item) === index;
                                })
                                if (idCounter > 0) {
                                    if (columnNames.length == 0) {
                                        columnNames = []; // handle edge-cases (stacked/merged header columns)
                                    }

                                    if (splitValues[0] == "ល.រ" && columnNames.length == 0) {
                                        for (let i = 0; i < splitValues.length; i++) {
                                            columnNames.push(splitValues[i]);
                                        }
                                    }
                                    for (let i = 0; i < columnNames.length; i++) {
                                        colValues[rowNumber] = {
                                            ...colValues[rowNumber],
                                            [khDict[columnNames[i]]]: splitValues[i]
                                        };
                                    }
                                }
                            }
                            // convert the split values to JSON
                            /*
                            const rowJson = splitValues.reduce((acc, colValues, index) => {
                                acc[`Column${index + 1}`] = colValues;
                                return acc;
                            }, {});
                            console.log(`Row ${rowNumber} as JSON:`, rowJson);
                            */

                        });
                        for (const key in colValues) {
                            colValues[key]["sangkat"] = colValues[key]["full_current_address"].split(' ')[0];
                            colValues[key]["khan"] = colValues[key]["full_current_address"].split(' ')[1];
                            colValues[key]["city"] = colValues[key]["full_current_address"].split(' ')[2];
                            if (colValues[key]["member_id"] == "ល.រ") {
                                delete colValues[key];
                            }

                        }
                        console.log(colValues);
                    });
                } catch (error) {
                    console.error('Error reading Excel file:', error);
                }
            };

            reader.onerror = function (error) {
                console.error('Error reading file:', error);
            };

            reader.readAsArrayBuffer(file);
        } else {
            console.log('No file selected.');
        }
            insertMember(colValues);

    });

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
                console.log(response.message);
            },
            error: function (error) {
                console.error(error);
            }
        })
    }
});

