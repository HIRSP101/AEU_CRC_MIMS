<div class="flex flex-wrap gap-4 mb-6 font-battambang">
    <!-- Khmer Name -->
    <div class="w-full md:w-1/4">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="name_kh">
            <h1 class="text-base">ឈ្មោះ</h1>
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
            name="name_kh" id="name_kh" type="text" placeholder="ឈ្មោះជាភាសាខ្មែរ" required>
    </div>

    <!-- English Name -->
    <div class="w-full md:w-1/4">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="name_en">
            <h1 class="text-base">អក្សរឡាតាំង</h1>
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
            name="name_en" id="name_en" type="text" placeholder="ឈ្មោះជាភាសាអង់គ្លេស" required>
    </div>

    <!-- Gender -->
    <div class="w-full md:w-1/4">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="gender">
            ភេទ
        </label>
        <select
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
            name="gender" id="gender">
            <option value="">---</option>
            <option value="ប្រុស">ប្រុស</option>
            <option value="ស្រី">ស្រី</option>
        </select>
    </div>

    <!-- Nationality -->
    <div class="w-full md:w-1/4">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="nationality">
            សញ្ជាតិ
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
            name="nationality" id="nationality" type="text" required>
    </div>

    <!-- Image Upload -->
    <div class="w-full md:w-1/6">
        <label class="block uppercase tracking-wide text-gray-700 mb-2" for="image">
            រូបភាព
        </label>
        <input
            class="appearance-none block w-full text-sm bg-gray-50 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
            name="image" type="file" accept="image/*" id="image">
    </div>
</div>
