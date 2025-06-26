import ExcelJS from "exceljs";

const EXCEL_CONFIG = {
    columnDefinitions: [
        { name: "ល.រ", width: 10 },
        { name: "ក្រុង/ស្រុក", width: 20 },
        { name: "ចំនួនគ្រឹះស្ថានសិក្សា", width: 20 },
        { name: "ឈ្មោះគ្រឹះស្ថានសិក្សា", width: 30 },
        { name: "មាន", width: 10 },
        { name: "អត់", width: 10 },
        { name: "សរុប", width: 10 }, // For យុវជន សរុប
        { name: "ស្រី", width: 10 }, // For យុវជន ស្រី
        { name: "សរុប", width: 10 }, // For ពិការភាព សរុប
        { name: "ស្រី", width: 10 }, // For ពិការភាព ស្រី
        { name: "សរុប", width: 10 }, // For ទីប្រឹក្សា សរុប
        { name: "ស្រី", width: 10 }, // For ទីប្រឹក្សា ស្រី
        { name: "សរុប", width: 10 }, // For ពិការភាព (second one) សរុប
        { name: "ស្រី", width: 10 }, // For ពិការភាព (second one) ស្រី
        { name: "ស្រីសរុប", width: 10 }, // ចំនួនយុវជនទទួលវគ្គ (ស្រីសរុប)
        { name: "ប្រុស", width: 10 }, // ចំនួនយុវជនទទួលវគ្គ (ប្រុស)
        { name: "ស្រីសរុប", width: 10 }, // ចំនួនយុវជនបានទទួល ឯកសណ្ឋាន (ស្រីសរុប)
        { name: "ប្រុស", width: 10 }, // ចំនួនយុវជនបានទទួល ឯកសណ្ឋាន (ប្រុស)
        { name: "ចំនួនយុវជនទទួលវគ្គ បណ្ដុះបណ្ដាល មូលដ្ឋាន", width: 50 },
        { name: "ចំនួនយុវជនបានទទួល ឯកសណ្ឋាន", width: 50 },
    ],
    fonts: {
        header: {
            name: "Khmer OS Muol Light",
            size: 10,
        },
        body: {
            name: "Khmer OS Battambang",
            size: 10,
        },
    },
};

export const createWorksheet = (workbook) => {
    const worksheet = workbook.addWorksheet("សរុបចំណូល ២០២៤");

    worksheet.columns = EXCEL_CONFIG.columnDefinitions.map((col) => ({
        width: col.width,
    }));

    const font = EXCEL_CONFIG.fonts.header;
    const border = {
        top: { style: "thin" },
        left: { style: "thin" },
        bottom: { style: "thin" },
        right: { style: "thin" },
    };
    const alignCenter = {
        vertical: "middle",
        horizontal: "center",
        wrapText: true,
    };

    // --- MERGE COLUMNS WITH 5 ROWS ---
    worksheet.mergeCells("A1:A3"); // ល.រ
    worksheet.getCell("A1").value = "ល.រ";

    worksheet.mergeCells("B1:B3"); // ក្រុង/ស្រុក
    worksheet.getCell("B1").value = "ក្រុង/ស្រុក";

    worksheet.mergeCells("C1:C3"); // ចំនួនគ្រឹះស្ថានសិក្សា
    worksheet.getCell("C1").value = "ចំនួនគ្រឹះស្ថានសិក្សា";

    worksheet.mergeCells("D1:D3"); // ឈ្មោះគ្រឹះស្ថានសិក្សា
    worksheet.getCell("D1").value = "ឈ្មោះគ្រឹះស្ថានសិក្សា";

    // --- MERGE 2 ROWS (ROW 1-2) ---
    // មានបណ្ដាញ
    worksheet.mergeCells("E1:F1");
    worksheet.getCell("E1").value = "មានបណ្ដាញ";
    worksheet.mergeCells("E2:F2");
    worksheet.getCell("E2").value = "យុវជន កក្រក";
    worksheet.getCell("E3").value = "មាន";
    worksheet.getCell("F3").value = "អត់";

    // យុវជន
    worksheet.mergeCells("G1:H1");
    worksheet.getCell("G1").value = "យុវជន";
    worksheet.getCell("G2").value = "សរុប";
    worksheet.getCell("H2").value = "ស្រី";
    worksheet.getCell("G3").value = "A";
    worksheet.getCell("H3").value = "B";

    // ពិការភាព
    worksheet.mergeCells("I1:J1");
    worksheet.getCell("I1").value = "ពិការភាព";
    worksheet.getCell("I2").value = "សរុប";
    worksheet.getCell("J2").value = "ស្រី";
    worksheet.getCell("I3").value = "C";
    worksheet.getCell("J3").value = "D";

    // ទីប្រឹក្សា
    worksheet.mergeCells("K1:L1");
    worksheet.getCell("K1").value = "ទីប្រឹក្សា";
    worksheet.getCell("K2").value = "សរុប";
    worksheet.getCell("L2").value = "ស្រី";
    worksheet.getCell("K3").value = "E";
    worksheet.getCell("L3").value = "F";

    // ពិការភាព (second)
    worksheet.mergeCells("M1:N1");
    worksheet.getCell("M1").value = "ពិការភាព";
    worksheet.getCell("M2").value = "សរុប";
    worksheet.getCell("N2").value = "ស្រី";
    worksheet.getCell("M3").value = "G";
    worksheet.getCell("N3").value = "H";

    // ចំនួនយុវជនទទួលវគ្គ បណ្ដុះបណ្ដាល មូលដ្ឋាន
    worksheet.mergeCells("O1:P2");
    worksheet.getCell("O1").value = "ចំនួនយុវជនទទួលវគ្គ បណ្ដុះបណ្ដាល មូលដ្ឋាន";
    worksheet.getCell("O3").value = "ស្រីសរុប";
    worksheet.getCell("P3").value = "ប្រុស";

    // ចំនួនយុវជនបានទទួល ឯកសណ្ឋាន
    worksheet.mergeCells("Q1:R2");
    worksheet.getCell("Q1").value = "ចំនួនយុវជនបានទទួល ឯកសណ្ឋាន";
    worksheet.getCell("Q3").value = "ស្រីសរុប";
    worksheet.getCell("R3").value = "ប្រុស";

    // Adjust columns array length to match added columns Q, R, S, T as needed if you want to add data there

    // --- Style all header rows ---
    for (let r = 1; r <= 3; r++) {
        const row = worksheet.getRow(r);
        row.height = 30;
        row.eachCell((cell) => {
            cell.font = font;
            cell.border = border;
            cell.alignment = alignCenter;
            cell.fill = {
                type: "pattern",
                pattern: "solid",
                fgColor: { argb: "FFECECEC" }, // Light gray background
            };
        });
    }

    return worksheet;
};

