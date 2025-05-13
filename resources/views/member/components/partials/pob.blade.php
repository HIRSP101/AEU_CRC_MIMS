<h1 class="text-lg font-semibold my-3">ទីកន្លែងកំណើត (Place of Birth)</h1>
<hr class="border-gray-300">

<div class="flex flex-wrap gap-4 mt-3 mb-6 font-battambang">
    <!-- Village -->
    <div class="w-full md:w-1/4 px-3">
        <label for="village" class="block uppercase tracking-wide text-gray-700 mb-2">
            ភូមិ
        </label>
        <input
            id="village" name="village" type="text" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
        >
    </div>

    <!-- Commune -->
    <div class="w-full md:w-1/4 px-3">
        <label for="commune" class="block uppercase tracking-wide text-gray-700 mb-2">
            ឃុំ/សង្កាត់
        </label>
        <input
            id="commune" name="commune" type="text" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
        >
    </div>

    <!-- District -->
    <div class="w-full md:w-1/4 px-3">
        <label for="district" class="block uppercase tracking-wide text-gray-700 mb-2">
            ស្រុក/ខណ្ឌ
        </label>
        <input
            id="district" name="district" type="text" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
        >
    </div>

    <!-- Province -->
    <div class="w-full md:w-1/4 px-3">
        <label for="province" class="block uppercase tracking-wide text-gray-700 mb-2">
            ខេត្ត/រាជធានី
        </label>
        <input
            id="province" name="province" type="text" list="proviencelist" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
        >
        <datalist id="proviencelist">
            @foreach ($branches as $key => $val)
                <option data-id="{{ $key }}" value="{{ $val }}"></option>
            @endforeach
        </datalist>
    </div>
</div>
