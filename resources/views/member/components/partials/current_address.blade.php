<h1 class="text-lg font-semibold my-3 font-battambang">អាសយដ្ធានបច្ចុប្បន្ន (Current Address)</h1>
<hr class="border-gray-300">

<!-- Address Row 1 -->
<div class="flex flex-wrap gap-4 mt-3 mb-6 font-battambang">
    <!-- House Number -->
    <div class="w-full md:w-1/5 px-3">
        <label for="housenumber" class="block uppercase tracking-wide text-gray-700 mb-2">ផ្ទះលេខ</label>
        <input id="housenumber" name="housenumber" type="text"
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>

    <!-- Street -->
    <div class="w-full md:w-1/5 px-3">
        <label for="street" class="block uppercase tracking-wide text-gray-700 mb-2">ផ្លូវ</label>
        <input id="street" name="street" type="text"
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>

    <!-- Village -->
    <div class="w-full md:w-1/5 px-3">
        <label for="current_village" class="block uppercase tracking-wide text-gray-700 mb-2">ភូមិ</label>
        <input id="current_village" name="current_village" type="text"
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>

    <!-- Commune -->
    <div class="w-full md:w-1/5 px-3">
        <label for="current_commune" class="block uppercase tracking-wide text-gray-700 mb-2">ឃុំ/សង្កាត់</label>
        <input id="current_commune" name="current_commune" type="text" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>
</div>

<!-- Address Row 2 -->
<div class="flex flex-wrap gap-4 mb-6 font-battambang">
    <!-- District -->
    <div class="w-full md:w-1/3 px-3">
        <label for="current_district" class="block uppercase tracking-wide text-gray-700 mb-2">ស្រុក/ខណ្ឌ</label>
        <input id="current_district" name="current_district" type="text"
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>

    <!-- Province -->
    <div class="w-full md:w-1/4 px-3">
        <label for="current_provience" class="block uppercase tracking-wide text-gray-700 mb-2">ខេត្ត/រាជធានី</label>
        <input id="current_provience" name="current_provience" type="text" list="proviencelist" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
        <datalist id="proviencelist">
            @foreach($branches as $key => $val)
                <option data-id="{{ $key }}" value="{{ $val }}"></option>
            @endforeach
        </datalist>
    </div>
</div>

<hr class="border-gray-300 my-4">

<!-- Date of Birth -->
<div class="flex flex-wrap mb-6 font-battambang">
    <div class="w-full md:w-1/4 px-3">
        <label for="dateofbirth" class="block uppercase tracking-wide text-gray-700 mb-2">
            ថ្ងៃទី ខែ ឆ្នាំកំណើត
        </label>
        <input id="dateofbirth" name="dateofbirth" type="date" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>
</div>
