<h1 class="my-3">ទីកន្លែងកំណើត (Place of Birth)</h1>
<hr>
<div class="flex flex-wrap -mx-3 mt-3 mb-6">
    <div class="w-full md:w-1/4 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="village">
            ភូមិ
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="village" type="text" id="village" required>
    </div>
    <div class="w-full md:w-1/4 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="commune">
            ឃុំ/សង្កាត់
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="commune" type="text" id="commune" required>
    </div>
    <div class="w-full md:w-1/4 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="district">
            ស្រុក/ខណ្ឌ
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="district" id="district" type="text" required>
    </div>
    <div class="w-full md:w-1/4 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="province">
            ខេត្ត/រាជធានី
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            list="proviencelist" id="provience" type="text" required>
        <datalist id="proviencelist" name="proviencelist">
            @foreach ($branches as $key => $val)
                <option data-id="{{ $key }}" value="{{ $val }}">
            @endforeach
        </datalist>
    </div>
</div>
