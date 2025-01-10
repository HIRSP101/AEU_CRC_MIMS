<div id="sidebar" class="top-0 left-0 border shadow">
    <div class="flex flex-col flex-1 overflow-y-auto">
        <nav class="flex-1 px-2 py-4 bg-white">

            <a class="flex justify-center items-center" href="{{ route('dashboard') }}">
                <img class="logo w-20" src="{{ asset('images/Logo_of_Cambodian_Red_Cross.svg') }}">
            </a>
            <div class="mt-10">
            @if(auth()->user()->hasRole('admin'))
                <a href="{{route('branch')}}" class="flex items-center font-siemreap px-4 py-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <img width="23" height="23" src="https://img.icons8.com/external-glyph-zulfa-mahendra/48/external-building-nature-and-ecology-2-glyph-zulfa-mahendra-3.png" alt="external-building-nature-and-ecology-2-glyph-zulfa-mahendra-3"/>
                    <span class="module-content ml-2">
                        សាខា
                    </span>
                </a>

                <a href="{{route('branchhei')}}" class="flex items-center font-siemreap px-4 py-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <img width="23" height="23" src="https://img.icons8.com/external-gradak-royyan-wijaya/24/external-building-gradak-medical-solidarity-gradak-royyan-wijaya.png" alt="external-building-gradak-medical-solidarity-gradak-royyan-wijaya"/>                      <span class="module-content ml-2">
                        អនុសាខា
                    </span>
                </a>
            @endif
                {{-- <a href="" class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    អ្នកប្រើប្រាស់
                </a> --}}
                <a href=""  id="subModule-add" class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <img width="23" height="23" src="https://img.icons8.com/ios-filled/50/add-row.png" alt="add-row"/>
                    <span class="module-content ml-2 flex-1 text-left rtl:text-right whitespace-nowrap">បញ្ចូលសាមាជិក</span>
                </a>
                <div id="dropdown-add" class="ml-5 dropdown_entry hidden">
                    <a href="{{ route('import') }}" class=" module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png" alt="add--v1"/>
                       <span> បញ្ជូលជា File</span>
                    </a>
                    <a href="{{ route('createmember') }}" class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png" alt="add--v1"/>
                       <span> បញ្ជូលតាម Form</span>
                    </a>
                </div>
                @if(auth()->user()->hasRole('admin'))
                <a href="" id="dropdown_create" class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <img width="23" height="23" src="https://img.icons8.com/stamp/32/create-new.png" alt="create-new"/>
                    <span class="module-content ml-2 flex-1 text-left rtl:text-right whitespace-nowrap">បង្កើត</span>
                </a>
                <div class="ml-5 dropdown_create hidden">
                    <a href="{{ route('userroles') }}" class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png" alt="add--v1"/>
                        <span> បង្កើត User</span>
                    </a>
                    <a href="{{ route('create-branch') }}" class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        <img width="22" height="22" src="https://img.icons8.com/ios-glyphs/30/add--v1.png" alt="add--v1"/>
                        <span> បង្កើត សាខា&អនុសាខា</span>
                    </a>
                </div>
                @endif
                <a href="{{route('report')}}" class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <img width="23" height="23" src="https://img.icons8.com/ios-filled/50/ratings.png" alt="ratings"/>
                    <span class="module-content ml-2">
                        របាយការណ៍
                    </span>
                </a>
            </div>
        </nav>
    </div>
</div>
@push("JS")
    <script>
        $("#subModule-add").click(() => {
            $("#dropdown-add").toggle(500);
        });
        $("#subModule-create").click(() => {
            $("#dropdown-create").toggle(500);
        });
    </script>   

@endpush
