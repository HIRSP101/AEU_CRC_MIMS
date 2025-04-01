<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .title1 {
            font-family: 'font-khmer';
        }

        .title2 {
            font-family: 'font-khmer';
        }

        .lek {
            font-family: 'font-battambang';
        }

        .title-date {
            font-family: 'font-battambang';
            font: italic;
            text-align: end;
        }

        .big-title1 {
            font-family: 'font-khmer';
            font-size: 18px;
            text-align: center;
        }

        .big-title2 {
            font-family: 'font-khmer';
            font-size: 18px;
            text-align: center;
        }

        .sub-title {
            font-family: 'font-khmer';
            font-size: 16px;
            text-decoration: underline;
            text-align: center;
        }

        span {
            font-family: 'font-battambang';
            font-weight: bold;
        }

        .container {
            margin-left: 40px;
            margin-right: 40px;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .small-text {
            font-family: 'font-battambang';
            margin-top: 100px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="container mx-[25%] bg-white px-8 py-8 mt-5 mb-5 hidden" id="request-form">
        <div class="head mt-2">
            <h3 class="title1">សាខាកាកបាទក្រហមកម្ពុជា</h3>
            <h3 class="title2">រាជធានី ខេត្ត</h3>
            <h3 class="lek">លេខ........................កក្រក...........</h3>

            <div class="title-date text-end font-battambang italic text-gray-800">
                <h3>ថ្ងៃ................ខែ..........ឆ្នាំថោះ បញ្ចស័ក ព.ស.២៥.....</h3>
                <h3>រាជធានីភ្នំពេញ/ខេត្ត ថ្ងៃទី ខែ....... ឆ្នាំ២០........</h3>
            </div>

            <h3 class="big-title1 text-center text-[18px] font-khmer mt-5 text-gray-900">
                វិញ្ញាបនបត្ររដ្ឋបាល
            </h3>
            <h3 class="big-title2 text-center text-[18px] font-khmer mt-2 text-gray-900">
                សាខាកាកបាទក្រហមកម្ពុជា រាជធានី ខេត្ត<span
                    class="font-battambang font-medium">.................................</span>
            </h3>
            <h3 class="sub-title text-center text-[16px] font-khmer mt-2 underline text-gray-900">
                សូមបញ្ជាក់ថា
            </h3>
        </div>
        <div class="content1 mt-5 font-battambang text-gray-900 text-[16px]">
            <p class="ml-9">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;លោក/កញ្ញា <span
                    class="font-bold">{{$member->name_kh ?? '........'}}</span> ភេទ <span
                    class="font-bold">{{$member->gender ?? '......'}}</span> ជនជាតិខ្មែរ សញ្ជាតិខ្មែរ ថ្ងៃខែឆ្នាំកំណើត
                {{$member->date_of_birth ?? '............'}} ។

                មានអាសយដ្ឋាននៅផ្ទះលេខ <span class="font-bold">{{$member->home_no ?? '......'}}</span> ផ្លូវ <span
                    class="font-bold">{{$member->street_no ?? '......'}}</span>
                {{$member->full_current_address}} ។

                បានចូលស្ម័គ្រចិត្តជាយុវជនកាកបាទក្រហមកម្ពុជា វិទ្យាល័យ <span
                    class="font-bold">{{$member->school_name ?? '.........................'}}</span> រាជធានី/ខេត្ត <span
                    class="font-bold">{{$member->branch_kh ?? '..............' }}</span>

                ចាប់តាំងពីថ្ងៃទី {{$member->registration_date ?? '........ខែ.............ឆ្នាំ.....................'}}
                ដល់ថ្ងៃទី........ខែ.............ឆ្នាំ..................... ពិតប្រាកដមែន។

                នៅក្នុងរយៈពេលស្ម័គ្រចិត្តបម្រើការងារនេះ សាមីខ្លួនបានលះបង់ពេលវេលាចំពោះកម្លាំងកាយ ប្រាជ្ញា ស្មារតី
                ថវិកាផ្ទាល់ខ្លួន និងយកចិត្តទុកដាក់សកម្មចូលរួមជាមួយកាកបាទក្រហមកម្ពុជា
                ក្នុងតួនាទីជាយុវជនស្ម័គ្រចិត្តដើម្បីបុព្វហេតុមនុស្សធម៌។
            </p>
            <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;វិញ្ញាបនបត្ររដ្ឋបាលនេះ
                ចេញជូនសាមីខ្លួនសម្រាប់ប្រើប្រាស់តាមច្បាប់ដែលអាចប្រើទៅបាន
                និងក្នុងគោលបំណងផ្ទេរជីវភាពពីគ្រឹះស្ថានសិក្សា បន្ដចូលគ្រឹះស្ថានសិក្សា រាជធានី ខេត្ត
                ដែលមានបណ្ដាញក្លឹបយុវជនកាកបាទក្រហមកម្ពុជា។
            </p>

            <p class="small-text">កន្លែងទទួល៖<br>
                - គ្រឹះស្ថានសិក្សា ទូទាំង ២៥ រាជធានី ខេត្ត<br>
                - សាមីខ្លួន<br>
                - ឯកសារ កាលប្បវត្តិ</p>

        </div>
    </div>
</body>

</html>