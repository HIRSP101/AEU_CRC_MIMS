<div id="usermodal"
    class="fixed inset-0 top-5 hidden bg-black/50 z-[99999] flex items-start justify-center overflow-y-auto pointer-events-none">

    <div class="relative w-full max-w-md bg-white shadow-xl rounded-lg text-gray-900 my-12 pointer-events-auto"
        role="dialog" aria-modal="true">

        <button id="closeModalBtn" class="absolute top-3 right-3 flex items-center justify-center 
               w-4 h-4 rounded-full bg-white shadow-md 
               text-gray-500 hover:text-gray-800 hover:bg-gray-100">
            ✕
        </button>

        <div class="rounded-t-lg h-32 overflow-hidden">
            <img class="object-cover object-top w-full"
                src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b?auto=format&fit=crop&w=600&q=80"
                alt="Mountain">
        </div>


        <div class="mx-auto w-32 h-32 relative -mt-16 border-4 border-white rounded-full overflow-hidden">
            <img class="object-cover object-center h-32 w-32"
                src="https://avatars.githubusercontent.com/u/120011788?s=400&v=4" alt="ava">
        </div>

        <!-- User Info -->
        <div class="text-center mt-2 px-4">
            <h2 class="font-semibold">
                {{ auth()->user()->name }}
                {{ auth()->user()->hasRole('admin') ? '(admin)' : ""}}
            </h2>
            <p class="text-gray-600">{{ auth()->user()->email }}</p>
        </div>


        <ul class="py-2 mt-3 text-gray-700 flex items-center justify-center gap-4">
            <li>
                @include('dashboard.partials.user.profile.updateusername')
                @if(auth()->user()->hasRole('admin'))
                    @include('dashboard.partials.user.profile.updatepassword')
                @endif
            </li>
        </ul>


        <div class="p-4 flex justify-center gap-4 border-t mt-2">
            <button id="saveprofile"
                class="rounded-full bg-green-700 hover:shadow-lg font-semibold text-white px-6 py-2">
                Save
            </button>
            <button id="cancel" class="rounded-full bg-gray-700 hover:shadow-lg font-semibold text-white px-6 py-2">
                Cancel
            </button>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('usermodal');
    const cancelBtn = document.getElementById('cancel');
    const closeBtn = document.getElementById('closeModalBtn');

    function openModal() {
        modal.classList.remove('hidden');
    }

    function closeModal() {
        modal.classList.add('hidden');
    }

    cancelBtn.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', (e) => {
        // Only close if clicking backdrop, not modal content
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
</script>