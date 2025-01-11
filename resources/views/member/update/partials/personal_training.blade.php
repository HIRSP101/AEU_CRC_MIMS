<div class="w-26 md:w-28 px-3 mb-6 md:mb-0">
    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="t_shirt">
        ទំហំអាវ
    </label>
    <select name="t_shirt" id="shirt_size"
        class="w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

        @if ($member->shirt_size == null)
            <option value="">---</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
        @endif
        @if ($member->shirt_size != null)
            <option value="{{$member->shirt_size}}">{{$member->shirt_size}}
            <option value="">---</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
            </option>
        @endif
    </select>
</div>
<div class="md:flex-1 w-1/2  px-3 mb-6 md:mb-0">
    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="language">
        ភាសាបរទេស
    </label>
    <input
        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 md:mb-8 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        name="language" id="language" type="text" value="{{$member->member_education_background->language}}">
</div>
<div class="md:flex-1 w-1/2  px-3 mb-6 md:mb-0">
    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="major">
        ជំនាញផ្ទាល់ខ្លួន
    </label>
    <input
        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        id="major" type="text" value="{{$member->member_education_background->major}}">
</div>
</div>
<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="recruitment_date">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកក្របាទក្រហម
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="recruitment_date" id="recruitment_date" type="date" required
            value="{{$member->member_registration_detail->registration_date}}">
    </div>
    <div class="md:flex-1 w-full  px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="branch_name">
            ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="branch_name" id="branch_name" list="branchname_list" type="text" required
            value="{{$member->member_education_background->institute_id}}">
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
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 md:mb-8 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="education_level" id="education_level" type="text" required
            value="{{$member->member_education_background->acadmedic_year}}">
    </div>
</div>
<div class=" flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="computer_skill">
            ជំនាញកុំព្យូទ័រ
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="computer_skill" id="computer_skill" type="text" required
            value="{{$member->member_education_background->computer_skill}}">
    </div>
    <div class="md:flex-1 w-full  px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="training_received">
            វគ្គបណ្តុះបណ្តាលដែលទទួលបាន
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="training_received" id="training_received" type="text" required
            value="{{$member->member_education_background->training_received}}">
    </div>
    <div class="md:flex-1 w-full px-3 mb-6 md:mb-0 " id="this_is_fucked_up">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="misc_skill">
            ជំនាញផ្សេងៗ
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 md:mb-8 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="misc_skill" id="misc_skill" type="text" required
            value="{{$member->member_education_background->misc_skill}}">
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="member_type">
            ប្រភេទសាមាជិក
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="member_type" id="member_type" type="text" required value="{{$member->member_type}}">
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="member_status">
            ពិការភាព
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="member_status" id="member_status" type="text">
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2 ">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="phone_number">
            លេខទូរសព្ទទំនាក់ទំនង
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="phone_number" id="phone_number" type="tel" required value="{{$member->phone_number}}">
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="memberemail">
            អ៊ីម៉ែល
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="memberemail" id="memberemail" type="text" value="{{$member->email}}">
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="facebook">
            ហ្វេសប៊ុក
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 md:mb-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="facebook" id="facebook" type="text" value="{{$member->facebook}}">
    </div>
</div>