import ExcelJS from "exceljs";

// Configuration object for columns and fonts
const EXCEL_CONFIG = {
    columnDefinitions: [
        { name: "ល.រ", width: 20 }, // Row number
        { name: "សាខា កក្រក", width: 30 }, // Branch name
        { name: "សរុប (បណ្តាញ)", width: 20 }, // Total (MS + HS)
        { name: "អនុ.វិ", width: 20 }, // Total MS
        { name: "វិទ្យាល័យ", width: 20 }, // Total HS
        { name: "ខត្តមសិក្សា", width: 20 }, // Placeholder for future use (always 0)
        { name: "សរុប (ទីប្រឹក្សា)", width: 20 }, // Total LS
        { name: "ស្រី (ទីប្រឹក្សា)", width: 20 }, // Female LS
        { name: "សរុប (យុវជន)", width: 20 }, // Total MEM
        { name: "ស្រី (យុវជន)", width: 20 }, // Female MEM
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

// Function to create a worksheet
export const createWorksheet = (workbook) => {
    const worksheet = workbook.addWorksheet("សរុបចំណូល ២០២៤");

    // Set up the merged cells to match the table structure
    worksheet.mergeCells("C1:F1"); // Columns for "បណ្តាញយុវជនគ្រឹះស្ថានសិក្សា ២០២៤"
    worksheet.mergeCells("G1:H1"); // Columns for "ទីប្រឹក្សា ២០២៤"
    worksheet.mergeCells("I1:J1"); // Columns for "យុវជន ២០២៤"
    worksheet.mergeCells("B1:B2");
    worksheet.mergeCells("A1:A2");

    // Add the headers
    const headerRow1 = worksheet.getRow(1);
    headerRow1.getCell(1).value = "ល.រ";
    headerRow1.getCell(2).value = "សាខា កក្រក";
    headerRow1.getCell(3).value = "បណ្តាញយុវជនគ្រឹះស្ថានសិក្សា ២០២៤";
    headerRow1.getCell(7).value = "ទីប្រឹក្សា ២០២៤";
    headerRow1.getCell(9).value = "យុវជន ២០២៤";

    const headerRow2 = worksheet.getRow(2);
    headerRow2.getCell(3).value = "សរុប";
    headerRow2.getCell(4).value = "អនុ.វិ";
    headerRow2.getCell(5).value = "វិទ្យាល័យ";
    headerRow2.getCell(6).value = "ខត្តមសិក្សា";
    headerRow2.getCell(7).value = "សរុប";
    headerRow2.getCell(8).value = "ស្រី";
    headerRow2.getCell(9).value = "សរុប";
    headerRow2.getCell(10).value = "ស្រី";

    // Apply styles for headers
    [headerRow1, headerRow2].forEach((row) => {
        row.eachCell((cell) => {
            cell.font = EXCEL_CONFIG.fonts.header;
            (cell.width = 50),
                (cell.alignment = { vertical: "middle", horizontal: "center" });
            cell.border = {
                top: { style: "thin" },
                bottom: { style: "thin" },
                left: { style: "thin" },
                right: { style: "thin" },
            };
        });
    });
    return worksheet;
};

export const populateTable = (worksheet, data) => {
    let total_secondary = 0;
    let total_high = 0;
    let total_university = 0;
    let total_mem_advisor = 0;
    let total_mem_fem_advisor = 0;
    let total_mem = 0;
    let total_mem_fem = 0;

    data.forEach((item, index) => {
        const rowNumber = index + 3;
        const row = worksheet.getRow(rowNumber);

        const secondary_school = parseInt(item.secondary_school ?? 0);
        const high_school = parseInt(item.high_school ?? 0);
        const university = parseInt(item.university ?? 0);

        const total_all_school_type =
            secondary_school + high_school + university;

        const mem_advisor = parseInt(item.total_mem_advisor ?? 0);
        const mem_fem_advisor = parseInt(item.total_mem_fem_advisor ?? 0);
        const mem = parseInt(item.total_mem ?? 0);
        const mem_fem = parseInt(item.total_mem_fem ?? 0);

        // Accumulate totals
        total_secondary += secondary_school;
        total_high += high_school;
        total_university += university;
        total_mem_advisor += mem_advisor;
        total_mem_fem_advisor += mem_fem_advisor;
        total_mem += mem;
        total_mem_fem += mem_fem;

        const rowData = [
            index + 1,
            item.branch_kh ?? "",
            total_all_school_type,
            secondary_school,
            high_school,
            university,
            mem_advisor,
            mem_fem_advisor,
            mem,
            mem_fem,
        ];

        rowData.forEach((value, i) => {
            const cell = row.getCell(i + 1);
            cell.value = value;
            cell.font = EXCEL_CONFIG.fonts.body;
            cell.alignment = { vertical: "middle", horizontal: "center" };
            cell.border = {
                top: { style: "thin" },
                bottom: { style: "thin" },
                left: { style: "thin" },
                right: { style: "thin" },
            };
        });
    });

    // Add total row
    const totalRowIndex = data.length + 3;
    const totalRow = worksheet.getRow(totalRowIndex);
    const total_all_school_type =
        total_secondary + total_high + total_university;

    const totalData = [
        "", // Empty cell for "ល.រ"
        "សរុប", // Label
        total_all_school_type,
        total_secondary,
        total_high,
        total_university,
        total_mem_advisor,
        total_mem_fem_advisor,
        total_mem,
        total_mem_fem,
    ];

    totalData.forEach((value, i) => {
        const cell = totalRow.getCell(i + 1);
        cell.value = value;
        cell.font = EXCEL_CONFIG.fonts.body;
        cell.alignment = { vertical: "middle", horizontal: "center" };
        cell.border = {
            top: { style: "thin" },
            bottom: { style: "thin" },
            left: { style: "thin" },
            right: { style: "thin" },
        };
        cell.fill = {
            type: "pattern",
            pattern: "solid",
            fgColor: { argb: "FFECECEC" }, // light gray background
        };
    });
};

// Main function to export Excel
export default function exportToExcelOptionThree(branchData) {
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
window.exportToExcelOptionThree = exportToExcelOptionThree;
