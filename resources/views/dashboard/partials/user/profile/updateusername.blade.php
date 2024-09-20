<div class="mb-1 py-2">
    <form method="post" id="userform" action="{{ route('profile.update') }}" @csrf @method('patch') <x-input-label
        for="name" :value="__('Name')" />
        @csrf
        @method('patch')
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
        :value="old('name', auth()->user()->name)" required autofocus autocomplete="name" />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />

    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
        :value="old('email', auth()->user()->email)" required autocomplete="username" />
    <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </form>
</div>
