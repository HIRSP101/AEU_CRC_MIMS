<div id="usermodal" class="absolute origin-center left-0 right-0 top-1 z-50 hidden">
    <div
        class=" max-w-2xl mx-4 sm:max-w-sm md:max-w-sm lg:max-w-sm xl:max-w-sm sm:mx-auto md:mx-auto lg:mx-auto xl:mx-auto mt-16 bg-white shadow-xl rounded-lg text-gray-900 ">
        <div class="rounded-t-lg h-32 overflow-hidden">
            <img class="object-cover object-top w-full"
                src='https://images.unsplash.com/photo-1549880338-65ddcdfd017b?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ'
                alt='Mountain'>
        </div>
        <div class="mx-auto w-32 h-32 relative -mt-16 border-4 border-white rounded-full overflow-hidden">
            <img class="object-cover object-center h-32"
                src='https://avatars.githubusercontent.com/u/120011788?s=400&v=4'
                alt='ava'>
        </div>
        <div class="text-center mt-2">
            <h2 class="font-semibold">{{ auth()->user()->name }} {{auth()->user()->hasRole('admin') ? '(admin)' : ""}}</h2>
            <p class="text-gray-500">{{ auth()->user()->email }}</p>
        </div>
        <ul class="py-1 mt-2 text-gray-700 flex items-center justify-around">
            <li>
                @include('dashboard.partials.user.profile.updateusername')
                @if(auth()->user()->hasRole('admin'))
                    @include('dashboard.partials.user.profile.updatepassword')
                @endif
            </li>
        </ul>
        <div class="p-4 flex items-center justify-content-center border-t mx-8 mt-2">
            <button
               id="saveprofile" class="mx-auto rounded-full bg-green-700 hover:shadow-lg font-semibold text-white px-6 py-2">Save</button>
            <button
              id="cancel"  class="mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white px-6 py-2">Cancel</button>
        </div>
    </div>
</div>
