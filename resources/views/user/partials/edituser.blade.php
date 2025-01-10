<div id="edit_form" class="absolute origin-center left-0 right-0 top-4 overflow-scroll z-50 hidden">
    <div
        class=" max-w-2xl mx-4 sm:mx-auto md:mx-auto lg:mx-auto xl:mx-auto mt-16 bg-white shadow-xl rounded-lg text-gray-900 ">
        <h1 class="mt-2 text-4xl font-bold text-center">User Edit Form</h1>
        <ul class="py-1 mt-2 text-gray-700 flex items-center justify-around">
            <form method="POST" id="user_form_form" action="{{ route('register.store') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-[400px]"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label :value="__('Roles-Assignment')"/>
                    <div class="mt-2 flex items-center justify-around">
                        <input name="roles[]" type="checkbox" value="admin">
                        <label>Admin</label>
                        <input name="roles[]" type="checkbox" value="user">
                        <label>User</label>
                    </div>
                </div>
                <div class="mt-4">
                    <x-input-label :value="__('Permissions-Assignment')"/>
                    <div class="mt-2 flex items-center justify-around">
                        <input name="permissions[]" id="isreadable" type="checkbox" value="read data">
                        <label for="isreadable">Read </label>
                        <input name="permissions[]" id="iswritable" type="checkbox" value="edit data">
                        <label for="iswritable">Write </label>
                        <input name="permissions[]" id="isaccessible" type="checkbox" value="access data">
                        <label for="isaccessible">Access </label>
                    </div>
                </div>
                <div class="mt-4">
                    <x-input-label :value="__('Branch-Assignment')"/>
                    <select name="branch_id" id="branch_id" class="mt-2 h-auto rounded-lg w-full">
                        <option value="">-----</option>
                        @foreach($branches as $key=>$val)
                            <option value="{{$key}}"> {{$val}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <x-input-label :value="__('Profile Picture')"/>
                    <input class="appearance-none text-transparent"
                        name="image" type="file" select ="image/*" id="image" class="mt-2">
                    <div class="mt-1 w-[128px] h-[128px] border-solid border-red border-2">
                        <img  src="{{asset('images/users/admin.png')}}"/>
                    </div>
                </div>

        </ul>
        <div class="p-4 flex items-center justify-content-center border-t mx-8 mt-2">
            <button
               id="saveprofile" class="mx-auto rounded-full bg-green-700 hover:shadow-lg font-semibold text-white px-6 py-2">Save</button>
            <button
              id="cancel"  class="mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white px-6 py-2">Cancel</button>
        </div>
    </form>
    </div>
</div>
