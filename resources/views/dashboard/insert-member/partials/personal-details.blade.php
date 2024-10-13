<div class="flex flex-wrap -mx-3 mb-6">
    <div class="flex-1 w-full md:w-1/4 px-3 mb-6 md:mb-0">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700  mb-2" for="name_kh">
            <h1 class ="font-battambang">
                ឈ្មោះ
            </h1 class ="font-battambang">
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            name="name_kh" id="name_kh" type="text" placeholder="" required>
    </div>
    <div class="flex-1 w-full md:w-1/4 px-3">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700  mb-2" for="name_en">
            <h1 class ="font-battambang" class="font-siemreap">
                អក្សរឡាតាំង
            </h1 class ="font-battambang">
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="name_en" id="name_kh" type="text" placeholder="" required>
    </div>
    <div class="w-1/3 md:w-28 px-3">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700  mb-2" for="gender">
            ភេទ
        </label>
        <select name="gender" id="gender" 
            class="w-full bg-gray-200 font-battambang text-sm text-gray-700 border border-red-300 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 ">
            <option value="">ភេទ</option>
            <option value="ប្រុស">ប្រុស</option>
            <option value="ស្រី">ស្រី</option>
        </select>
    </div>
    <div class="w-1/2 md:w-32 px-3">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700  mb-2" for="nationality">
            សញ្ជាតិ
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="nationality" id="nationality" type="text" required>
    </div>
    <div class="w-1/2 md:w-44 px-3">
        
        <label class=" font-battambang block uppercase tracking-wide text-gray-700  mb-2" for="image">
            រូបភាព
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-2 px-1.5 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="image" type="file" id="image">
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2 mt-5">
    <div class="w-40 md:w-56 px-3">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700  mb-2" for="date_of_birth">
            ថ្ងៃទី ខែ ឆ្នាំកំណើត
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="date_of_birth" id="dateofbirth" type="date" required>
    </div>
    <div class=" w-26 md:w-28 px-3 mb-6 md:mb-0">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700 mb-2" for="shirt_size">
            ទំហំអាវ
        </label>
        <select name="shirt_size"
            class="w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
        </select>
    </div>
    <div class="md:flex-1 w-1/2  px-3 mb-6 md:mb-0">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700 mb-2" for="language">
            ភាសាបរទេស
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 md:mb-8 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="language" type="text">
    </div>

    <div class="md:flex-1 w-1/2  px-3 mb-6 md:mb-0">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700 mb-2" for="major">
            ជំនាញផ្ទាល់ខ្លួន
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="major" type="text">
    </div>
    <div class="md:flex-1 w-1/2  px-3 mb-6 md:mb-0">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700 mb-2" for="position">
            មុខតំណែង
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="position" type="text">
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700 mb-2" for="recruitment_date">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកក្របាទក្រហម
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="recruitment_date" id="recruitment_date" type="date" required>
    </div>
    <div class="md:w-1/3 w-full  px-3 mb-6 md:mb-0">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700 mb-2" for="name">
            ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="name" id="name" type="text" required>
    </div>
    <div class="md:flex-1 w-full px-3 mb-6 md:mb-0 " id="this_is_fucked_up">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700 mb-2" for="education_level">
            កម្រិតវរប្បធម៌
        </label>
        <select name="education_level"
            class="w-full bg-gray-200 font-battambang text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="មធ្យមសិក្សា">មធ្យមសិក្សា</option>
            <option value="ឧត្តមសិក្សា">ឧត្តមសិក្សា</option>
        </select>
    </div>
    <div class="md:flex-1 w-full px-3 mb-6 md:mb-0 " id="this_is_fucked_up">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700 mb-2" for="acadmedic_year">
            ឆ្នាំទី ឬថ្នាក់
        </label>
        <select name="acadmedic_year"
            class="w-full bg-gray-200 text-gray-700 border border-red-300 text-sm rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="1">1</option>
            <option value="2">2</option>

        </select>
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2 ">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700 mb-2" for="phone_number">
            លេខទូរសព្ទទំនាក់ទំនង
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="phone_number" id="phone_number" type="tel" required>
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700 mb-2" for="email">
            អ៊ីម៉ែល
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="email" type="text">
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class=" font-battambang block uppercase tracking-wide text-gray-700 mb-2" for="facebook">
            ហ្វេសប៊ុក
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="facebook" type="text">
    </div>
</div>