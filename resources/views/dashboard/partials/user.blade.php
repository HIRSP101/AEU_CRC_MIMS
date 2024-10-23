<div id="dropdownMenu" class="hidden origin-top-right absolute right-0 items-center justify-center bg-gray-100 z-50">
    @include('dashboard.partials.user.nameplate')
    <div aria-label="navigation" class="py-2">
        <nav class="grid gap-1">
            @include('dashboard.partials.user.option1')
            @if(auth()->user()->hasRole('admin'))
            @include('dashboard.partials.user.option3')
            @endif
        </nav>
    </div>
    <div class="ml-1" aria-label="footer" class="pt-2">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit"
                class="flex items-center space-x-3 py-3 px-4 w-full leading-6 text-lg text-gray-600 focus:outline-none hover:bg-gray-100 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                    <path d="M9 12h12l-3 -3"></path>
                    <path d="M18 15l3 -3"></path>
                    <span>Logout</span>
                </svg>
        </form>
        </button>
    </div>
</div>
</div>
