<div id="sidebar" class="fixed inset-0 top-0 left-0 border shadow bg-gray-800 md:relative md:w-64 md:block md:translate-x-0 transform transition-transform duration-300 ease-in-out -translate-x-full">
    <div class="flex items-center justify-between h-16 bg-gray-900 px-4 md:hidden">
        <span class="text-white font-bold uppercase">Sidebar</span>
        <button id="closeSidebar" class="text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div class="flex flex-col flex-1 overflow-y-auto">
        <nav class="flex-1 px-2 py-4 bg-white">

            <a class="flex justify-center items-center" href="">
                <img class="w-20" src=".{{ asset('images/Logo_of_Cambodian_Red_Cross') }}" alt="">
            </a>

           <div class="mt-10">
                <a href="#" class="flex items-center px-4 py-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Messages
                </a>
                <a href="#" class="flex items-center px-4 py-2 mt-2 text-gray-800 font-semibold hover:bg-red-400 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Settings
                </a>
           </div>
        </nav>
    </div>
</div>
