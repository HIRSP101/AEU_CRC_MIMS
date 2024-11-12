import ExcelJS from 'exceljs';

// Configuration object for columns and fonts
const EXCEL_CONFIG = {
    columnDefinitions: [
        { name: "ល.រ", width: 20 },              // Row number
        { name: "សាខា កក្រក", width: 30 },      // Branch name
        { name: "សរុប (បណ្តាញ)", width: 20 },  // Total (MS + HS)
        { name: "អនុ.វិ", width: 20 },          // Total MS
        { name: "វិទ្យាល័យ", width: 20 },      // Total HS
        { name: "ខត្តមសិក្សា", width: 20 },    // Placeholder for future use (always 0)
        { name: "សរុប (ទីប្រឹក្សា)", width: 20 }, // Total LS
        { name: "ស្រី (ទីប្រឹក្សា)", width: 20 },  // Female LS
        { name: "សរុប (យុវជន)", width: 20 },  // Total MEM
        { name: "ស្រី (យុវជន)", width: 20 },   // Female MEM
    ],
    fonts: {
        header: {
            name: "Khmer OS Muol Light",
            size: 10
        },
        body: {
            name: "Khmer OS Battambang",
            size: 10
        }
    }
};

// Function to create a worksheet
export const createWorksheet = (workbook) => {
    const worksheet = workbook.addWorksheet("សរុបចំណូល ២០២៤");

    // Set up the merged cells to match the table structure
    worksheet.mergeCells('C1:F1'); // Columns for "បណ្តាញយុវជនគ្រឹះស្ថានសិក្សា ២០២៤"
    worksheet.mergeCells('G1:H1'); // Columns for "ទីប្រឹក្សា ២០២៤"
    worksheet.mergeCells('I1:J1'); // Columns for "យុវជន ២០២៤"
    worksheet.mergeCells('B1:B2');
    worksheet.mergeCells('A1:A2');

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
            cell.width = 50,
            cell.alignment = { vertical: "middle", horizontal: "center" };
            cell.border = { top: { style: 'thin' }, bottom: { style: 'thin' }, left: { style: 'thin' }, right: { style: 'thin' } };
        });
    });
    return worksheet;
};

// Function to populate data rows
export const populateTable = (worksheet, data) => {
    data.forEach((item, index) => {
        const rowNumber = index + 3; // Start from the third row
        const row = worksheet.getRow(rowNumber);

        // Map data to cells
        row.getCell(1).value = index + 1;  // ល.រ (Row number)
        row.getCell(2).value = item.branch_kh;  // Branch name
        row.getCell(3).value = item.total_ms + item.total_hs;  // Total (MS + HS)
        row.getCell(4).value = item.total_ms;  // Total MS
        row.getCell(5).value = item.total_hs;  // Total HS
        row.getCell(6).value = 0;  // Placeholder (always 0)
        row.getCell(7).value = item.total_ls;  // Total LS
        row.getCell(8).value = item.total_ls_wm;  // Female LS
        row.getCell(9).value = item.total_mem;  // Total MEM
        row.getCell(10).value = item.total_wm;  // Female MEM

        // Apply body styles
        row.eachCell((cell) => {
            console.log(cell);
            cell.font = EXCEL_CONFIG.fonts.body;
            cell.alignment = { vertical: "middle", horizontal: "center" };
            cell.border = { top: { style: 'thin' }, bottom: { style: 'thin' }, left: { style: 'thin' }, right: { style: 'thin' } };
        });
    });
};

// Main function to export Excel
export default function exportToExcel_branch(branchData) {
    const workbook = new ExcelJS.Workbook();
    const worksheet = createWorksheet(workbook);
    populateTable(worksheet, branchData);

    workbook.xlsx.writeBuffer().then((buffer) => {
        const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'branches_report.xlsx';
        link.click();
    }).catch((error) => {
        console.error('Error creating Excel file:', error);
    });
}