export const populateTable = (worksheet) => {
    const startRow = 4;

    const sampleData = [
        [
            1, // ល.រ
            "ភ្នំពេញ", // ក្រុង/ស្រុក
            3, // ចំនួនគ្រឹះស្ថានសិក្សា
            "វិទ្យាល័យ អាកាស", // ឈ្មោះគ្រឹះស្ថានសិក្សា
            0, // មានបណ្ដាញ - មាន
            0, // មានបណ្ដាញ - អត់
            10, // យុវជន សរុប
            4, // យុវជន ស្រី
            2, // ពិការភាព សរុប
            1, // ពិការភាព ស្រី
            3, // ទីប្រឹក្សា សរុប
            2, // ទីប្រឹក្សា ស្រី
            1, // ពិការភាព (second) សរុប
            1, // ពិការភាព (second) ស្រី
            5, // ចំនួនយុវជនទទួលវគ្គ (ស្រីសរុប)
            6, // ចំនួនយុវជនទទួលវគ្គ (ប្រុស)
            4, // ចំនួនយុវជនបានទទួលឯកសណ្ឋាន (ស្រីសរុប)
            3, // ចំនួនយុវជនបានទទួលឯកសណ្ឋាន (ប្រុស)
        ],
    ];

    sampleData.forEach((rowData, index) => {
        const rowNumber = index + startRow;
        const row = worksheet.getRow(rowNumber);

        rowData.forEach((value, colIndex) => {
            const cell = row.getCell(colIndex + 1);
            cell.value = value;
            cell.font = EXCEL_CONFIG.fonts.body;
            cell.alignment = {
                vertical: "middle",
                horizontal: "center",
                wrapText: true,
            };
            cell.border = {
                top: { style: "thin" },
                bottom: { style: "thin" },
                left: { style: "thin" },
                right: { style: "thin" },
            };
        });

        row.height = 25;
    });
};

// Main function to export Excel
export default function exportToExcelOptionTwo(branchData) {
    const workbook = new ExcelJS.Workbook();
    const worksheet = createWorksheet(workbook);
    populateTable(worksheet, branchData);

    workbook.xlsx
        .writeBuffer()
        .then((buffer) => {
            const blob = new Blob([buffer], {
                type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            });
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "branches_report.xlsx";
            link.click();
        })
        .catch((error) => {
            console.error("Error creating Excel file:", error);
        });
}
window.exportToExcelOptionTwo = exportToExcelOptionTwo;
