<div class="w-26 md:w-28 px-3 mb-6 md:mb-0">
    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="t_shirt">
        ទំហំអាវ
    </label>
    <select name="t_shirt" id="shirt_size"
        class="w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        <option value="">---</option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        <option value="XXL">XXL</option>
    </select>
</div>
<div class="md:flex-1 w-1/2  px-3 mb-6 md:mb-0">
    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="language">
        ភាសាបរទេស
    </label>
    <input
        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 md:mb-8 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        name="language" id="language" type="text" >
</div>

<div class="md:flex-1 w-1/2  px-3 mb-6 md:mb-0">
    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="major">
        ជំនាញផ្ទាល់ខ្លួន
    </label>
    <input
        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        id="major" type="text" name="skill" >
</div>
</div>
<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="recruitment_date">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកក្របាទក្រហម
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="recruitment_date" id="recruitment_date" type="date" required>
    </div>
    <div class="md:flex-1 w-full  px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="branch_name">
            ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="branch_name" id="branch_name" type="text" list="branchname_list" required>

        <datalist name="branchname_list" id="branchname_list">
            @foreach ($branchhei as $key => $val)
                <option data-id={{ $key }} value="{{ $val }}">
            @endforeach
        </datalist>
    </div>
    <div class="md:flex-1 w-full px-3 mb-6 md:mb-0 " id="this_is_fucked_up">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="education_level">
            កម្រិតវរប្បធម៌ថ្នាក់ ឬឆ្នាំទី
        </label>
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
<div class="flex flex-wrap -mx-3 mb-2 ">
    <div class="md:flex-1 w-1/2  px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="training_received">
            វគ្គបណ្តុះបណ្តាល
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="training_received" type="text">
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="phone_number">
            លេខទូរសព្ទទំនាក់ទំនង
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="phone_number" id="phone_number" type="tel" required>
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="memberemail">
            អ៊ីម៉ែល
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="memberemail" id="memberemail" type="text" value="">
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="facebook">
            ហ្វេសប៊ុក
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="facebook" id="facebook" type="text">
    </div>
</div>
