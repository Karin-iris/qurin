<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('categories.create') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("categories.create_explain") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('category.store_s') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="code" :value="__('categories.parent_category')"/>
            <x-categories.select-primary-categories name="primary_id"
                                                    class="mt-1 block w-full" autofocus
                                                    autocomplete="primary_id"
                                                    :value="old('primary_id')" :options="$p_categories"/>
            <x-input-error class="mt-2" :messages="$errors->get('primary_id')"/>
        </div>

        <div>
            <x-input-label for="code" :value="__('categories.code')"/>
            <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="code" :value="old('code')"/>
            <x-input-error class="mt-2" :messages="$errors->get('code')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('categories.name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="name" :value="old('name')"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <input type="hidden" name="order" value="1">

        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-primary-button class="ml-3" x-on:click="$dispatch('close')">
            {{ __('Save') }}
        </x-primary-button>

        <x-danger-button class="ml-3">
            {{ __('Submit') }}
        </x-danger-button>
    </form>
</section>
