<div id="sidebar" class=" top-0 left-0 border shadow">
    <div class="flex flex-col flex-1 overflow-y-auto">
        <nav class="flex-1 px-2 py-4 bg-white">
            <a class="flex justify-center items-center"  href="">
                <img class="logo w-20  transition ease-in-out  duration-300"
                    src="{{ asset('assets/images/Logo_of_Cambodian_Red_Cross.svg') }}">
            </a>
            <div class="mt-5">
                <a href="{{ route('provinces') }}"
                    class="flex items-center px-2 py-2 text-gray-800 font-semibold hover:bg-red-600 hover:text-white rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span class="module-content font-battambang font-bold hover:text-white text-blue-700 text-[16px]">
                        សាខា & អនុសាខា
                    </span>
                </a>

                <li class="list-none">
                    <button type="button" id="subModule-add"
                        class="flex items-center w-full px-2 py-2 mt-2  font-semibold hover:bg-red-600 hover:text-white rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            # stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <span
                            class="module-content flex-1 text-left rtl:text-right whitespace-nowrap font-battambang font-bold hover:text-white text-blue-700 text-[16px]">បញ្ចូលសាមាជិក</span>

                    </button>
                </li>

                <li class="list-none">
                    <ul id="dropdown-add" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('create-member') }}"
                                class="module-content flex items-center w-full p-2 font-battambang text-blue-700 text-[16px]  transition duration-75 rounded-md pl-11 group hover:text-white hover:bg-red-600 font-semibold">បញ្ចូលតាម
                                Form</a>
                        </li>
                        <li>
                            <a href="#"
                                class="module-content flex items-center w-full p-2 font-battambang text-blue-700 text-[16px] transition duration-75 rounded-md pl-11 group hover:text-white hover:bg-red-600 font-semibold">បញ្ចូលតាម
                                File</a>
                        </li>
                    </ul>
                </li>

                <li class="list-none">
                    <button type="button" id="subModule-create"
                        class="flex items-center w-full px-2 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-600 hover:text-white rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <span
                            class="module-content flex-1 text-left rtl:text-right whitespace-nowrap font-battambang text-blue-700 text-[16px] hover:text-white">បង្កើត</span>
                    </button>
                    <ul id="dropdown-create" class="hidden py-2 space-y-2">
                        <li>
                            <a href="#"
                                class="module-content flex items-center w-full p-2  transition duration-75 rounded-md pl-11 group hover:text-white hover:bg-red-600 font-semibold font-battambang text-blue-700 text-[16px]">បង្កើតសាមាជិក</a>
                        </li>
                        <li>
                            <a href="#"
                                class="module-content flex items-center w-full p-2 text-blue-700 text-[16px]  transition duration-75 rounded-md pl-11 group hover:text-white hover:bg-red-600 font-semibold font-battambang ">បង្កើតសាខា
                                & អនុសាខា</a>
                        </li>
                    </ul>
                </li>

                <a href="{{ route('report-page') }}"
                    class="flex items-center px-2 py-2 text-gray-800 font-semibold hover:bg-red-600 hover:text-white rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span class="module-content font-siemreap text-blue-700 text-[16px] hover:text-white">
                        របាយការណ៍
                    </span>
                </a>
            </div>
        </nav>
    </div>
</div>

@push('JS')
    <script>
        $("#subModule-add").click(() => {
            $("#dropdown-add").toggle(200);
        });

        $("#subModule-create").click(() => {
            $("#dropdown-create").toggle(200);
        });
    </script>
@endpush
