<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('users.user_add') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("users.user_add_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('admin.create') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="name" :value="__('admins.name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autofocus
                                    autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('admins.email')"/>
            <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
        </div>

        <div>
            <x-input-label for="code" :value="__('admins.code')"/>
            <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="code"/>
            <x-input-error class="mt-2" :messages="$errors->get('code')"/>
        </div>

        <div>
            <x-input-label for="password" :value="__('admins.password')"/>
            <x-text-input id="password" name="password" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="password" />
            <x-input-error class="mt-2" :messages="$errors->get('password')"/>
        </div>

        <input type="hidden" name="mode" value="create">
        <x-danger-button class="ml-3" x-on:click="$dispatch('close')">
            {{ __('Save') }}
        </x-danger-button>

    </form>
</section>
