<div class="p-4 bg-gray-100 font-battambang my-3">
    <div class="p-4 bg-white shadow-md rounded-lg space-y-6">
        {{-- HEADER --}}
        <div class="grid grid-cols-1 md:grid-cols-6">
            <div class="col-span-1 md:col-span-5 flex flex-col items-center justify-center sm:ml-[14vw]">
                <img class="w-32 h-32  " src="{{ asset('images/Logo_of_Cambodian_Red_Cross.svg') }}"
                    alt="CRC Logo">
                <h1 class=" text-center text-lg font-semibold mt-5">
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
        <div id="section1">
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
                    <div class="md:col-span-1 mb-6">
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
                {{-- FORM ACTIONS --}}
                <div class="flex justify-end gap-3">
                    <button id="personal_btn" type="personal_btn"
                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">បន្ទាប់</button>
                </div>
            </section>

        </div>
        {{-- PERSONAL TRAINING --}}
        <section class="space-y-4 hidden" id="section2">
            <h2 class="text-xl font-semibold">វគ្គបណ្តុះបណ្តាល</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="t_shirt" class="block uppercase text-gray-700 mb-1">ទំហំអាវ</label>
                    <select id="shirt_size" name="t_shirt"
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
                    <label for="scout_youth_registration_date" class="block uppercase text-gray-700 mb-1"> ថ្ងៃ ខែ ឆ្នាំ
                        ចូលជាយុវជនកាយរឹទ្ធិកម្ពុជា</label>
                    <input id="scout_youth_registration_date" name="scout_youth_registration_date" type="date" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="uyfc_registration_date" class="block uppercase text-gray-700 mb-1">ថ្ងៃ ខែ ឆ្នាំ ចូលជា
                        ស.ស.យ.ក</label>
                    <input id="uyfc_registration_date" name="uyfc_registration_date" type="date" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="other_ngos_registration_date" class="block uppercase text-gray-700 mb-1">ថ្ងៃ ខែ ឆ្នាំ
                        ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងផ្សេងៗ</label>
                    <input id="other_ngos_registration_date" name="other_ngos_registration_date" type="date" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                </div>
                <div>
                    <label for="branch_name" class="block uppercase text-gray-700 mb-1">សាលា/សាកលវិទ្យាល័យ</label>
                    <input id="branch_name" name="branch_name" list="branchname_list" type="text" required
                        class="block w-full px-4 py-2 bg-gray-50 border rounded focus:bg-white">
                    <datalist id="branchname_list">
                        @foreach ($institutions as $k => $v)
                            <option data-id="{{ $k }}" value="{{ $v }}">
                        @endforeach
                    </datalist>
                </div>
                <div class="md:flex-1 w-full md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="training_received">
                        វគ្គបណ្តុះបណ្តាលដែលទទួលបាន
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-50 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="training_received" type="text">
                </div>
                <div class="w-full md:w-full md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="member_status">
                        ពិការភាព
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        name="member_status" id="member_status" type="text">

                </div>
                <div class="w-full md:w-full md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="misc_skill">
                        ជំនាញផ្សេងៗ
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        name="misc_skill" id="misc_skill" type="text">
                </div>
                <div class="w-full md:w-full md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="member_type">
                        ប្រភេទសាមាជិក
                    </label>
                    <select name="member_type" id="member_type"
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white">
                        <option value="">-------------------</option>
                        <option value="សមាជិកា យុវជន">សមាជិកា យុវជន</option>
                        <option value="សមាជិក យុវជន">សមាជិក យុវជន</option>
                    </select>
                </div>
                <div class="w-full md:w-full md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="phone_number">
                        លេខទូរសព្ទទំនាក់ទំនង
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-50 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="phone_number" id="phone_number" type="tel" required>
                </div>
                <div class="w-full md:w-full md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="memberemail">
                        អ៊ីម៉ែល
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-50 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="memberemail" id="memberemail" type="text" value="">
                </div>
                <div class="w-full md:w-full md:mb-0">
                    <label class="block uppercase tracking-wide  " for="facebook">
                        ហ្វេសប៊ុក
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-50 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="facebook" id="facebook" type="text">
                </div>
                <div>
                    <label for="education_level" class="block uppercase text-gray-700 mb-1">កម្រិតវរប្បធម៌ថ្នាក់
                        ឬឆ្នាំទី</label>
                    <select
                        class="w-full bg-gray-50 text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="education_level" id="education_level" required>
                        <option value="" selected>-----</option>
                        <option value="ថ្នាក់ទី6">ថ្នាក់ទី៦</option>
                        <option value="ថ្នាក់ទី7">ថ្នាក់ទី៧</option>
                        <option value="ថ្នាក់ទី8">ថ្នាក់ទី៨</option>
                        <option value="ថ្នាក់ទី9">ថ្នាក់ទី៩</option>
                        <option value="ថ្នាក់ទី10">ថ្នាក់ទី១០</option>
                        <option value="ថ្នាក់ទី11">ថ្នាក់ទី១១</option>
                        <option value="ថ្នាក់ទី12">ថ្នាក់ទី១២</option>
                        <option value="ឆ្នាំទី1">ឆ្នាំទី១</option>
                        <option value="ឆ្នាំទី2">ឆ្នាំទី២</option>
                        <option value="ឆ្នាំទី3">ឆ្នាំទី៣</option>
                        <option value="ឆ្នាំទី4">ឆ្នាំទី៤</option>
                    </select>
                </div>
            </div>
            {{-- FORM ACTIONS --}}
            <div class="flex justify-end gap-3">
                   <button id="section2_back" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    ត្រលប់ក្រោយ
                </button>
                <button id="training_btn" type="training_btn"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">បន្ទាប់</button>
            </div>
        </section>

        <section class="space-y-4 hidden" id="section3">
            <h2 class="text-xl font-semibold">
                ព័ត៍មានគ្រួសារ
            </h2>
            <hr>
            <div class="flex flex-wrap -mx-3   mt-3 ">
                <div class="w-full md:w-1/3 px-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="father_name">
                        ឈ្មោះឪពុក
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        name="father_name" type="text" id="father_name" required>
                </div>
                <div class="w-full md:w-1/3 px-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="father_dob">
                        ថ្ងៃ ខែ ឆ្នាំកំណើត
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        id="father_dob" name="father_dob" type="date" required>
                </div>
                <div class="w-full md:w-1/3 px-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="father_occupation">
                        មុខរបរ
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        name="father_occupation" id="father_occupation" type="text" required>
                </div>
                <div class="w-full md:w-full px-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="father_current_address">
                        អាសយដ្ធាន
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        name="father_current_address" id="father_current_address" type="text" required>
                </div>
                <div class="w-full md:w-1/3 px-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="mother_name">
                        ឈ្មោះម្តាយ
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        name="mother_name" id="mother_name" type="text" required>
                </div>
                <div class="w-full md:w-1/3 px-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="mother_dob">
                        ថ្ងៃ ខែ ឆ្នាំកំណើត
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        name="mother_dob" type="date" id="mother_dob" required>
                </div>
                <div class="w-full md:w-1/3 px-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="mother_occupation">
                        មុខរបរ
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white">
                </div>
                <div class="w-full md:w-full px-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="mother_current_address">
                        អាសយដ្ធាន
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        name="mother_current_address" type="text" id="mother_current_address" required>
                </div>
                <div class="w-full md:w-full px-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700  " for="guardian_number">
                        លេខទូរសព្ទអាណាព្យាបាល
                    </label>
                    <input
                        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
                        name="guardian_number" id="guardian_number" type="tel" required>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button id="section3_back" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    ត្រលប់ក្រោយ
                </button>
                <button id="submit_btn" type="submit_btn"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">យល់ព្រម</button>
            </div>
        </section>
    </div>
</div>