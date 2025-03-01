<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambodian Red Cross Youth Individual Information</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Battambang:wght@400;700&display=swap');

        @import url('https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Moul&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


        @font-face {
            font-family: 'khmerOsMoulLight';
            src: url({{ storage_path('KhmerOSMuolLight-Regular.ttf') }});
        }


        body {
            font-family: 'Battambang', sans-serif;
            margin: 5px;
            line-height: 1.6;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
            height: auto;
        }

        .header h2 {
            font-size: 15px;
            margin: 10px 0;
        }

        .header h3 {
            font-size: 15px;
            margin: 5px 0;
        }

        .section-title {
            font-family: "Moul", serif;
            font-weight: 500;
            font-style: normal;
            font-size: 15px;
            color: #2563eb;
            text-decoration: underline;
            margin: 20px 0 10px;
        }

        .section-subtitle {
            color: #2563eb;
        }

        .inline-fields {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            margin-bottom: 5px;
        }

        .inline-fields span {
            white-space: nowrap;
        }

        .inline-fields strong {
            font-weight: bold;
        }

        .shirt-size {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
        }

        .shirt-size label {
            margin-right: 5px;
        }

        .footer {
            margin-top: 30px;
        }

        .footer .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .signature div {
            text-align: center;
            flex: 1;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="{{ $base64Image }}" width="120" alt="CRC Logo">

            <h2 class="section-title">សមាជិកកាកបាទក្រហមកម្ពុជា</h2>
            <h3 class="section-subtitle">Cambodian Red Cross Youth Individual Information</h3>
        </div>
        {{-- 1 --}}
        <h4 class="section-title">១- ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន (Personal Detail)</h4>
        <div class="inline-fields">
            <span>- ឈ្មោះ <strong>{{ $member->name_kh ?? '...' }}</strong></span>
            <span>អក្សរឡាតាំង <strong>{{ $member->name_en ?? '...' }}</strong></span>
            <span>ភេទ <strong>{{ $member->gender ?? '...' }}</strong></span>
        </div>
        <div class="inline-fields">
            <span>- ថ្ងៃ ខែ ឆ្នាំកំណើត <strong>{{ $member->date_of_birth ?? '...' }}</strong></span>
            <span>ទីកន្លែងកំណើត
                <strong>
                    ភូមិ {{ $member_pob->village ?? '...' }} ឃុំ/សង្កាត់ {{ $member_pob->commune_sangkat ?? '...' }}
                    ស្រុក/ខណ្ឌ {{ $member_pob->district_khan ?? '...' }}
                    ខេត្ត/រាជធានី {{ $member_pob->provience_city ?? '...' }}
                </strong>
            </span>
        </div>
        <div class="inline-fields">
            <span>- អាសយដ្ឋានបច្ចុប្បន្ន
                <strong>
                    ផ្ទះលេខ {{ $member_addr->home_no ?? '...' }}
                    ផ្លូវ {{ $member_addr->street_no ?? '...' }}
                    ភូមិ {{ $member_addr->village ?? '...' }}
                    ឃុំ/សង្កាត់ {{ $member_addr->commune_sangkat ?? '...' }}
                    ស្រុក/ខណ្ឌ {{ $member_addr->district_khan ?? '...' }}
                    ខេត្ត/រាជធានី {{ $member_addr->provience_city ?? '...' }}
                </strong>
            </span>
        </div>
        <div class="inline-fields">
            <span>- កម្រិតវប្បធម៌ <strong>{{ $member_edu->acadmedic_year ?? '...' }}</strong></span>
        </div>
        <div class="inline-fields">
            <span>- ភាសាបរទេស <strong>{{ $member_edu->language ?? '...' }}</strong></span>
        </div>
        <div class="inline-fields">
            <span>- ជំនាញផ្ទាល់ខ្លួន <strong>{{ $member_edu->major ?? '...' }}</strong></span>
        </div>
        <div class="shirt-size">
            <label>- ទំហំអាវ:</label>
            <input type="checkbox"> S
            <input type="checkbox"> M
            <input type="checkbox"> L
            <input type="checkbox"> XL
            <input type="checkbox"> XXL
        </div>
        <div class="inline-fields">
            <span>- លេខទូរស័ព្ទ <strong>{{ $member->phone_number ?? '...' }}</strong></span>
            <span>អ៊ីម៉ែល និងហ្វេសប៊ុក: <strong>{{ $member->email ?? '...' }}
                    {{ $member->facebook ?? '...' }}</strong></span>
        </div>

        {{-- 2 --}}
        <h4 class="section-title">២- វគ្គបណ្ដុះបណ្ដាល (Training Skill)</h4>
        <div class="inline-fields">
            <span>- ជំនាញភាសាបរទេស <strong>{{ $member_edu->language ?? '...' }}</strong></span>
        </div>
        <div class="inline-fields">
            <span>- ជំនាញកុំព្យូទ័រ <strong>{{ $member_edu->computer_skill ?? '...' }}</strong></span>
        </div>
        <div class="inline-fields">
            <span>- ជំនាញផ្សេងៗ <strong>{{ $member_edu->misc_skill ?? '...' }}</strong></span>
        </div>

        {{-- 3 --}}
        <h4 class="section-title">៣- ព័ត៌មានគ្រួសារ (Family Information)</h4>
        <div class="inline-fields">
            <span>- ឈ្មោះឪពុក: <strong>{{ $member_guardian->father_name ?? '...' }}</strong></span>
            <span>អាសយដ្ឋាន និងមុខរបរ
                <strong>
                    {{ $member_guardian->father_current_address ?? '...' }}
                    {{ $member_guardian->father_occupation ?? '...' }}
                </strong>
            </span>
        </div>
        <div class="inline-fields">
            <span>- ឈ្មោះម្ដាយ: <strong>{{ $member_guardian->mother_name ?? '...' }}</strong></span>
            <span>អាសយដ្ឋាន និងមុខរបរ
                <strong>
                    {{ $member_guardian->mother_current_address ?? '...' }}
                    {{ $member_guardian->mother_occupation ?? '...' }}
                </strong>
            </span>
        </div>
        <div class="inline-fields">
            <span>- លេខទូរស័ព្ទអាណាព្យាបាល <strong>{{ $member_guardian->guardian_phone ?? '...' }}</strong></span>
        </div>
        {{-- 4 --}}
        <h4 class="section-title">៤- កិច្ចសន្យា (Contract)</h4>
        <div class="footer">
            <p>&nbsp; ខ្ញុំបាទ/នាងខ្ញុំ សូមបញ្ញាក់ថា រាល់ព័ត៌មានដែលបានរៀបរាប់ជូនខាងលើ ពិតជាត្រឹមត្រូវពិតប្រាកដមែន
                ហើយយល់</p>
            <p>ព្រមចូលជាសមាជិកយុវជនកាកបាទក្រហម ចាប់ពីថ្ងៃចុះហត្ថលេខានេះតទៅ</p>
            <div class="signature">
                <div>
                    <p>ហត្ថលេខា</p>
                    <p>សមាជិក</p>
                </div>
                <div>
                    <p>ហត្ថលេខា</p>
                    <p>មេប្រតិបត្តិ</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
