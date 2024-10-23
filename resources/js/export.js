document.getElementById("export_excel").addEventListener("click", function () {
    // Create a new instance of a Workbook
    const workbook = new ExcelJS.Workbook();
    const worksheet = workbook.addWorksheet("Province");
    var tableData = total_mem;
    /* const tableData = [
        [
            "",
            "រស់ ចាន់រស្មី",
            "ROS CHANRAKSMEY",
            "ស្រី",
            "០៦ មិថុនា ១៩៩៦",
            "ទីប្រឹក្សាយុវជន",
            "វិទ្យាល័យសង្គមថ្មី",
            "១២",
            "២៥ កុម្ភៈ ២០១៥",
            "ភូមិត្បែង ឃុំចម្រើន ស្រុកសង្គមថ្មី",
            "០៧១ ៤២៣៧ ៨៨៦",
            "០៨៨ ៣៣៦៦ ៤១១",
            "L",
        ],
        [
            "",
            "រស់ ចាន់រស្មី",
            "ROS CHANRAKSMEY",
            "ស្រី",
            "០៦ មិថុនា ១៩៩៦",
            "ទីប្រឹក្សាយុវជន",
            "វិទ្យាល័យសង្គមថ្មី",
            "១២",
            "២៥ កុម្ភៈ ២០១៥",
            "ភូមិត្បែង ឃុំចម្រើន ស្រុកសង្គមថ្មី",
            "០៧១ ៤២៣៧ ៨៨៦",
            "០៨៨ ៣៣៦៦ ៤១១",
            "L",
        ],
        [
            "",
            "រស់ ចាន់រស្មី",
            "ROS CHANRAKSMEY",
            "ស្រី",
            "០៦ មិថុនា ១៩៩៦",
            "ទីប្រឹក្សាយុវជន",
            "វិទ្យាល័យសង្គមថ្មី",
            "១២",
            "២៥ កុម្ភៈ ២០១៥",
            "ភូមិត្បែង ឃុំចម្រើន ស្រុកសង្គមថ្មី",
            "០៧១ ៤២៣៧ ៨៨៦",
            "០៨៨ ៣៣៦៦ ៤១១",
            "L",
        ],
        [
            "",
            "រស់ ចាន់រស្មី",
            "ROS CHANRAKSMEY",
            "ស្រី",
            "០៦ មិថុនា ១៩៩៦",
            "ទីប្រឹក្សាយុវជន",
            "វិទ្យាល័យសង្គមថ្មី",
            "១២",
            "២៥ កុម្ភៈ ២០១៥",
            "ភូមិត្បែង ឃុំចម្រើន ស្រុកសង្គមថ្មី",
            "០៧១ ៤២៣៧ ៨៨៦",
            "០៨៨ ៣៣៦៦ ៤១១",
            "L",
        ],
        [
            "",
            "រស់ ចាន់រស្មី",
            "ROS CHANRAKSMEY",
            "ស្រី",
            "០៦ មិថុនា ១៩៩៦",
            "ទីប្រឹក្សាយុវជន",
            "វិទ្យាល័យសង្គមថ្មី",
            "១២",
            "២៥ កុម្ភៈ ២០១៥",
            "ភូមិត្បែង ឃុំចម្រើន ស្រុកសង្គមថ្មី",
            "០៧១ ៤២៣៧ ៨៨៦",
            "០៨៨ ៣៣៦៦ ៤១១",
            "L",
        ],
        [
            "",
            "រស់ ចាន់រស្មី",
            "ROS CHANRAKSMEY",
            "ស្រី",
            "០៦ មិថុនា ១៩៩៦",
            "ទីប្រឹក្សាយុវជន",
            "វិទ្យាល័យសង្គមថ្មី",
            "១២",
            "២៥ កុម្ភៈ ២០១៥",
            "ភូមិត្បែង ឃុំចម្រើន ស្រុកសង្គមថ្មី",
            "០៧១ ៤២៣៧ ៨៨៦",
            "០៨៨ ៣៣៦៦ ៤១១",
            "L",
        ],
        [
            "",
            "រស់ ចាន់រស្មី",
            "ROS CHANRAKSMEY",
            "ស្រី",
            "០៦ មិថុនា ១៩៩៦",
            "ទីប្រឹក្សាយុវជន",
            "វិទ្យាល័យសង្គមថ្មី",
            "១២",
            "២៥ កុម្ភៈ ២០១៥",
            "ភូមិត្បែង ឃុំចម្រើន ស្រុកសង្គមថ្មី",
            "០៧១ ៤២៣៧ ៨៨៦",
            "០៨៨ ៣៣៦៦ ៤១១",
            "L",
        ],
        [
            "",
            "រស់ ចាន់រស្មី",
            "ROS CHANRAKSMEY",
            "ស្រី",
            "០៦ មិថុនា ១៩៩៦",
            "ទីប្រឹក្សាយុវជន",
            "វិទ្យាល័យសង្គមថ្មី",
            "១២",
            "២៥ កុម្ភៈ ២០១៥",
            "ភូមិត្បែង ឃុំចម្រើន ស្រុកសង្គមថ្មី",
            "០៧១ ៤២៣៧ ៨៨៦",
            "០៨៨ ៣៣៦៦ ៤១១",
            "L",
        ],
    ];
    */
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
    worksheet.getCell("A2").value = "សាខាកាកបាទក្រហមកម្ពុជា ខេត្ត ព្រះវិហារ";
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
        { width: 35 }, // 'អាស័យអាដ្ឋានបច្ចុប្បន្ន'
        { width: 30 }, // 'លេខទូរស័ព្ទផ្ទាលខ្លួន'
        { width: 25 }, // 'លេខទូរស័ព្ទអាណាព្យាបាល'
        { width: 10 }, // 'ទំហំអាវ'
    ];

    // Add title after the table
    const rowAfterTable = 3 + tableData.length + 1; // Row after the table ends
    worksheet.mergeCells(`A${rowAfterTable}:I${rowAfterTable}`);
    worksheet.getCell(`A${rowAfterTable}`).value =
        "បញ្ចប់បញ្ជីត្រឹមចំនួន ២៨១ នាក់ (ស្រី ១៥៣ នាក់)";
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

// document.getElementById("export_pdf").addEventListener("click", function () {
//     const { jsPDF } = window.jspdf;
//     const doc = new jsPDF();
//     const content = document.getElementById("content");

//     html2canvas(content).then((canvas) => {
//         const imgData = canvas.toDataURL("image/png");
//         const imgWidth = 210; // PDF page width in mm
//         const pageHeight = 295; // PDF page height in mm
//         const imgHeight = (canvas.height * imgWidth) / canvas.width;
//         let heightLeft = imgHeight;

//         let position = 0;

//         doc.addImage(imgData, "PNG", 0, position, imgWidth, imgHeight);
//         heightLeft -= pageHeight;

//         while (heightLeft >= 0) {
//             position = heightLeft - imgHeight;
//             doc.addPage();
//             doc.addImage(imgData, "PNG", 0, position, imgWidth, imgHeight);
//             heightLeft -= pageHeight;
//         }

//         doc.save("html-content.pdf");
//     });
// });
