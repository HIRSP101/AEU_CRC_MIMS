import ExcelJS from "exceljs";

// Configuration objects
const EXCEL_CONFIG = {
    columnDefinitions: [
        { name: "ល.រ", width: 5 },
        { name: "ឈ្មោះ(ខ្មែរ)", width: 25 },
        { name: "ឈ្មោះ(ឡាតាំង)", width: 30 },
        { name: "ភេទ", width: 5 },
        { name: "ថៃ្ង​ ខែ ឆ្នាំកំណើត", width: 25 },
        { name: "គ្រឹះស្ថានសិក្សា", width: 25 },
        { name: "តួនាទី", width: 18 },
        { name: "កម្រិតសិក្សា", width: 15 },
        { name: "ថ្ងៃចូលសមាជិក", width: 25 },
        { name: "អាស័យដ្ឋានបច្ចប្បន្ន", width: 45 },
        { name: "លេខទូរសព្ទ័ផ្ទាលខ្លួន", width: 30 },
        { name: "លេខទូរសព្ទ័អាណាព្យាបាល", width: 35 },
        { name: "ទំហំអាវ", width: 10 },
    ],
    fonts: {
        title: {
            name: "Khmer OS Muol Light",
            size: 12,
            bold: true,
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

// Helper functions
export const createWorksheet = (workbook, branchName) => {
    const worksheet = workbook.addWorksheet(branchName);

    // Set column widths
    worksheet.columns = [
        { width: 10 },
        { width: 30 },
        { width: 20 },
        { width: 20 },
        { width: 20 },
        { width: 20 },
        { width: 20 },
        { width: 20 },
        { width: 20 },
    ];

    const title = `តារាងទិន្នន័យគ្រឹះស្ថានសិក្សា ទីប្រឹក្សាយុវជន នឹងយុវជន 
        នៃកាកបាទក្រហមកម្ពុជា ប្រចាំគ្រឹះស្ថានឧត្តមសិក្សា​ (សាធារណៈ) 
        បច្ចុប្បន្នភាពឆ្នាំ២០២៤`;
    worksheet.mergeCells("A1:I1");
    const titleCell = worksheet.getCell("A1");
    titleCell.value = title;
    titleCell.font = EXCEL_CONFIG.fonts.title;
    titleCell.alignment = {
        vertical: "middle",
        horizontal: "center",
        wrapText: true,
    };

    worksheet.getRow(1).height = 40; // Optional: Adjust row height for readability

    // Header rows now start at row 2
    worksheet.mergeCells("A2:A3"); // ល.រ
    worksheet.mergeCells("B2:E3"); // គ្រឹះស្ថានឧត្តមសិក្សា
    worksheet.mergeCells("F2:G2"); // ទីប្រឹក្សា
    worksheet.mergeCells("H2:I2"); // យុវជន

    const headerRow1 = worksheet.getRow(2);
    headerRow1.getCell(1).value = "ល.រ";
    headerRow1.getCell(2).value = "គ្រឹះស្ថានឧត្តមសិក្សា";
    headerRow1.getCell(6).value = "បច្ចុប្បន្នភាពទីប្រឹក្សា";
    headerRow1.getCell(8).value = "បច្ចុប្បន្នភាពយុវជន";

    const headerRow2 = worksheet.getRow(3);
    headerRow2.getCell(6).value = "សរុប";
    headerRow2.getCell(7).value = "ស្រី";
    headerRow2.getCell(8).value = "សរុប";
    headerRow2.getCell(9).value = "ស្រី";

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

// Function to populate data rows
export const populateTable = (worksheet, data) => {
    let totalAdvisor = 0;
    let totalAdvisorFemale = 0;
    let totalYouth = 0;
    let totalYouthFemale = 0;

    data.forEach((item, index) => {
        const rowNumber = index + 4; // Start after title + 2 header rows
        const row = worksheet.getRow(rowNumber);

        row.getCell(1).value = index + 1;
        row.getCell(2).value = item.institute_kh;

        worksheet.mergeCells(`B${rowNumber}:E${rowNumber}`);

        row.getCell(6).value = item.total_mem_advisor;
        row.getCell(7).value = item.total_mem_fem_advisor;
        row.getCell(8).value = item.total_mem;
        row.getCell(9).value = item.total_mem_fem;

        totalAdvisor += item.total_mem_advisor || 0;
        totalAdvisorFemale += item.total_mem_fem_advisor || 0;
        totalYouth += item.total_mem || 0;
        totalYouthFemale += item.total_mem_fem || 0;

        row.eachCell((cell) => {
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

    // Add summary (total) row
    const totalRowIndex = data.length + 4;
    const totalRow = worksheet.getRow(totalRowIndex);

    totalRow.getCell(1).value = "";
    totalRow.getCell(2).value = "សរុប";
    worksheet.mergeCells(`B${totalRowIndex}:E${totalRowIndex}`);

    totalRow.getCell(6).value = totalAdvisor;
    totalRow.getCell(7).value = totalAdvisorFemale;
    totalRow.getCell(8).value = totalYouth;
    totalRow.getCell(9).value = totalYouthFemale;

    totalRow.eachCell((cell) => {
        cell.font = { bold: true, ...EXCEL_CONFIG.fonts.body };
        cell.alignment = { vertical: "middle", horizontal: "center" };
        cell.border = {
            top: { style: "thin" },
            bottom: { style: "thin" },
            left: { style: "thin" },
            right: { style: "thin" },
        };
    });
};
// Main function to export Excel
export default function exportToExcel(branchData) {
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
