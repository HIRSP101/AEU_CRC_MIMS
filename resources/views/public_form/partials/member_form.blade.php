<div class="p-4 bg-gray-100 font-battambang my-3">
    <div class="p-4 bg-white shadow-md rounded-lg space-y-6">
        {{-- HEADER --}}
        <div class="grid grid-cols-1 md:grid-cols-6">
            <div class="col-span-1 md:col-span-5 flex flex-col items-center justify-center sm:ml-[14vw]">
                <img class="hidden sm:block w-32 h-32 mb-2" src="{{ asset('images/Logo_of_Cambodian_Red_Cross.svg') }}"
                    alt="CRC Logo">
                <h1 class=" text-center text-lg font-semibold">
                    ព័ត៌មានផ្ទាល់ខ្លួន
                </h1>
                <h2 class=" text-center text-base">
                    Cambodian Red Cross Youth Individual Information
                </h2>
            </div>
            <div class="col-span-1 md:col-span-1 flex items-center justify-center">
                {{-- Optional profile pic --}}
            </div>
        </div>

        @csrf

        {{-- PERSONAL DETAIL --}}
        <hr>
        <section class="space-y-4">
            <h2 class="text-xl font-semibold">ព័ត៌មានផ្ទាល់ខ្លួន</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="name_kh" class="block uppercase text-gray-700 mb-1">ឈ្មោះ (ខ្មែរ)</label>
                    <input id="name_kh" name="name_kh" type="text" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="name_en" class="block uppercase text-gray-700 mb-1">អក្សរឡាតាំង</label>
                    <input id="name_en" name="name_en" type="text" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="gender" class="block uppercase text-gray-700 mb-1">ភេទ</label>
                    <select id="gender" name="gender"
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                        <option value="">---</option>
                        <option>ប្រុស</option>
                        <option>ស្រី</option>
                    </select>
                </div>
                <div>
                    <label for="nationality" class="block uppercase text-gray-700 mb-1">សញ្ជាតិ</label>
                    <input id="nationality" name="nationality" type="text" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div class="md:col-span-1">
                    <label for="image" class="block uppercase text-gray-700 mb-1">រូបភាព</label>
                    <input id="image" name="image" type="file" accept="image/*"
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
            </div>
        </section>

        <hr>

        {{-- PLACE OF BIRTH --}}
        <section class="space-y-4">
            <h2 class="text-xl font-semibold">ទីកន្លែងកំណើត</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="village" class="block uppercase text-gray-700 mb-1">ភូមិ</label>
                    <input id="village" name="village" type="text" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="commune" class="block uppercase text-gray-700 mb-1">ឃុំ/សង្កាត់</label>
                    <input id="commune" name="commune" type="text" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="district" class="block uppercase text-gray-700 mb-1">ស្រុក/ខណ្ឌ</label>
                    <input id="district" name="district" type="text" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="province" class="block uppercase text-gray-700 mb-1">ខេត្ត/រាជធានី</label>
                    <input id="province" name="province" list="proviencelist" type="text" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                    <datalist id="proviencelist">
                        @foreach ($branches as $key => $val)
                            <option data-id="{{ $key }}" value="{{ $val }}">
                        @endforeach
                    </datalist>
                </div>
            </div>
        </section>

        <hr>

        {{-- CURRENT ADDRESS --}}
        <section class="space-y-4">
            <h2 class="text-xl font-semibold">អាសយដ្ឋានបច្ចុប្បន្ន</h2>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label for="housenumber" class="block uppercase text-gray-700 mb-1">ផ្ទះលេខ</label>
                    <input id="housenumber" name="housenumber" type="text"
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="street" class="block uppercase text-gray-700 mb-1">ផ្លូវ</label>
                    <input id="street" name="street" type="text"
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="current_village" class="block uppercase text-gray-700 mb-1">ភូមិ</label>
                    <input id="current_village" name="current_village" type="text"
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="current_commune" class="block uppercase text-gray-700 mb-1">ឃុំ/សង្កាត់</label>
                    <input id="current_commune" name="current_commune" type="text"
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="current_district" class="block uppercase text-gray-700 mb-1">ស្រុក/ខណ្ឌ</label>
                    <input id="current_district" name="current_district" type="text"
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="current_provience" class="block uppercase text-gray-700 mb-1">ខេត្ត/រាជធានី</label>
                    <input id="current_provience" name="current_provience" list="proviencelist2" type="text"
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                    <datalist id="proviencelist2">
                        @foreach ($branches as $key => $val)
                            <option data-id="{{ $key }}" value="{{ $val }}">
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                <div>
                    <label for="dateofbirth" class="block uppercase text-gray-700 mb-1">ថ្ងៃកំណើត</label>
                    <input id="dateofbirth" name="dateofbirth" type="date" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
            </div>
        </section>

        <hr>

        {{-- PERSONAL TRAINING --}}
        <section class="space-y-4">
            <h2 class="text-xl font-semibold">វគ្គបណ្តុះបណ្តាល</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="t_shirt" class="block uppercase text-gray-700 mb-1">ទំហំអាវ</label>
                    <select id="t_shirt" name="t_shirt"
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                        <option value="">---</option>
                        <option>S</option>
                        <option>M</option>
                        <option>L</option>
                        <option>XL</option>
                        <option>XXL</option>
                    </select>
                </div>
                <div>
                    <label for="language" class="block uppercase text-gray-700 mb-1">ភាសាបរទេស</label>
                    <input id="language" name="language" type="text"
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="major" class="block uppercase text-gray-700 mb-1">ជំនាញផ្ទាល់ខ្លួន</label>
                    <input id="major" name="major" type="text"
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label for="recruitment_date" class="block uppercase text-gray-700 mb-1">ថ្ងៃ ខែ ឆ្នាំ
                        ចូលជាយុវជនកក្របាទក្រហម</label>
                    <input id="recruitment_date" name="recruitment_date" type="date" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="branch_name" class="block uppercase text-gray-700 mb-1">សាលា/សាកលវិទ្យាល័យ</label>
                    <input id="branch_name" name="branch_name" list="branchname_list" type="text" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                    <datalist id="branchname_list">
                        @foreach ($branchhei as $k => $v)
                            <option data-id="{{ $k }}" value="{{ $v }}">
                        @endforeach
                    </datalist>
                </div>
                <div class="md:flex-1 w-full mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="training_received">
                        វគ្គបណ្តុះបណ្តាល
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="training_received" type="text">
                </div>
                <div class="w-full md:w-full mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="phone_number">
                        លេខទូរសព្ទទំនាក់ទំនង
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="phone_number" id="phone_number" type="tel" required>
                </div>
                <div class="w-full md:w-full mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="memberemail">
                        អ៊ីម៉ែល
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="memberemail" id="memberemail" type="text" value="">
                </div>
                <div class="w-full md:w-full mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide mb-2" for="facebook">
                        ហ្វេសប៊ុក
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="facebook" id="facebook" type="text">
                </div>
                <div>
                    <label for="education_level" class="block uppercase text-gray-700 mb-1">កម្រិតវរប្បធម៌ថ្នាក់
                        ឬឆ្នាំទី</label>
                    <select
                        class="w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="education_level" id="education_level" required>
                        <option value="" selected>-----</option>
                        <option value="6">៦</option>
                        <option value="7">៧</option>
                        <option value="8">៨</option>
                        <option value="9">៩</option>
                        <option value="10">១០</option>
                        <option value="11">១១</option>
                        <option value="12">១២</option>
                        <option value="Year1">ឆ្នាំទី១</option>
                        <option value="Year2">ឆ្នាំទី២</option>
                        <option value="Year3">ឆ្នាំទី៣</option>
                        <option value="Year4">ឆ្នាំទី៤</option>
                    </select>
                </div>
            </div>
        </section>

        <hr>

        @include('member.components.partials.guardian')

        {{-- FORM ACTIONS --}}
        <div class="flex justify-end gap-3">
            <a id="clear_btn" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">លុប</a>
            <button id="submit_btn" type="submit"
                class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">យល់ព្រម</button>
        </div>
    </div>
</div>
