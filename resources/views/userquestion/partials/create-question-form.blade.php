<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('questions.my_question_add') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("questions.my_question_add_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('userquestion.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="code" :value="__('categories.parent_category')"/>
            <x-categories.select-primary-categories name="primary_id"
                                                    class="mt-1 block w-full" autofocus
                                                    autocomplete="primary_id"
                                                    :value="old('primary_id')" :options="$p_categories"/>
            <x-categories.select-secondary-categories name="secondary_id"
                                                      class="mt-1 block w-full" autofocus
                                                      autocomplete="secondary_id"
                                                      :value="old('secondary_id')" :options="$s_categories"/>
            <x-categories.select-categories name="category_id"
                                            class="mt-1 block w-full" autofocus
                                            autocomplete="category_id"
                                            :value="old('category_id')" :options="$categories"/>
            <x-input-error class="mt-2" :messages="$errors->get('primary_id')" />
            <x-input-error class="mt-2" :messages="$errors->get('secondary_id')" />
            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.topic')"/>
            <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="name" :value="old('topic')" />
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="text" :value="__('questions.text')"/>
            <x-textarea cols="30" rows="4" id="text" name="text" class="mt-1 block w-full" required autofocus
                        autocomplete="name">{{old('explanation')}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="image" :value="__('questions.image')"/>
            <x-file-input name="image[new]" id="image_1"></x-file-input>
            <input type="hidden" name="image_id[new]" value=""></input-input>
            <x-input-error class="mt-2" :messages="$errors->get('image.0')"/>
        </div>

        <div>
            <x-input-label for="correct_choice" :value="__('questions.correct_choice')"/>
            <x-text-input id="correct_choice" name="correct_choice" type="text" class="mt-1 block w-full" required autofocus
                          autocomplete="correct_choice" :value="old('correct_choice')" />
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="wrong_choice_1" :value="__('questions.wrong_choice',['num'=>1])"/>
            <x-text-input id="wrong_choice_1" name="wrong_choice_1" type="text" class="mt-1 block w-full" required autofocus
                          autocomplete="wrong_choice_1" :value="old('wrong_choice_1')"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="wrong_choice_2" :value="__('questions.wrong_choice',['num'=>2])"/>
            <x-text-input id="wrong_choice_2" name="wrong_choice_2" type="text" class="mt-1 block w-full" required autofocus
                          autocomplete="name" :value="old('wrong_choice_2')"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="wrong_choice_3" :value="__('questions.wrong_choice',['num'=>3])"/>
            <x-text-input id="wrong_choice_3" name="wrong_choice_3" type="text" class="mt-1 block w-full" required autofocus
                          autocomplete="wrong_choice_3" :value="old('wrong_choice_3')"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="explanation" :value="__('questions.explanation')"/>
            <x-textarea cols="30" rows="4" id="explanation" name="explanation" class="mt-1 block w-full" required autofocus
                        autocomplete="explanation">{{old('explanation')}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-primary-button class="ml-3" x-on:click="$dispatch('close')">
            {{ __('Save') }}
        </x-primary-button>

        <x-danger-button class="ml-3">
            {{ __('SubmitReview') }}
        </x-danger-button>
    </form>
</section>
