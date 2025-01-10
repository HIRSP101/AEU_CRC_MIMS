<div class="flex flex-wrap  mb-6">
    <div class="flex-1 w-full md:w-1/4 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="name_kh">
            <h1>
                ឈ្មោះ
            </h1>
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            name="name_kh" id="name_kh" type="text" placeholder="ឈ្មោះជាភាសាខ្មែរ" required>
    </div>
    <div class="flex-1 w-full md:w-1/4 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="name_en">
            <h1>
                អក្សរឡាតាំង
            </h1>
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="name_en" id="name_en" type="text" placeholder="ឈ្មោះជាភាសាអង់គ្លេស" required>
    </div>
    <div class="w-1/3 md:w-28 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="gender">
            ភេទ
        </label>
        <select name="gender" id="gender"
            class="w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 ">
            <option value="">---</option>
            <option value="ប្រុស">ប្រុស</option>
            <option value="ស្រី">ស្រី</option>
        </select>
    </div>
    <div class="w-1/3 md:w-28 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="type">
            ប្រភេទសមាជិក
        </label>
        <select name="type" id="type"
            class="w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 ">
            <option value="">---</option>
            <option value="ទីប្រឹក្សា">ទីប្រឹក្សា</option>
            <option value="ប្រធានក្លឹប">ប្រធានក្លឹប</option>
            <option value="អនុប្រធានក្លឹប">អនុប្រធានក្លឹប</option>
            <option value="ប្រធាន​/អនុផ្នែក">ប្រធាន​/អនុផ្នែក</option>
            <option value="ប្រធាន​/អនុប្រធានក្រុម">ប្រធាន​/អនុប្រធានក្រុម</option>
            <option value="សមាជិក">សមាជិក</option>
        </select>
    </div>
    <div class="w-1/2 md:w-32 px-3">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="nationality">
            សញ្ជាតិ
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="nationality" id="nationality" type="text" required>
    </div>
    <div class="w-1/2 md:w-44 ">
        <label class="block uppercase tracking-wide text-gray-700  mb-2" for="image">
            រូបភាព
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="image" type="file" select="image/*" id="image">
    </div>
</div>