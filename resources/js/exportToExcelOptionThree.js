import ExcelJS from "exceljs";

// Configuration object for columns and fonts
const EXCEL_CONFIG = {
    columnDefinitions: [
        { name: "ល.រ", width: 20 },
        { name: "សាខា កក្រក", width: 30 },
        { name: "សរុប (បណ្តាញ)", width: 20 },
        { name: "អនុ.វិ", width: 20 },
        { name: "វិទ្យាល័យ", width: 20 },
        { name: "ខត្តមសិក្សា", width: 20 },
        { name: "សរុប (ទីប្រឹក្សា)", width: 20 },
        { name: "ស្រី (ទីប្រឹក្សា)", width: 20 },
        { name: "សរុប (យុវជន)", width: 20 },
        { name: "ស្រី (យុវជន)", width: 20 },
    ],
    fonts: {
        title: {
            name: "Khmer OS Muol Light",
            size: 14,
        },
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

    // Set column widths
    EXCEL_CONFIG.columnDefinitions.forEach((col, index) => {
        worksheet.getColumn(index + 1).width = col.width;
    });

    // ==== Title Section ====
    const titleText = `តារាងទិន្នន័យគ្រឹះស្ថានសិក្សា ទីប្រឹក្សាយុវជន នឹងយុវជន
នៃកាកបាទក្រហមកម្ពុជា ២៥ រាជធានី/ខេត្ត និងគ្រឹះស្ថានឧត្តមសិក្សា
បច្ចុប្បន្នភាពឆ្នាំ២០២៤`;

    worksheet.mergeCells("A1:J3");
    const titleCell = worksheet.getCell("A1");
    titleCell.value = titleText;
    titleCell.font = EXCEL_CONFIG.fonts.title;
    titleCell.alignment = {
        vertical: "middle",
        horizontal: "center",
        wrapText: true,
    };

    // ==== Header Section ====
    worksheet.mergeCells("C4:F4");
    worksheet.mergeCells("G4:H4");
    worksheet.mergeCells("I4:J4");
    worksheet.mergeCells("B4:B5");
    worksheet.mergeCells("A4:A5");

    const headerRow1 = worksheet.getRow(4);
    headerRow1.getCell(1).value = "ល.រ";
    headerRow1.getCell(2).value = "សាខា កក្រក";
    headerRow1.getCell(3).value = "បណ្តាញយុវជនគ្រឹះស្ថានសិក្សា ២០២៤";
    headerRow1.getCell(7).value = "ទីប្រឹក្សា ២០២៤";
    headerRow1.getCell(9).value = "យុវជន ២០២៤";

    const headerRow2 = worksheet.getRow(5);
    headerRow2.getCell(3).value = "សរុប";
    headerRow2.getCell(4).value = "អនុ.វិ";
    headerRow2.getCell(5).value = "វិទ្យាល័យ";
    headerRow2.getCell(6).value = "ខត្តមសិក្សា";
    headerRow2.getCell(7).value = "សរុប";
    headerRow2.getCell(8).value = "ស្រី";
    headerRow2.getCell(9).value = "សរុប";
    headerRow2.getCell(10).value = "ស្រី";

    [headerRow1, headerRow2].forEach((row) => {
        row.eachCell((cell) => {
            cell.font = EXCEL_CONFIG.fonts.header;
            cell.alignment = { vertical: "middle", horizontal: "center" };
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
        const rowNumber = index + 6;
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
    const totalRowIndex = data.length + 6;
    const totalRow = worksheet.getRow(totalRowIndex);
    const total_all_school_type =
        total_secondary + total_high + total_university;

    const totalData = [
        "",
        "សរុប",
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
            fgColor: { argb: "FFECECEC" },
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
