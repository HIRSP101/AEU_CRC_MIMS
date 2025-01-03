<div id="sidebar" class="top-0 left-0 border shadow">
    {{-- <div class="flex items-center justify-between h-16 px-4 md:hidden">
        <span class="text-white font-bold uppercase">Sidebar</span>
        <button id="closeSidebar" class="text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div> --}}
    <div class="flex flex-col flex-1 overflow-y-auto">
        <nav class="flex-1 px-2 py-4 bg-white">

            <a class="flex justify-center items-center" href="{{ route('dashboard') }}">
                <img class="logo w-20" src="{{ asset('images/Logo_of_Cambodian_Red_Cross.svg') }}">
            </a>
            <div class="mt-10">
            @if(auth()->user()->hasRole('admin'))
                <a href="{{route('branch')}}" class="flex items-center font-siemreap px-4 py-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 384 512">
                        <path
                            d="M48 0C21.5 0 0 21.5 0 48L0 464c0 26.5 21.5 48 48 48l96 0 0-80c0-26.5 21.5-48 48-48s48 21.5 48 48l0 80 96 0c26.5 0 48-21.5 48-48l0-416c0-26.5-21.5-48-48-48L48 0zM64 240c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32zm112-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32zM80 96l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32zM272 96l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16z" />
                    </svg>
                    <span class="module-content">
                        សាខា & អនុសាខា
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 transition delay-100 duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span class="module-content flex-1 text-left rtl:text-right whitespace-nowrap">បញ្ចូលសាមាជិក</span>

                </a>
                <div id="dropdown-add" class="ml-5 dropdown_entry hidden">
                    <a href="{{ route('import') }}" class=" module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        + បញ្ជូលជា File 
                    </a>
                    <a href="{{ route('createmember') }}" class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        + បញ្ជូលតាម Form
                    </a>
                </div>
                @if(auth()->user()->hasRole('admin'))
                <a href="" id="dropdown_create" class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 transition delay-100 duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span class="module-content flex-1 text-left rtl:text-right whitespace-nowrap">បង្កើត</span>

                </a>
                <div class="ml-5 dropdown_create hidden">
                    <a href="{{ route('userroles') }}" class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        + បង្កើត User
                    </a>
                    <a href="{{ route('create-branch') }}" class="module-content flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                        + បង្កើត សាខា&អនុសាខា
                    </a>
                </div>
                @endif
                <a href="{{route('report')}}" class="flex items-center font-siemreap px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" width="28" height="28" viewBox="0 0 30 30">
                        <path d="M24.707,8.793l-6.5-6.5C18.019,2.105,17.765,2,17.5,2H7C5.895,2,5,2.895,5,4v22c0,1.105,0.895,2,2,2h16c1.105,0,2-0.895,2-2 V9.5C25,9.235,24.895,8.981,24.707,8.793z M18,21h-8c-0.552,0-1-0.448-1-1c0-0.552,0.448-1,1-1h8c0.552,0,1,0.448,1,1 C19,20.552,18.552,21,18,21z M20,17H10c-0.552,0-1-0.448-1-1c0-0.552,0.448-1,1-1h10c0.552,0,1,0.448,1,1C21,16.552,20.552,17,20,17 z M18,10c-0.552,0-1-0.448-1-1V3.904L23.096,10H18z"></path>
                    </svg>
                    <span class="module-content">
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
