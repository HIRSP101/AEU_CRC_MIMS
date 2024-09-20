
// Convert __filename and __dirname to ES module equivalents
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Path to the Excel file
const filePath = path.join("D:\\DATA(25)-RCV-RCY-Corrected-29_July_2024_1.xlsx");

// Function to read data from the Excel file
async function readExcelFile() {
    // Create a new workbook instance
    const workbook = new ExcelJS.Workbook();

    // Read the Excel file
    await workbook.xlsx.readFile(filePath);

    // Access the first worksheet
    const worksheet = workbook.worksheets[0];
    // Iterate through rows and columns
    worksheet.eachRow({ includeEmpty: false }, (row, rowNumber) => {
        console.log(`Row ${rowNumber}: ${row.values}`);
    });
}

// Execute the function
readExcelFile().catch(err => console.error('Error reading the Excel file:', err));
