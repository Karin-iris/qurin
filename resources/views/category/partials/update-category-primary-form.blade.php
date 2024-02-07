<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('categories.edit_p') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("categories.edit_p_explain") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('category.update_p',$p_category->p_id) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div>
            <x-input-label for="code" :value="__('categories.code')"/>
            <p class="mt-1 text-sm text-gray-600">
                {{ __("categories.p_code_rule") }}
            </p>
            <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="code" :value="old('code',$p_category->code)"/>
            <x-input-error class="mt-2" :messages="$errors->get('code')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('categories.name')"/>
            <p class="mt-1 text-sm text-gray-600">
                {{ __("categories.p_name_rule") }}
            </p>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="name" :value="old('name',$p_category->name)"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <input type="hidden" name="order" value="1">
        <input type="hidden" name="id" value="{{$p_category->p_id}}">

        @if (session('status') === 'updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >{{ __('Saved.') }}</p>
        @endif

        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ml-3" x-on:click="$dispatch('close')">
            {{ __('Save') }}
        </x-danger-button>
    </form>
</section>
