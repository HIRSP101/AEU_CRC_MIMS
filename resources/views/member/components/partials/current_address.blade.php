<h1 class="my-3">អាសយដ្ធានបច្ចុប្បន្ន (Current Address) hahah</h1>
<hr>
<div class="flex flex-wrap -mx-3 mt-3 mb-6">
    <div class="w-1/4 md:w-40 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="housenumber">
            ផ្ទះលេខ
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="housenumber" id="housenumber" type="text">
    </div>
    <div class="w-1/4 md:w-40 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="street">
            ផ្លូវ
        </label>
        <input
             class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="street" id="street" type="text">
    </div>
    <div class="flex-1 w-1/4 md:w-1/4 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="current_village">
            ភូមិ
        </label>
        <input
             class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white">
    </div>
    <div class="flex-1 w-1/4 md:w-1/4 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="current_commune">
            ឃុំ/សង្កាត់
        </label>
        <input
             class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="current_commune" id="current_commune" type="text" required>
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2 mt-5">
    <div class="w-1/2 md:w-1/3 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="current_district">
            ស្រុក/ខណ្ឌ
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white">
    </div>
    <div class="w-full md:w-1/4 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="current_provience">
            ខេត្ត/រាជធានី
        </label>
        <input
           class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            list="proviencelist" id="current_provience" type="text" required>
        <datalist id="proviencelist" name="proviencelist">
            @foreach($branches as $key => $val)
                <option data-id="{{$key}}" value="{{$val}}">
            @endforeach
        </datalist>
    </div>
</div>
<hr>
<div class="flex flex-wrap -mx-3 mb-2 mt-5">
    <div class="w-40 md:w-56 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="dateofbirth">
            ថ្ងៃទី ខែ ឆ្នាំកំណើត
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="dateofbirth" id="dateofbirth" type="date" required>
    </div>