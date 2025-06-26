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
    // worksheet.getCell("G3").value = totalMem;
    // worksheet.getCell("H3").value = totalMemFem;

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
    // worksheet.getCell("K3").value = totalMemAdvisor;
    // worksheet.getCell("L3").value = totalMemFemAdvisor;

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

    const skipFillCells = new Set([
        "E3",
        "F3", // មាន / អត់
        "G3", // value A, B
        "H3",
        "I3",
        "J3", // value C, D
        "K3", // value E, F
        "L3",
        "M3",
        "N3", // value G, H
        "O3",
        "P3", // ស្រីសរុប / ប្រុស (ទទួលវគ្គ)
        "Q3",
        "R3", // ស្រីសរុប / ប្រុស (ឯកសណ្ឋាន)
    ]);

    for (let r = 1; r <= 3; r++) {
        const row = worksheet.getRow(r);
        row.height = 30;
        row.eachCell({ includeEmpty: true }, (cell, colNumber) => {
            const cellRef = `${worksheet.getColumn(colNumber).letter}${r}`;
            cell.font = font;
            cell.border = border;
            cell.alignment = alignCenter;

            if (!skipFillCells.has(cellRef)) {
                cell.fill = {
                    type: "pattern",
                    pattern: "solid",
                    fgColor: { argb: "FFECECEC" },
                };
            }
        });
    }

    return worksheet;
};

export const addTotalsToHeader = (worksheet, totals) => {
    const border = {
        top: { style: "thin" },
        bottom: { style: "thin" },
        left: { style: "thin" },
        right: { style: "thin" },
    };

    ["G3", "H3", "K3", "L3"].forEach((cellRef) => {
        const cell = worksheet.getCell(cellRef);
        cell.font = { bold: true };
        cell.alignment = { horizontal: "center", vertical: "middle" };
        cell.border = border;
    });
    worksheet.getCell("G3").value = totals.totalMem;
    worksheet.getCell("H3").value = totals.totalMemFem;
    worksheet.getCell("K3").value = totals.totalMemAdvisor;
    worksheet.getCell("L3").value = totals.totalMemFemAdvisor;
};

export const populateTable = (worksheet, data) => {
    let currentRow = 4;
    let serialNumber = 1;

    // Initialize totals
    let totalSchools = 0;
    let totalMem = 0;
    let totalMemFem = 0;
    let totalMemAdvisor = 0;
    let totalMemFemAdvisor = 0;

    data.forEach((district) => {
        const schools = district.schools || [district];
        const rowSpan = schools.length;
        totalSchools += rowSpan;

        schools.forEach((school, index) => {
            const row = worksheet.getRow(currentRow);

            // Update totals
            totalMem += school.total_mem || 0;
            totalMemFem += school.total_mem_fem || 0;
            totalMemAdvisor += school.total_mem_advisor || 0;
            totalMemFemAdvisor += school.total_mem_fem_advisor || 0;

            const rowData = [
                serialNumber,
                district.district_name,
                rowSpan,
                school.school_name,
                0,
                0, // មានបណ្ដាញ
                school.total_mem || 0,
                school.total_mem_fem || 0,
                0,
                0, // ពិការភាព
                school.total_mem_advisor || 0,
                school.total_mem_fem_advisor || 0,
                0,
                0, // ពិការភាព 2
                0,
                0, // ទទួលវគ្គ
                0,
                0, // ឯកសណ្ឋាន
            ];

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
            currentRow++;
        });

        const startMergeRow = currentRow - rowSpan;
        const endMergeRow = currentRow - 1;
        if (rowSpan > 1) {
            worksheet.mergeCells(`A${startMergeRow}:A${endMergeRow}`);
            worksheet.mergeCells(`B${startMergeRow}:B${endMergeRow}`);
            worksheet.mergeCells(`C${startMergeRow}:C${endMergeRow}`);
        }

        serialNumber++;
    });

    // Add Summary Row
    const totalRow = worksheet.getRow(currentRow);
    const totalRowData = [
        "សរុប", // A (merged with B)
        "", // B (merged)
        totalSchools, // C
        0,
        0,
        0, // D, E
        totalMem, // F
        totalMemFem, // G
        0,
        0, // H, I
        totalMemAdvisor, // J
        totalMemFemAdvisor, // K
        0,
        0, // L, M
        0,
        0, // N, O
        0,
        0,
    ];

    totalRowData.forEach((value, colIndex) => {
        const cell = totalRow.getCell(colIndex + 1);
        cell.value = value;
        cell.font = { ...EXCEL_CONFIG.fonts.body, bold: true };
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
        if (colIndex === 1) {
            cell.fill = {
                type: "pattern",
                pattern: "solid",
                fgColor: { argb: "FFECECEC" },
            };
        }
    });

    // Merge A + B for total row label
    worksheet.mergeCells(`A${currentRow}:B${currentRow}`);

    totalRow.height = 28;

    return {
        totalSchools,
        totalMem,
        totalMemFem,
        totalMemAdvisor,
        totalMemFemAdvisor,
    };
};

// Main function to export Excel
export default function exportToExcelOptionTwo(data) {
    const workbook = new ExcelJS.Workbook();
    const worksheet = createWorksheet(workbook);

    function groupByDistrict(data) {
        const districtMap = {};
        data.forEach((item) => {
            const districtName = item.district_name;
            if (!districtMap[districtName]) {
                districtMap[districtName] = {
                    district_name: districtName,
                    schools: [],
                };
            }
            districtMap[districtName].schools.push(item);
        });
        return Object.values(districtMap);
    }

    const groupedData = groupByDistrict(data);
    const totals = populateTable(worksheet, groupedData);
    addTotalsToHeader(worksheet, totals);

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
