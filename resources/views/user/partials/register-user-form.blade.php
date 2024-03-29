<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('users.user_add') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("users.user_add_message") }}
        </p>
    </header>


    <form method="post" action="{{ route('user.store_register',['token'=>$token]) }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="name" :value="__('users.name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="name"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="email" :value="__('users.email')"/>
            {{ $email }}

            <input type="hidden" name="email" value="{{ $email }}">
        </div>

        <div>
            <x-input-label for="password" :value="__('users.password')"/>
            <x-text-input id="password" name="password" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="password"/>
            <x-input-error class="mt-2" :messages="$errors->get('password')"/>
        </div>

        <input type="hidden" name="mode" value="register">
        <x-danger-button class="ml-3" x-on:click="$dispatch('close')">
            {{ __('Save') }}
        </x-danger-button>

    </form>
</section>
