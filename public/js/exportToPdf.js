
import { khmerOSMoulLight, khmerOSSiemreab,logoSVG } from "./fontsbase64";

const zip = new JSZip();
export function downloadPDF(data) {
  pdfMake.vfs["KhmerOSmoullight.ttf"] = khmerOSMoulLight;
  pdfMake.vfs["KhmerOSSeamrieb.ttf"] = khmerOSSiemreab;
  let svgpath = logoSVG;
let foreignLang = "អង់គ្លេស";
let lifeSkill = "ដេក ស៊ី";
let RCYDate = "១២​ មករា ១៩៩៩";
let scoutYOuth = "១២​ មករា ១៩៩៩";
let uyfc = "១២​ មករា ១៩៩៩";
let others = "១២​ មករា ១៩៩៩";
let course = "CS";
let schoolName = "អាស៊ី អ៊ឺរ៉ុប";
let sizeShirt = "M";
let phoneNum = "097876547";
let emailFaccbook = "rosrithsakphea@gmail.com";
let langskiil = "អងគ្លេស ខ្មែរ";
let computerSkill = "Programming";
let otherSkill = "បងស្រលាញ់អូន";
let dadName = "រស់​ រិទ្ធិសភា";
let dobDad = "២០​ ឪសភា​​ ២០០៤";
let addressDad = "ភ្នំពេញ សែនសុខ st. 1245 ភ្នំពេញថ្មី";
let jobDad = "Developer";
let momName = "រស់​ រិទ្ធិសភា";
let dobMom = "២០​ ឪសភា​​ ២០០៤";
let addressMom = "ភ្នំពេញ សែនសុខ st. 1245 ភ្នំពេញថ្មី";
let jobMom = "នៅផ្ទះ";
let protectorNum = "097654321";

  
  pdfMake.fonts = {
    Roboto: {
      normal: "Roboto-Regular.ttf",
      bold: "Roboto-Bold.ttf",
      italics: "Roboto-Italic.ttf",
      bolditalics: "Roboto-BoldItalic.ttf",
    },
    KhmerOSMoul: {
      normal: "KhmerOSmoullight.ttf",
    },
    KhmerOSSiem: {
      normal: "KhmerOSSeamrieb.ttf",
    },
  };

  function preventEmpty(value) {
    // Check for null, undefined, or empty strings
    if (
      value === null ||
      value === undefined ||
      value === "undefined" ||
      value === "null" ||
      value.toString().trim() === ""
    ) {
      return " ";
    }
    return value;
  }
  
   function generateCenteredPlaceholders(
    label,
    userInput,
    totalLength,
    placeholderChar = "."
  ) {
    // Calculate the length of the user input
    var inputLength = 0;
    if (inputLength == 0) {
      inputLength = userInput ? userInput.length : 0;
    }
  
    // Calculate the total remaining space for placeholders
    const remainingLength = Math.max(totalLength - inputLength * 1.2, 0);
  
    // Divide the placeholder length for left and right parts
    const leftPlaceholderLength = Math.floor(remainingLength / 2);
    const rightPlaceholderLength = remainingLength - leftPlaceholderLength;
  
    // Create the left and right placeholders
    const leftPlaceholder = placeholderChar.repeat(leftPlaceholderLength);
    const rightPlaceholder = placeholderChar.repeat(rightPlaceholderLength);
  
    // Combine the label, left placeholder, input, and right placeholder
    return `${label} ${leftPlaceholder}${userInput || ""}${rightPlaceholder} `;
  }


  
  
   function TUBox(
    type = false,
    width,
    height,
    x,
    y,
    margin = [0, 0, 0, 0],
    color = "#000000",
    lineWidth = 1
  ) {
    if (type === true) {
      return {
        margin: margin,
        canvas: [
          {
            type: "rect",
            x: x,
            y: y,
            w: width,
            h: height,
            lineColor: color,
            lineWidth: lineWidth,
          },
          {
            type: "line",
            x1: x + width * 0.25,
            y1: y + height * 0.5,
            x2: x + width * 0.45,
            y2: y + height * 0.7,
            lineColor: color,
            lineWidth: 1,
          },
          {
            type: "line",
            x1: x + width * 0.45,
            y1: y + height * 0.7,
            x2: x + width * 0.75,
            y2: y + height * 0.3,
            lineColor: color,
            lineWidth: 1,
          },
        ],
      };
    } else if (type === false) {
      return {
        margin: margin,
        canvas: [
          {
            type: "rect",
            x: x,
            y: y,
            w: width,
            h: height,
            lineColor: color,
            lineWidth: lineWidth,
          },
        ],
      };
    }
  }
   function content(data) {

    return data.map((members, index) => {
      return [
        //image 4x6 or 3x4
        {
          margin: [0, 0, 0, -109],
          alignment: "rigth",
          columns: [
            {
              // Image or Shape representing 4x6
              canvas: [
                {
                  type: "rect", // Rectangle shape
                  x: 0,
                  y: 0,
                  w: 80, // 4 inches
                  h: 110, // 6 inches
                  lineColor: "black", // Border color
                  lineWidth: 1, // Border thickness
                },
              ],
              alignment: "right",
            },
          ],
        },
        // logo
            {
              svg: svgpath,
              width: 70,
              height: 70,
              alignment: "center",
              margin: [0, 0, 0, 5],
            },
        {
          text: "សលាកបត្រព័ត៍មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា",
          style: "title",
          margin: [0, 0, 0, 3],
        },
        {
          text: "Cambodian Red Cross Youth Individual Information",
          style: "title",
          font: "Roboto",
          margin: [0, 0, 0, 12],
        },
        {
          text: ["១- ព័ត៍មានលម្អិតផ្ទាល់ខ្លួន", { text: "(Personal Detail)" }],
          style: "header1",
    
          margin: [0, 0, 0, 3],
        },
          // get data for name,nameEn
    {
      margin: [0, 0, 0, -19],
      font: "KhmerOSSiem",
      alignment: "left",
      columns: [
        {
          margin: [60, 0, 0, 0],
          text: preventEmpty(members[1]),
        },
        {
          margin: [66, 0, 0, 0],
          text: preventEmpty(members[2]),
        },
        {
          width: "20%",
          text: "",
        },
      ],
    },
    {
      margin: [12, 0, 0, 0],
      font: "KhmerOSSiem",
      columns: [
        {
          width: "auto",
          text: [
            "- ឈ្មោះ",
            {
              characterSpacing: 1,
              text: "...............................",
            },
          ],
          margin: [0, 0, 5, 0],
        },
        {
          width: "auto",
          text: [
            "អក្សរឡាតាំង",
            {
              characterSpacing: 1,
              text: ".................................",
            },
          ],
          margin: [0, 0, 5, 0],
        },
            {
              width: "auto",
              text: "ភេទ",
              margin: [0, 0, 5, 0],
            },
            {
              width: "auto",
              text: "ប្រុស",
              margin: [5, 0, 2, 0],
            },
            {
              width: "auto",
              margin: [0, 0, 10, 0],
              stack: [
                 TUBox(false, 13, 13, 0, 0, [0, 5, 0, 0], "#000000", 0.2),
              ],
            },
            {
              width: "auto",
              text: "ស្រី",
              margin: [0, 0, 2, 0],
            },
            {
              width: "auto",
              margin: [0, 0, 10, 0],
              stack: [
                 TUBox(false, 13, 13, 0, 0, [0, 5, 0, 0], "#000000", 0.2),
              ],
            },
          ],
        },
    
        {
          type: "none",
          ul: [
            // DOB
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "35%",
                  text: "",
                },
                {
                  text:  preventEmpty(members[4]),
                },
              ],
            },
            {
              text: [
                "- ថ្ងៃ ខែ ឆ្នាំកំណើត (Date of Birth)",
                {
                  characterSpacing: 1,
                  text: "............................................................................",
                },
              ],
            },
            // Place Birth
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "35%",
                  text: "",
                },
                {
                  text:  preventEmpty(members[13]),
                },
              ],
            },
            {
              text: [
                "- ទីកន្លែងកំណើត (Place of Birth)",
                {
                  characterSpacing: 1,
                  text: "............................................................................",
                },
              ],
            },
            // address
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "35%",
                  text: "",
                },
                {
                  margin: [80, 0, 0, 0],
                  text:  preventEmpty(members[23]),
                },
    
                {
                  margin: [40, 0, 0, 0],
                  text:  preventEmpty(members[24]),
                },
                {
                  text:  preventEmpty(members[19]),
                },
              ],
            },
            {
              text: " - អាសយដ្ឋានបច្ចុប្បន្ន (Current Address)  ផ្ទះលេខ...............ផ្លូវ..................ភូមិ.................................",
            },
            // address
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                // {
                //   width: "35%",
                //   text: "",
                // },
                {
                  margin: [70, 0, 0, 0],
                  text:  preventEmpty(members[22]),
                },
    
                {
                  margin: [60, 0, 0, 0],
                  text:  preventEmpty(members[21]),
                },
                {
                  margin: [70, 0, 0, 0],
                  text:  preventEmpty(members[20]),
                },
              ],
            },
            {
              text: "   ឃុំ/សង្កាត់...............................ស្រុក/ខណ្ឌ...............................ខេត្ត/រាជធានី.....................................",
              margin: [8, 0, 0, 0],
            },
            // Eduction
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "55%",
                  text: "",
                },
    
                {
                  margin: [50, 0, 0, 0],
                  text:  preventEmpty(members[7]),
                },
              ],
            },
            {
              text: " - កម្រិតវប្បធម៍ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class or Year)............................................................",
            },
            // Foreign Language
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "30%",
                  text: "",
                },
    
                {
                  margin: [50, 0, 0, 0],
                  text:  preventEmpty(foreignLang),
                },
              ],
            },
            {
              text: " - ភាសាបរទេស (Foreign Language)..............................................................................................",
            },
            // Life skill
              {
                margin: [0, 0, 0, -19],
                font: "KhmerOSSiem",
                alignment: "left",
                columns: [
                  {
                    width: "20%",
                    text: "",
                  },
      
                  {
                    margin: [50, 0, 0, 0],
                    text:  preventEmpty(lifeSkill),
                  },
                ],
              },
              {
                text: " - ជំនាញផ្ទាល់ខ្លួន (Life Skills).........................................................................................................",
              },
              // RCY Recruitment Date
              {
                margin: [0, 0, 0, -19],
                font: "KhmerOSSiem",
                alignment: "left",
                columns: [
                  {
                    width: "65%",
                    text: "",
                  },
      
                  {
                    margin: [50, 0, 0, 0],
                    text:  preventEmpty(RCYDate),
                  },
                ],
              },
              {
                text: " - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា(RCY Recruitment Date)............................................",
              },
              // Scout Yout Recruitment Date
              {
                margin: [0, 0, 0, -19],
                font: "KhmerOSSiem",
                alignment: "left",
                columns: [
                  {
                    width: "70%",
                    text: "",
                  },
      
                  {
                    margin: [50, 0, 0, 0],
                    text:  preventEmpty(scoutYOuth),
                  },
                ],
              },
              {
                text: " - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនជាតិកាយរឹទ្ធិកម្ពុជា(Scout Youth Recruitment Date).....................................",
              },
              // UYFC Recrutment Date
              {
                margin: [0, 0, 0, -19],
                font: "KhmerOSSiem",
                alignment: "left",
                columns: [
                  {
                    width: "55%",
                    text: "",
                  },
      
                  {
                    margin: [50, 0, 0, 0],
                    text:  preventEmpty(uyfc),
                  },
                ],
              },
              {
                text: " - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជន ស.ស.យ.ក. (UYFC Recruitment Date).....................................................",
              },
              // Other NGos Recruitment Date
              {
                margin: [0, 0, 0, -19],
                font: "KhmerOSSiem",
                alignment: "left",
                columns: [
                  {
                    width: "70%",
                    text: "",
                  },
      
                  {
                    margin: [50, 0, 0, 0],
                    text:  preventEmpty(others),
                  },
                ],
              },
              {
                text: " - ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងយុវជនផ្សេងៗ(Other NGos Recruitment Date).................................",
              },
              // learning course
              {
                margin: [0, 0, 0, -19],
                font: "KhmerOSSiem",
                alignment: "left",
                columns: [
                  {
                    width: "30%",
                    text: "",
                  },
      
                  {
                    margin: [50, 0, 0, 0],
                    text:  preventEmpty(course),
                  },
                ],
              },
              {
                text: " - វគ្គបណ្ដុះបណ្ដាលទទួលបាន.............................................................................................................",
              },
              // school name
              {
                margin: [0, 0, 0, -19],
                font: "KhmerOSSiem",
                alignment: "left",
                columns: [
                  {
                    width: "65%",
                    text: "",
                  },
      
                  {
                    margin: [50, 0, 0, 0],
                    text:  preventEmpty(schoolName),
                  },
                ],
              },
              {
                text: " - ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University)..............................................",
              },
              // size
              {
                font: "KhmerOSSiem",
                columns: [
                  {
                    width: "auto",
                    text: ["- ទំហំអាវ"],
                  },
                  {
                    width: "auto",
                    text: "ទំហំ S",
                    margin: [25, 0, 2, 0],
                  },
                  {
                    width: "auto",
                    margin: [0, 0, 10, 0],
                    stack: [
                      TUBox(false, 13, 13, 0, 0, [0, 5, 0, 0], "#000000", 0.2),
                    ],
                  },
                  {
                    width: "auto",
                    text: "ទំហំ M",
                    margin: [25, 0, 2, 0],
                  },
                  {
                    width: "auto",
                    margin: [0, 0, 10, 0],
                    stack: [
                      TUBox(
                        sizeShirt == "M" ? true : false,
                        13,
                        13,
                        0,
                        0,
                        [0, 5, 0, 0],
                        "#000000",
                        0.2
                      ),
                    ],
                  },
                  {
                    width: "auto",
                    text: "ទំហំ L",
                    margin: [25, 0, 2, 0],
                  },
                  {
                    width: "auto",
                    margin: [0, 0, 10, 0],
                    stack: [
                      TUBox(false, 13, 13, 0, 0, [0, 5, 0, 0], "#000000", 0.2),
                    ],
                  },
                  {
                    width: "auto",
                    text: "ទំហំ XL",
                    margin: [25, 0, 2, 0],
                  },
                  {
                    width: "auto",
                    margin: [0, 0, 10, 0],
                    stack: [
                      TUBox(false, 13, 13, 0, 0, [0, 5, 0, 0], "#000000", 0.2),
                    ],
                  },
                  {
                    width: "auto",
                    text: "ទំហំ XXL",
                    margin: [25, 0, 2, 0],
                  },
                  {
                    width: "auto",
                    margin: [0, 0, 10, 0],
                    stack: [
                      TUBox(false, 13, 13, 0, 0, [0, 5, 0, 0], "#000000", 0.2),
                    ],
                  },
                ],
              },
              // phone number
              {
                margin: [0, 0, 0, -19],
                font: "KhmerOSSiem",
                alignment: "left",
                columns: [
                  {
                    width: "35%",
                    text: "",
                  },
      
                  {
                    margin: [50, 0, 0, 0],
                    text:  preventEmpty(phoneNum),
                  },
                ],
              },
              {
                text: " - លេខទូរស័ព្ទ(Phone Number)......................................................................................................",
              },
              // email and facebook
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "55%",
                  text: "",
                },
    
                {
                  margin: [50, 0, 0, 0],
                  text:  preventEmpty(emailFaccbook),
                },
              ],
            },
            {
              text: " - អាស័យដ្ឋានអ៊ីម៉ែល និងអាយដេនភេសប៊ុក(Email and Facebook)....................................................",
            },
          ],
          font: "KhmerOSSiem",
          //   margin: [20, 0, 0, 3],
        },
        {
          text: "២- វគ្គបណ្ដុះបណ្ដាលដែលទទួលបានកន្លងមក(Training Skill)",
          style: "header1",
        },
        {
          type: "none",
          ul: [
            // language skill
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "35%",
                  text: "",
                },
    
                {
                  margin: [50, 0, 0, 0],
                  text:  preventEmpty(langskiil),
                },
              ],
            },
            {
              text: "- ជំនាញភាសាបរទេស(language Skill)...........................................................................................",
            },
            // computer skill
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "35%",
                  text: "",
                },
    
                {
                  margin: [50, 0, 0, 0],
                  text:  preventEmpty(computerSkill),
                },
              ],
            },
            {
              text: "- ជំនាញកុំព្យូទ័រ(Computer Skill)....................................................................................................",
            },
            // other skill
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "35%",
                  text: "",
                },
    
                {
                  margin: [50, 0, 0, 0],
                  text:  preventEmpty(otherSkill),
                },
              ],
            },
            {
              text: "- ជំនាញផ្សេងៗ(Other Skill).........................................................................................................",
            },
          ],
          font: "KhmerOSSiem",
        },
        {
          text: "៣- ព័ត៍មានគ្រួសារ (Training Skill)",
          style: "header1",
        },
        {
          type: "none",
          ul: [
            // father name and DOB
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "25%",
                  text: "",
                },
    
                {
                  margin: [50, 0, 0, 0],
                  text:  preventEmpty(dadName),
                },
                {
                  margin: [50, 0, 0, 0],
                  text:  preventEmpty(dobDad),
                },
              ],
            },
            {
              text: [
                "- ឈ្មោះឪពុក(Father Name).........................................",
                "ថ្ងៃខែឆ្នាំកំណើត..........................................",
              ],
            },
            // address
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "45%",
                  text: "",
                },
    
                {
                  margin: [50, 0, 0, 0],
                  with: "auto",
                  text:  preventEmpty(jobDad),
                },
              ],
            },
            {
              text: "- អាស័យដ្ឋាន នឹងមុខរបរ (Current Address & Job).........................................................................",
            },
            // job
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                // {
                //   width: "25%",
                //   text: "",
                // },
    
                {
                  margin: [40, 0, 0, 0],
                  text:  preventEmpty(addressDad),
                },
              ],
            },
            {
              text: " .....................................................................................................................................................",
            },
            // mother name and DOB
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "25%",
                  text: "",
                },
    
                {
                  margin: [50, 0, 0, 0],
                  text:  preventEmpty(momName),
                },
                {
                  margin: [50, 0, 0, 0],
                  text:  preventEmpty(dobMom),
                },
              ],
            },
            {
              text: [
                "- ឈ្មោះម្ដាយ(Mother Name).........................................",
                "ថ្ងៃខែឆ្នាំកំណើត..........................................",
              ],
            },
            // address
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "45%",
                  text: "",
                },
    
                {
                  margin: [50, 0, 0, 0],
                  with: "auto",
                  text:  preventEmpty(jobMom),
                },
              ],
            },
            {
              text: "- អាស័យដ្ឋាន នឹងមុខរបរ (Current Address & Job).........................................................................",
            },
            // job
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                // {
                //   width: "25%",
                //   text: "",
                // },
    
                {
                  margin: [40, 0, 0, 0],
                  text:  preventEmpty(addressMom),
                },
              ],
            },
            {
              text: " .....................................................................................................................................................",
            },
            // phone nnumber
            {
              margin: [0, 0, 0, -19],
              font: "KhmerOSSiem",
              alignment: "left",
              columns: [
                {
                  width: "45%",
                  text: "",
                },
    
                {
                  margin: [50, 0, 0, 0],
                  text:  preventEmpty(protectorNum),
                },
              ],
            },
            {
              text: "- លេខទូរសព្ទអាណាព្យាបាល (Protector Number)...........................................................................",
            },
          ],
          font: "KhmerOSSiem",
        },
        {
          text: "៤- កិច្ចសន្យា (Contract)",
          style: "header1",
        },
        {
          text: "ខ្ញុំបាទ/នាងខ្ញុំ សូមបញ្ជាក់ថា រាល់ព័ត៍មានដែលបានរៀបរាប់ជូនខាងលើ ពិតជាត្រឹមត្រូវប្រាកដមែន ហើយ",
          font: "KhmerOSSiem",
          margin: [30, 0, 0, 0],
        },
        {
          text: "យល់ព្រមចូលជាសមាជិកយុវជនកាកបាទក្រហមកម្ពុជា ចាប់ពីថ្ងៃចុះហត្ថលេខានេះតទៅ។",
          font: "KhmerOSSiem",
        },
        {
          text: ".....................................ខែ..............ឆ្នាំ......................ព.ស.២៥.......",
          font: "KhmerOSSiem",
          margin: [160, 0, 0, 0],
        },
        {
          text: "ធ្វើនៅ..............................ថ្ងៃទី            ខែ           ឆ្នាំ២០.......",
          font: "KhmerOSSiem",
          margin: [200, 0, 0, 0],
        },
        {
          alignment: "justify",
          columns: [
            {
              alignment: "center",
              text: "បានឃើញ និង ឯកភាព",
              font: "KhmerOSSiem",
              style: {
                color: "blue",
              },
            },
            {
              alignment: "center",
              text: "ហត្ថលេខា និង ឈ្មោះ ",
              font: "KhmerOSSiem",
              style: {
                color: "blue",
              },
            },
          ],
        },
        {
          margin: [80, 0, 0, 0],
          text: "ទីប្រឹក្សាយុវជន",
          style: "header1",
        },
        {
          margin: [0, 110, 0, 0],
          alignment: "center",
          text: "បានឃើញ នឹង ទទួលស្គាល់",
          style: "header1",
        },
        {
          alignment: "center",
          text: "សិស្ស/និសិ្សតឈ្មោះ.............................",
          font: "KhmerOSSiem",
        },
        {
          alignment: "center",
          text: "ពិតជាសិស្ស/និស្សិតនៃ..........................",
          font: "KhmerOSSiem",
        },
        {
          alignment: "center",
          text: ".....................................ប្រាកដមែន។",
          font: "KhmerOSSiem",
        },
        {
          alignment: "center",
          text: "នាយក/សាកលវិទ្យាធិការ",
          style: "header1",
        },
        index !== data.length - 1 ? { text: "", pageBreak: "after" } : {}
    ];
  }).flat();

  }
  
  var docDefinition = {
    pageSize: "A4",
    pageOrientation: "portrait",
    // pageMargins: [30, 40, 30, 40],
    content: content(data),
    styles: {
      title: {
        fontSize: 11,
        alignment: "center",
        font: "KhmerOSMoul",
        alignment: "center",
        color: "blue",
      },
      header1: {
        fontSize: 11,
        font: "KhmerOSMoul",
        color: "blue",
      },
    },
    default: {
      font: "KhmerOSSiem",
      fontSize: 9,
    },
  }; 
  // pdfMake.createPdf(docDefinition).print();// Opens the PDF   in a new window

    pdfMake.createPdf(docDefinition).getBuffer(function(buffer) {
      // Create a new ZIP file
      var zip = new JSZip();

      // Add the PDF file to the ZIP
      zip.file("document.pdf", buffer);

      // Generate the ZIP and trigger a download
      zip.generateAsync({ type: "blob" }).then(function(content) {
        // Use FileSaver.js to save the ZIP file
        saveAs(content, "document.zip");
      });
    });
  
}





 