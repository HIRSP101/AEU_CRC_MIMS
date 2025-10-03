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

    const title = `តារាងទិន្នន័យគ្រឹះស្ថានសិក្សា ទីប្រឹក្សាយុវជន និងយុវជន 
    នៃកាកបាទក្រហមកម្ពុជា​ប្រចាំ​​ខេត្ត​ 
    បច្ចុប្បន្នភាពឆ្នាំ២០២៤`;

    worksheet.mergeCells("A1:R1");
    const titleCell = worksheet.getCell("A1");
    titleCell.value = title;
    titleCell.font = {
        name: "Khmer OS Muol Light",
        size: 14,
        bold: true,
    };
    titleCell.alignment = {
        horizontal: "center",
        vertical: "middle",
        wrapText: true,
    };
    titleCell.height = 40;

    // Push down everything else by 1 row
    const shift = (cellRef) => {
        const match = cellRef.match(/^([A-Z]+)(\d+)$/);
        if (!match) return cellRef;
        const col = match[1];
        const row = parseInt(match[2], 10);
        return `${col}${row + 1}`;
    };

    // All existing mergedCells/values should shift by 1 row
    // For example: "A1:A3" → "A2:A4", etc.
    const mergeAndSet = (range, value) => {
        const shifted = range.split(":").map(shift).join(":");
        worksheet.mergeCells(shifted);
        worksheet.getCell(shift(range.split(":")[0])).value = value;
    };

    mergeAndSet("A1:A3", "ល.រ");
    mergeAndSet("B1:B3", "ក្រុង/ស្រុក");
    mergeAndSet("C1:C3", "ចំនួនគ្រឹះស្ថានសិក្សា");
    mergeAndSet("D1:D3", "ឈ្មោះគ្រឹះស្ថានសិក្សា");

    mergeAndSet("E1:F1", "មានបណ្ដាញ");
    mergeAndSet("E2:F2", "យុវជន កក្រក");
    worksheet.getCell("E4").value = "មាន";
    worksheet.getCell("F4").value = "អត់";

    mergeAndSet("G1:H1", "យុវជន");
    worksheet.getCell("G3").value = "សរុប";
    worksheet.getCell("H3").value = "ស្រី";

    mergeAndSet("I1:J1", "ពិការភាព");
    worksheet.getCell("I3").value = "សរុប";
    worksheet.getCell("J3").value = "ស្រី";
    worksheet.getCell("I4").value = "C";
    worksheet.getCell("J4").value = "D";

    mergeAndSet("K1:L1", "ទីប្រឹក្សា");
    worksheet.getCell("K3").value = "សរុប";
    worksheet.getCell("L3").value = "ស្រី";

    mergeAndSet("M1:N1", "ពិការភាព");
    worksheet.getCell("M3").value = "សរុប";
    worksheet.getCell("N3").value = "ស្រី";
    worksheet.getCell("M4").value = "G";
    worksheet.getCell("N4").value = "H";

    mergeAndSet("O1:P2", "ចំនួនយុវជនទទួលវគ្គ បណ្ដុះបណ្ដាល មូលដ្ឋាន");
    worksheet.getCell("O4").value = "ស្រីសរុប";
    worksheet.getCell("P4").value = "ប្រុស";

    mergeAndSet("Q1:R2", "ចំនួនយុវជនបានទទួល ឯកសណ្ឋាន");
    worksheet.getCell("Q4").value = "ស្រីសរុប";
    worksheet.getCell("R4").value = "ប្រុស";
    const skipFillCells = new Set([
        "E4",
        "F4",
        "G4",
        "H4",
        "I4",
        "J4",
        "K4",
        "L4",
        "M4",
        "N4",
        "O4",
        "P4",
        "Q4",
        "R4",
    ]);

    for (let r = 2; r <= 4; r++) {
        const row = worksheet.getRow(r);
        row.height = 30;
        row.eachCell({ includeEmpty: true }, (cell, colNumber) => {
            const cellRef = `${worksheet.getColumn(colNumber).letter}${r}`;
            cell.font = EXCEL_CONFIG.fonts.header;
            cell.border = {
                top: { style: "thin" },
                left: { style: "thin" },
                bottom: { style: "thin" },
                right: { style: "thin" },
            };
            cell.alignment = {
                vertical: "middle",
                horizontal: "center",
                wrapText: true,
            };

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
    let currentRow = 5;
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
