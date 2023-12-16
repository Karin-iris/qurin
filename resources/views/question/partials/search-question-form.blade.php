<section>
    <form action="{{ route('question.index') }}" method="post">
        @csrf
        @method('post')
        <x-input-label for="name" :value="__('questions.search')"/>
        <div class="flex">
            <div class="mr-2">
            <x-input-label for="primary_id" :value="__('categories.category_p')"/>
            <x-categories.select-primary-categories name="primary_id"
                                                    class="mt-1 block w-full" autofocus
                                                    autocomplete="primary_id"
                                                    :value="old('primary_id')" :options="$p_categories"/>
            </div>
            <div class="mr-2">
            <x-input-label for="secondary_id" :value="__('categories.category_s')"/>
            <x-categories.select-secondary-categories name="secondary_id"
                                                      class="mt-1 block w-full" autofocus
                                                      autocomplete="secondary_id"
                                                      :value="old('secondary_id')" :options="$s_categories" />
            </div>
            <div class="mr-2">
            <x-input-label for="category_id" :value="__('categories.category')"/>
            <x-categories.select-categories name="category_id"
                                            class="mt-1 block w-full" autofocus
                                            autocomplete="category_id"
                                            :value="old('category_id')" :options="$categories" />
                <x-input-error class="mt-2" :messages="$errors->get('primary_id')" />
                <x-input-error class="mt-2" :messages="$errors->get('secondary_id')" />
                <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
            </div>


        </div>
        <div>
            <x-input-label for="competency" :value="__('questions.compitency')"/>
            <x-questions.select-compitencies name="competency"
                                             class="mt-1 block w-full" autofocus
                                             autocomplete="competency"
                                             :value="old('competency',$competency)" />
            <x-input-error class="mt-2" :messages="$errors->get('competency')" />
        </div>
        <x-text-input id="string" name="string" type="text" class="mt-1 block w-full" autofocus
                      autocomplete="search" :value="old('string',$string)"/>
        <input type="hidden" name="mode" value="search">
        <x-primary-button class="ml-3" x-on:click="$dispatch('close')">
            {{ __('Search') }}
        </x-primary-button>
    </form>
</section>
