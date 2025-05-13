<div class="w-26 md:w-28 px-3 mb-6 md:mb-0">
    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="t_shirt">
        ទំហំអាវ
    </label>
    <select name="t_shirt" id="t_shirt"
        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
        <option value="">---</option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        <option value="XXL">XXL</option>
    </select>
</div>

<div class="md:flex-1 w-full px-3 mb-6 md:mb-0">
    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="language">
        ភាសាបរទេស
    </label>
    <input name="language" id="language" type="text"
        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
</div>

<div class="md:flex-1 w-full px-3 mb-6 md:mb-0">
    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="major">
        ជំនាញផ្ទាល់ខ្លួន
    </label>
    <input name="major" id="major" type="text"
        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
</div>

<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="recruitment_date">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកក្របាទក្រហម
        </label>
        <input name="recruitment_date" id="recruitment_date" type="date" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>

    <div class="md:flex-1 w-full px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="branch_name">
            ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ
        </label>
        <input name="branch_name" id="branch_name" list="branchname_list" type="text" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
        <datalist name="branchname_list" id="branchname_list">
            @foreach ($branchhei as $key => $val)
                <option data-id="{{ $key }}" value="{{ $val }}">
            @endforeach
        </datalist>
    </div>

    <div class="md:flex-1 w-full px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="education_level">
            កម្រិតវប្បធម៌ថ្នាក់ ឬឆ្នាំទី
        </label>
        <input name="education_level" id="education_level" type="text" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>
</div>

<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="computer_skill">
            ជំនាញកុំព្យូទ័រ
        </label>
        <input name="computer_skill" id="computer_skill" type="text" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>

    <div class="md:flex-1 w-full px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="training_received">
            វគ្គបណ្តុះបណ្តាលដែលទទួលបាន
        </label>
        <input name="training_received" id="training_received" type="text" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>

    <div class="md:flex-1 w-full px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="misc_skill">
            ជំនាញផ្សេងៗ
        </label>
        <input name="misc_skill" id="misc_skill" type="text" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>
</div>

<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="member_type">
            ប្រភេទសមាជិក
        </label>
        <input name="member_type" id="member_type" type="text" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>

    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="member_status">
            ពិការភាព
        </label>
        <input name="member_status" id="member_status" type="text"
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>
</div>

<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="phone_number">
            លេខទូរស័ព្ទទំនាក់ទំនង
        </label>
        <input name="phone_number" id="phone_number" type="tel" required
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>

    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="memberemail">
            អ៊ីម៉ែល
        </label>
        <input name="memberemail" id="memberemail" type="email"
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>

    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="facebook">
            ហ្វេសប៊ុក
        </label>
        <input name="facebook" id="facebook" type="text"
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4 leading-tight focus:outline-none focus:bg-white">
    </div>
</div>
