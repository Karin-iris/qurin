<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('questions.question_edit') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("questions.question_edit_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('question.update',$question->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="code" :value="__('categories.parent_category')"/>
            <x-categories.select-primary-categories name="primary_id"
                                                    class="mt-1 block w-full" autofocus
                                                    autocomplete="primary_id"
                                                    :value="old('primary_id')" :options="$p_categories"
            />
            <x-categories.select-secondary-categories name="secondary_id"
                                                      class="mt-1 block w-full" autofocus
                                                      autocomplete="secondary_id"
                                                      :value="old('secondary_id')" :options="$s_categories"
            />
            <x-categories.select-categories name="category_id"
                                            class="mt-1 block w-full" autofocus
                                            autocomplete="category_id"
                                            :value="old('category_id')" :options="$categories"
            />
            <x-input-error class="mt-2" :messages="$errors->get('primary_id')"/>
            <x-input-error class="mt-2" :messages="$errors->get('secondary_id')"/>
            <x-input-error class="mt-2" :messages="$errors->get('category_id')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.topic')"/>
            <x-text-input id="name" name="topic" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="name" :value="old('topic', $question->topic)" />
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.text')"/>
            <x-textarea cols="30" rows="4" id="aaa" name="explanation" class="mt-1 block w-full" required autofocus
                        autocomplete="name">{{old('explanation', $question->topic)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.correct_choice')"/>
            <x-text-input id="name" name="correct_choice" type="text" class="mt-1 block w-full" required autofocus
                          autocomplete="name" :value="old('correct_choice', $question->correct_choice)" />
            <x-input-error class="mt-2" :messages="$errors->get('correct_choice')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.wrong_choice',['num'=>1])"/>
            <x-text-input id="name" name="wrong_choice_1" type="text" class="mt-1 block w-full" required autofocus
                          autocomplete="name" :value="old('wrong_choice_2', $question->wrong_choice_1)"/>
            <x-input-error class="mt-2" :messages="$errors->get('wrong_choice_2')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.wrong_choice',['num'=>2])"/>
            <x-text-input id="name" name="wrong_choice_2" type="text" class="mt-1 block w-full" required autofocus
                          autocomplete="wrong_choice_2" :value="old('wrong_choice_2', $question->wrong_choice_2)"/>
            <x-input-error class="mt-2" :messages="$errors->get('wrong_choice_2')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.wrong_choice',['num'=>3])"/>
            <x-text-input id="name" name="wrong_choice_3" type="text" class="mt-1 block w-full" required autofocus
                          autocomplete="name" :value="old('wrong_choice_3', $question->wrong_choice_3)"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.explanation')"/>
            <x-textarea cols="30" rows="4" id="aaa" name="explanation" class="mt-1 block w-full" required autofocus
                        autocomplete="name">{{old('explanation', $question->explanation)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

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
