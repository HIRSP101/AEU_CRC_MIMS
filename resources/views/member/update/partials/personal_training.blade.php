<div class="w-26 md:w-28 px-3 mb-6 md:mb-0">
    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="t_shirt">
        ទំហំអាវ
    </label>
    <select name="t_shirt" id="shirt_size"
        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white">

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
        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
        name="language" id="language" type="text" value="{{$member->language}}">
</div>
<div class="md:flex-1 w-1/2  px-3 mb-6 md:mb-0">
    <label class="block uppercase tracking-wide text-gray-700 mb-2" for="major">
        ជំនាញផ្ទាល់ខ្លួន
    </label>
    <input
        class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
        id="major" type="text" value="{{$member->major}}">
</div>
</div>
<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="recruitment_date">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកក្របាទក្រហម
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="recruitment_date" id="recruitment_date" type="date" required value="{{$member->registration_date}}">
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="scout_youth_registration_date">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាយរឹទ្ធិកម្ពុជា
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="scout_youth_registration_date" id="scout_youth_registration_date" type="date"
            value="{{$member->scout_youth_registration_date}}">
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="uyfc_registration_date ">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជា ស.ស.យ.ក
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="uyfc_registration_date" id="uyfc_registration_date" type="date"
            value="{{$member->uyfc_registration_date}}">
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="other_ngos_registration_date">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងផ្សេងៗ
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="other_ngos_registration_date" id="other_ngos_registration_date" type="date"
            value="{{$member->other_ngos_registration_date}}">
    </div>
    <div class="md:flex-1 w-full  px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="branch_name">
            ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="branch_name" id="branch_name" list="branchname_list" type="text" required
            value="{{$member->school_name ?? $member->institute_kh}}">
        <datalist name="branchname_list" id="branchname_list">
            @foreach ($institutions as $key => $val)
                <option data-id={{ $key }} value="{{ $val }}">
            @endforeach
        </datalist>
    </div>
    <div class="md:flex-1 w-full px-3 mb-6 md:mb-0 " id="this_is_fucked_up">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="education_level">
            កម្រិតវរប្បធម៌ថ្នាក់ ឬឆ្នាំទី
        </label>
        <select
            class="w-full bg-gray-50 text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="education_level" id="education_level" required>
            @if ($member->education_level == null)
                    <option value="">-----</option>
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
            @elseif($member->education_level != null)
            <option value="{{$member->education_level}}">{{$member->education_level}}</option>
            <option value="">-----</option>
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
        @endif
    </div>
</div>
<div class=" flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="computer_skill">
            ជំនាញកុំព្យូទ័រ
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="computer_skill" id="computer_skill" type="text" required value="{{$member->computer_skill}}">
    </div>
    <div class="md:flex-1 w-full  px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="training_received">
            វគ្គបណ្តុះបណ្តាលដែលទទួលបាន
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="training_received" id="training_received" type="text" required value="{{$member->training_received}}">
    </div>
    <div class="md:flex-1 w-full px-3 mb-6 md:mb-0 " id="this_is_fucked_up">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="misc_skill">
            ជំនាញផ្សេងៗ
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="misc_skill" id="misc_skill" type="text" required value="{{$member->misc_skill}}">
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="member_type">
            ប្រភេទសាមាជិក
        </label>
        <select name="member_type" id="member_type"
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white">
            @if ($member->member_type == null)
                <option value="">-------------------</option>
                <option value="សមាជិកា យុវជន">សមាជិកា យុវជន</option>
                <option value="សមាជិក យុវជន">សមាជិក យុវជន</option>
                <option value="ទីប្រឹក្សា">ទីប្រឹក្សា</option>
                <option value="ប្រធានក្លឹប">ប្រធានក្លឹប</option>
                <option value="អនុ​ប្រធានក្លឹប">អនុ​ប្រធានក្លឹប</option>
                <option value="ប្រធានផ្នែក">ប្រធានផ្នែក</option>
                <option value="ប្រធានក្រុម">ប្រធានក្រុម</option>
            @elseif($member->member_type != null)
                <option value="{{$member->member_type}}">{{$member->member_type}}</option>
                <option value="">-------------------</option>
                <option value="សមាជិកា យុវជន">សមាជិកា យុវជន</option>
                <option value="សមាជិក យុវជន">សមាជិក យុវជន</option>
                <option value="ទីប្រឹក្សា">ទីប្រឹក្សា</option>
                <option value="ប្រធានក្លឹប">ប្រធានក្លឹប</option>
                <option value="អនុ​ប្រធានក្លឹប">អនុ​ប្រធានក្លឹប</option>
                <option value="ប្រធានផ្នែក">ប្រធានផ្នែក</option>
                <option value="ប្រធានក្រុម">ប្រធានក្រុម</option>
            @endif

        </select>
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="member_status">
            ពិការភាព
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="member_status" id="member_status" type="text" value="{{$member->member_status}}">
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2 ">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="phone_number">
            លេខទូរសព្ទទំនាក់ទំនង
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="phone_number" id="phone_number" type="tel" required value="{{$member->phone_number}}">
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="memberemail">
            អ៊ីម៉ែល
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="memberemail" id="memberemail" type="text" value="{{$member->email}}">
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="facebook">
            ហ្វេសប៊ុក
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded mb-3 py-3 px-4leading-tight focus:outline-none focus:bg-white"
            name="facebook" id="facebook" type="text" value="{{$member->facebook}}">
    </div>
</div>