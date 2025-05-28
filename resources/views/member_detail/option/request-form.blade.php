@php
    use App\Helpers\DateTimeFormat;
    $parts = explode('-', DateTimeFormat::convertEnglishToKhmerNumbersAndMonth($member->date_of_birth));
    $registerDate = explode('-', DateTimeFormat::convertEnglishToKhmerNumbersAndMonth($member->registration_date));
    $expireDate = explode('-', DateTimeFormat::convertEnglishToKhmerNumbersAndMonth($member->expiration_date));
    $dayOfBirth = $parts[0];
    $monthOfBirth = $parts[1];
    $yearOfBirth = $parts[2];
    $dayOfRegis = $registerDate[0];
    $monthOfRegis = $registerDate[1];
    $yearOfRegis = $registerDate[2];
    $dayOfExpire = $expireDate[0];
    $monthOfExpire = $expireDate[1];
    $yearOfExpire = $expireDate[2];
@endphp
<div class="w-[210mm] m-5 h-auto bg-white shadow-lg mx-auto hidden" id="request-form">
    <div style="padding: 60px">
        <div class="head mt-2">
            <h3 class="font-khmer text-[16px] text-gray-900">សាខាកាកបាទក្រហមកម្ពុជា</h3>
            <h3 class="font-khmer mx-12 text-[16px] text-gray-900">រាជធានី ខេត្ត</h3>
            <h3 class="font-battambang">លេខ........................កក្រក...........</h3>

            <div class="text-end font-battambang italic text-gray-800">
                <h3>ថ្ងៃ................ខែ..........ឆ្នាំថោះ បញ្ចស័ក ព.ស.២៥.....</h3>
                <h3>រាជធានីភ្នំពេញ/ខេត្ត ថ្ងៃទី ខែ....... ឆ្នាំ២០........</h3>
            </div>

            <h3 class="text-center text-[18px] font-khmer mt-5 text-gray-900">
                វិញ្ញាបនបត្ររដ្ឋបាល
            </h3>
            <h3 class="text-center text-[18px] font-khmer mt-2 text-gray-900">
                សាខាកាកបាទក្រហមកម្ពុជា រាជធានី ខេត្ត<span
                    class="font-battambang font-medium">.................................</span>
            </h3>
            <h3 class="text-center text-[16px] font-khmer mt-2 underline text-gray-900">
                សូមបញ្ជាក់ថា
            </h3>
        </div>
        <div class="content1 mt-5 font-battambang text-gray-900 text-[18px]">
            <div class="flex ml-9 md:mb-0 relative">
                <div>
                    <h3 class="">
                        លោក/កញ្ញា<span>..............................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[80px] font-bold">{{$member->name_kh ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        ភេទ<span>............</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[240px] font-bold">{{$member->gender ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        ជនជាតិខ្មែរ សញ្ជាតិខ្មែរ កើតថ្ងៃទី<span>..............</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[500px] font-bold">{{$dayOfBirth ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        ខែ<span>................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[575px] font-bold">{{$monthOfBirth ?? ""}}</span>
                </div>
            </div>
            <div class="flex md:mb-0 relative">
                <div>
                    <h3 class="">
                        ឆ្នាំ<span>..............</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[20px] font-bold">{{$yearOfBirth ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        មានអាសយដ្ឋាននៅផ្ទះលេខ<span>.............</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[260px] font-bold">{{$member->home_no ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        ផ្លូវ<span>............</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[320px] font-bold">{{$member->street_no ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        ភូមិ<span>......................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[410px] font-bold">{{$member->current_village ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        ឃុំ/សង្កាត់<span>..........................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[570px] font-bold">{{$member->current_commune ?? ""}}</span>
                </div>
            </div>
            <div class="flex md:mb-0 relative">
                <div>
                    <h3 class="">
                        ស្រុក/ខណ្ឌ<span>.......................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[75px] font-bold">{{$member->current_district ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        រាជធានី/ខេត្ត<span>...........................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[255px] font-bold">{{$member->current_province ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        បានចូលស្ម័គ្រចិត្តជាយុវជនកាកបាទក្រហមកម្ពុជា
                    </h3>
                    <span class="absolute top-[-3px] left-[320px] font-bold">{{$member->street_no ?? ""}}</span>
                </div>
            </div>
            <div class="flex md:mb-0 relative">
                <div>
                    <h3 class="">
                        <span>..............................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[0px] font-bold">{{$member->institute_kh ?? $member->school_name}}</span>
                </div>
                <div>
                    <h3 class="">
                        រាជធានី/ខេត្ត<span>...........................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[285px] font-bold">{{$member->branch_kh ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        ចាប់តាំងពីថ្ងៃទី<span>.........</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[495px] font-bold">{{$dayOfRegis ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        ខែ<span>............</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[550px] font-bold">{{$monthOfRegis ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        ឆ្នាំ<span>.............</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[615px] font-bold">{{$yearOfRegis ?? ""}}</span>
                </div>
            </div>
            <div class="flex md:mb-0 relative">
                <div>
                    <h3 class="">
                        ដល់ថ្ងៃទី<span>..............</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[70px] font-bold">{{$dayOfExpire ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        ខែ<span>...............</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[140px] font-bold">{{$monthOfExpire ?? ""}}</span>
                </div>
                <div>
                    <h3 class="">
                        ឆ្នាំ<span>......................</span>ពិតប្រាកដមែន។ នៅក្នុងរយៈពេលស្ម័គ្រចិត្តបម្រើការងារនេះ
                    </h3>
                    <span class="absolute top-[-3px] left-[230px] font-bold">{{$yearOfExpire ?? ""}}</span>
                </div>
            </div>
            <p class="mt-2">
                សាមីខ្លួនបានលះបង់ពេលវេលាចំពោះកម្លាំងកាយ ប្រាជ្ញា ស្មារតី ថវិកាផ្ទាល់ខ្លួន និងយកចិត្តទុកដាក់សកម្មចូល
            </p>
            <p class="mt-2">
                រួមជាមួយកាកបាទក្រហមកម្ពុជា ក្នុងតួនាទីជាយុវជនស្ម័គ្រចិត្ត ដើម្បីបុព្វហេតុមនុស្សធម៌។
            </p>

             <p class="mt-5 ml-9">
                វិញ្ញាបនបត្ររដ្ឋបាលនេះចេញជូនសាមីខ្លួនសម្រាប់ប្រើប្រាស់តាមច្បាប់ដែលអាចប្រើទៅបាន និងក្នុងគោល
               
            </p>
            <p class="mt-2">
                បំណងផ្ទេរជីវភាពពីគ្រឹះស្ថានសិក្សា បន្ដចូលគ្រឹះស្ថានសិក្សា រាជធានី ខេត្ត ដែលមានបណ្ដាញ
                ក្លឹបយុវជនកាកបាទក្រហមកម្ពុជា។
            </p>
        </div>
        <div class="text-xs font-battambang mt-24 text-gray-900 text-[11px]">
            <p>កន្លែងទទួល៖</p>
            <p>- គ្រឹះស្ថានសិក្សា ទូទាំង ២៥ រាជធានី ខេត្ត</p>
            <p>- សាមីខ្លួន</p>
            <p>- ឯកសារ កាលប្បវត្តិ</p>
        </div>
    </div>
    <div class="px-12">
        <button
            class="word-request-btn mt-12 text-white text-[15px] bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-2 focus:outline-none rounded-xl px-4 py-2 text-center inline-flex items-center justify-between mr-2 mb-2"
            id="word-btn" onclick="exportRequestForm();">Export word</button>
        <button
            class="pdf-btn mt-12 text-white text-[15px] bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-2 focus:outline-none rounded-xl px-4 py-2 text-center inline-flex items-center justify-between mr-2 mb-2"
            id="exportPdfRequestForm">Export PDF</button>
    </div>
</div>