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
    <div class="px-20 py-12">
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
            <p class="ml-9">
                លោក/កញ្ញា <span class="font-bold">&ensp;{{$member->name_kh  ?? '........'}}&ensp;</span> ភេទ <span
                    class="font-bold">&ensp;{{$member->gender ?? '......'}}&ensp;</span> ជនជាតិខ្មែរ សញ្ជាតិខ្មែរ កើតថ្ងៃទី  {{$dayOfBirth}}  ខែ {{$monthOfBirth}}
            </p>
            <p class="mt-2">
                ឆ្នាំ&ensp;{{$yearOfBirth}}&ensp;មានអាសយដ្ឋាននៅផ្ទះលេខ <span
                    class="font-bold">{{$member->home_no ?? '.........'}}</span>
                ផ្លូវ <span class="font-bold"> {{$member->street_no ?? '..........'}} </span>
                ភូមិ {{$member->current_village ?? "...................."}} ឃុំ/សង្កាត់
                {{$member->current_commune ?? "...................."}} ។
            </p>
            <p class="mt-2">
                ស្រុក/ខណ្ឌ {{$member->current_district ?? "......................"}} រាជធានី/ខេត្ត
                {{$member->current_province ?? "...................."}} បានចូលស្ម័គ្រចិត្តជាយុវជនកាកបាទក្រហមកម្ពុជា
                <span class="font-bold">{{$member->school_name ?? $member->institute_kh}}</span> រាជធានី/ខេត្ត <span
                    class="font-bold">{{$member->branch_kh ?? '..............' }}</span>
                ចាប់តាំងពីថ្ងៃទី {{$dayOfRegis ?? "........"}} ខែ {{$monthOfRegis ?? "............."}} ឆ្នាំ
                {{$yearOfRegis ?? "..............."}}
            </p>
            <p class="mt-2">
                ដល់ថ្ងៃទី {{$dayOfExpire ?? "........"}} ខែ {{$monthOfExpire ?? "............."}} ឆ្នាំ
                {{$yearOfExpire ?? "....................."}} ពិតប្រាកដមែន។
                នៅក្នុងរយៈពេលស្ម័គ្រចិត្តបម្រើការងារនេះ
            </p>
            <p class="mt-2">
                សាមីខ្លួនបានលះបង់ពេលវេលាចំពោះកម្លាំងកាយ ប្រាជ្ញា ស្មារតី ថវិកាផ្ទាល់ខ្លួន និងយកចិត្តទុកដាក់ 
            </p>
            <p class="mt-2">
                សកម្មចូលរួមជាមួយកាកបាទក្រហមកម្ពុជា ក្នុងតួនាទីជាយុវជនស្ម័គ្រចិត្ត ដើម្បីបុព្វហេតុមនុស្សធម៌។
            </p>
        </div>

        <div class="foot mt-5 font-battambang text-gray-900 text-[18px]">
            <p class="mt-2">
                <span class="ml-9">វិញ្ញាបនបត្រ</span>រដ្ឋបាលនេះ
                ចេញជូនសាមីខ្លួនសម្រាប់ប្រើប្រាស់តាមច្បាប់ដែលអាចប្រើទៅបាន
                និង
            </p>
            <p class="mt-2">
                ក្នុងគោលបំណងផ្ទេរជីវភាពពីគ្រឹះស្ថានសិក្សា បន្ដចូលគ្រឹះស្ថានសិក្សា រាជធានី ខេត្ត ដែលមានបណ្ដាញ
            </p>
            <p class="mt-2">
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