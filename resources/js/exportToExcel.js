import ExcelJS from 'exceljs';

// Configuration objects
const EXCEL_CONFIG = {
    columnDefinitions: [
        { name: "ល.រ", width: 5 },
        { name: "ឈ្មោះ(ខ្មែរ)", width: 25 },
        { name: "ឈ្មោះ(ឡាតាំង)", width: 30 },
        { name: "ភេទ", width: 5 },
        { name: "ថៃ្ង​ ខែ ឆ្នាំកំណើត", width: 25 },
        { name: "តួនាទី", width: 18 },
        { name: "គ្រឹះស្ថានសិក្សា", width: 25 },
        { name: "កម្រិតសិក្សា", width: 15 },
        { name: "ថ្ងៃចូលសមាជិក", width: 25 },
        { name: "អាស័យដ្ឋានបច្ចប្បន្ន", width: 45 },
        { name: "លេខទូរសព្ទ័រផ្ទាលខ្លួន", width: 30 },
        { name: "លេខទូរសព្ទ័រអាណាព្យាបាល", width: 35 },
        { name: "ទំហំអាវ", width: 10 },
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


// Helper functions
export const createWorksheet = (workbook, branchName) => {
    const worksheet = workbook.addWorksheet(branchName);
    return worksheet;
};

export const addTitle = (worksheet, branchName) => {
    // Add main title
    worksheet.mergeCells("A1:M1");
    const mainTitle = worksheet.getCell("A1");
    mainTitle.value = "ឯកសារយោងសំរាប់ការបញ្ជាក់ព័ត៌មាននៃការសិក្សា និងការងារ";
    mainTitle.font = EXCEL_CONFIG.fonts.header;
    mainTitle.alignment = { horizontal: "center" };

    // Add branch name
    worksheet.mergeCells("A2:M2");
    const branchTitle = worksheet.getCell("A2");
    branchTitle.value = `សាខាកាកបាទក្រហមកម្ពុជា ${branchName}`;
    branchTitle.font = EXCEL_CONFIG.fonts.header;
    branchTitle.alignment = { horizontal: "center" };
};

export const createTable = (worksheet, data) => {

    
    worksheet.addTable({
        name: "MyTable",
        ref: "A3",
        headerRow: true,
        style: {
            theme: "",
            showRowStripes: false,
        },
        columns: EXCEL_CONFIG.columnDefinitions.map(col => ({ name: col.name })),
        rows: data
    });
};

export const applyStyles = (worksheet, dataLength) => {
    // Set column widths and alignment
    worksheet.columns = EXCEL_CONFIG.columnDefinitions.map(col => ({
        width: col.width,
        alignment: { vertical: "middle", horizontal: "center" }
    }));

    // Style header row
    const headerRow = worksheet.getRow(3);
    headerRow.eachCell((cell) => {
        cell.fill = null;
        cell.font = EXCEL_CONFIG.fonts.header;
        cell.alignment = { vertical: "middle", horizontal: "center" };
    });

    // Apply borders and body font
    for (let i = 3; i <= dataLength + 3; i++) {
        const row = worksheet.getRow(i);
        row.eachCell({ includeEmpty: true }, (cell) => {
            cell.border = {
                top: { style: "thin" },
                left: { style: "thin" },
                bottom: { style: "thin" },
                right: { style: "thin" }
            };
            if (i > 3) {
                cell.font = EXCEL_CONFIG.fonts.body;
            }
        });
    }
};

export const addFooter = (worksheet, totalStudents, femaleStu, rowNumber) => {
    // Add total count
    worksheet.mergeCells(`A${rowNumber}:I${rowNumber}`);
    const totalCell = worksheet.getCell(`A${rowNumber}`);
    totalCell.value = `បញ្ចប់បញ្ជីត្រឹមចំនួន ${totalStudents} នាក់ (ស្រី ${femaleStu} នាក់)`;
    totalCell.font = EXCEL_CONFIG.fonts.body;
    totalCell.alignment = { vertical: "middle", horizontal: "left" };

    // Add date
    worksheet.mergeCells(`J${rowNumber}:M${rowNumber}`);
    const dateCell = worksheet.getCell(`J${rowNumber}`);
    dateCell.value = "រាជធានីភ្នំពេញ ថ្ងៃទី x  ខែ xx  ឆ្នាំ xxxx";
    dateCell.font = EXCEL_CONFIG.fonts.body;
    dateCell.alignment = { vertical: "middle", horizontal: "center" };

    // Add signature line
    worksheet.mergeCells(`J${rowNumber + 1}:M${rowNumber + 1}`);
    const signatureCell = worksheet.getCell(`J${rowNumber + 1}`);
    signatureCell.value = "អ្នកធ្វើតារាង";
    signatureCell.font = EXCEL_CONFIG.fonts.body;
    signatureCell.alignment = { vertical: "middle", horizontal: "center" };
};

export const addDateSignature = (worksheet, rowNumber) => {
    worksheet.mergeCells(`J${rowNumber}:M${rowNumber}`);
    const dateCell = worksheet.getCell(`J${rowNumber}`);
    dateCell.value = "រាជធានីភ្នំពេញ ថ្ងៃទី x  ខែ xx  ឆ្នាំ xxxx";
    dateCell.font = EXCEL_CONFIG.fonts.body;
    dateCell.alignment = { vertical: "middle", horizontal: "center" };

    // Add signature line
    worksheet.mergeCells(`J${rowNumber + 1}:M${rowNumber + 1}`);
    const signatureCell = worksheet.getCell(`J${rowNumber + 1}`);
    signatureCell.value = "អ្នកធ្វើតារាង";
    signatureCell.font = EXCEL_CONFIG.fonts.body;
    signatureCell.alignment = { vertical: "middle", horizontal: "center" };

}


export const downloadExcel = async (workbook) => {
    try {
        const buffer = await workbook.xlsx.writeBuffer();
        const blob = new Blob([buffer], {
            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
        });
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = "បញ្ជីសាខាកាកបាទក្រហមកម្ពុជា.xlsx";
        link.click();
    } catch (error) {
        console.error("Error creating Excel file:", error);
        throw error;
    }
};


export default function exportToExcel(current_branch, total_member, total_stu, total_stu_fem) {
    $("#export_excel").on("click", async () => {
        try {
            console.log("Hello World!!!");
            const total_memberFormat = total_member.map(arr => arr.slice(0, 13));
            console.log(total_member.map(arr => arr.slice(0, 13)));
            const workbook = new ExcelJS.Workbook();
            const worksheet = createWorksheet(workbook, current_branch);

            addTitle(worksheet, current_branch);
            createTable(worksheet, total_memberFormat);
            applyStyles(worksheet, total_member.length);
            addFooter(worksheet, total_stu, total_stu_fem, total_member.length + 4);

            await downloadExcel(workbook);
        } catch (error) {
            console.error("Error in export process:", error);
        }
    });
}