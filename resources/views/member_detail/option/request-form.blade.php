
    <div class="mx-[25%] bg-white px-8 py-8 mt-5 mb-5 hidden" id="request-form">
        <div class="head mt-2">
            <h3 class="font-battambang font-bold text-xl">សាខាកាកបាទក្រហមកម្ពុជា</h3>
            <h3 class="font-battambang ml-12 font-bold text-xl">រាជធានី ខេត្ត</h3>
            <h3 class="font-battambang">លេខ........................កក្រក...........</h3>

            <div class="text-end font-battambang italic">
                <h3>ថ្ងៃ................ខែ..........ឆ្នាំថោះ បញ្ចស័ក ព.ស.២៥.....</h3>
                <h3>រាជធានីភ្នំពេញ/ខេត្ត ថ្ងៃទី       ខែ....... ឆ្នាំ២០........</h3>
            </div>

            <h3 class="text-center text-xl font-bold font-battambang mt-5">
                វិញ្ញាបនបត្ររដ្ឋបាល
            </h3>
            <h3 class="text-center text-xl font-bold font-battambang mt-2">
                សាខាកាកបាទក្រហមកម្ពុជា រាជធានី ខេត្ត{{$member->branch_kh ?? '.................................'}}
            </h3>   
            <h3 class="text-center text-xl font-bold font-battambang mt-2 underline">
               សូមបញ្ជាក់ថា
            </h3>
        </div>
        <div class="content1 mt-5 font-battambang mx-auto">
            <p class="ml-9">
                លោក/កញ្ញា <span class="font-bold">{{$member->name_kh ?? '........'}}</span> ភេទ <span class="font-bold">{{$member->gender ?? '......'}}</span>  ជនជាតិខ្មែរ សញ្ជាតិខ្មែរ ថ្ងៃខែឆ្នាំកំណើត {{$member->date_of_birth ?? '............'}} 
            </p>
            <p class="mt-2">
                មានអាសយដ្ឋាននៅផ្ទះលេខ <span class="font-bold">{{$member->home_no ?? '......'}}</span>  ផ្លូវ <span class="font-bold">{{$member->street_no ?? '......'}}</span>
                {{$member->full_current_address}} ។
            </p>
            <p class="mt-2">
                 បានចូលស្ម័គ្រចិត្តជាយុវជនកាកបាទក្រហមកម្ពុជា វិទ្យាល័យ <span class="font-bold">{{$member->school_name ?? '.........................'}}</span>  រាជធានី/ខេត្ត <span class="font-bold">{{$member->branch_kh ?? '..............' }}</span>
            </p>
            <p class="mt-2">
                 ចាប់តាំងពីថ្ងៃទី {{$member->registration_date ?? '........ខែ.............ឆ្នាំ.....................'}} ដល់ថ្ងៃទី........ខែ.............ឆ្នាំ..................... ពិតប្រាកដមែន។
            </p>
            <p class="mt-2">
                 នៅក្នុងរយៈពេលស្ម័គ្រចិត្តបម្រើការងារនេះ សាមីខ្លួនបានលះបង់ពេលវេលាចំពោះកម្លាំងកាយ ប្រាជ្ញា ស្មារតី
            </p>
            <p class="mt-2">
                ថវិកាផ្ទាល់ខ្លួន និងយកចិត្តទុកដាក់សកម្មចូលរួមជាមួយកាកបាទក្រហមកម្ពុជា ក្នុងតួនាទីជាយុវជនស្ម័គ្រចិត្ត
            </p>
            <p class="mt-2">
                 ដើម្បីបុព្វហេតុមនុស្សធម៌។
            </p>
        </div>
        
        <div class="foot mt-5 font-battambang">
            <p class="mt-2">
                <span class="ml-9">វិញ្ញាបនបត្រ</span>រដ្ឋបាលនេះ ចេញជូនសាមីខ្លួនសម្រាប់ប្រើប្រាស់តាមច្បាប់ដែលអាចប្រើទៅបាន និង
            </p>
            <p class="mt-2">
                ក្នុងគោលបំណងផ្ទេរជីវភាពពីគ្រឹះស្ថានសិក្សា បន្ដចូលគ្រឹះស្ថានសិក្សា រាជធានី ខេត្ត ដែលមានបណ្ដាញ
            </p>
            <p class="mt-2">
                ក្លឹបយុវជនកាកបាទក្រហមកម្ពុជា។
            </p>
        </div>
        <div class="text-xs font-battambang mt-24 text-gray-700">
            <p>កន្លែងទទួល៖</p>
            <p>- គ្រឹះស្ថានសិក្សា ទូទាំង ២៥ រាជធានី ខេត្ត</p>
            <p>- សាមីខ្លួន</p>    
            <p>- ឯកសារ កាលប្បវត្តិ</p>
        </div>
    </div>