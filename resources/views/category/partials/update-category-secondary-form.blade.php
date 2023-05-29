<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('categories.create_s') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("categories.create_s_explain") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('category.update_s',$s_category->s_id) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="code" :value="__('categories.category_p')"/>

            <x-categories.select-primary-categories name="primary_id"
                                                    class="mt-1 block w-full" autofocus
                                                    autocomplete="primary_id"
                                                    :value="old('primary_id',$s_category->primary_id)" :options="$p_categories"/>
            <x-input-error class="mt-2" :messages="$errors->get('primary_id')"/>
        </div>

        <div>
            <x-input-label for="code" :value="__('categories.code')"/>
            <p class="mt-1 text-sm text-gray-600">
                {{ __("categories.s_code_rule") }}
            </p>
            <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="code" :value="old('code',$s_category->code)"/>
            <x-input-error class="mt-2" :messages="$errors->get('code')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('categories.name')"/>
            <p class="mt-1 text-sm text-gray-600">
                {{ __("categories.s_name_rule") }}
            </p>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="name" :value="old('name',$s_category->name)"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <input type="hidden" name="order" value="1">
        <input type="hidden" name="id" value="{{$s_category->s_id}}">

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
