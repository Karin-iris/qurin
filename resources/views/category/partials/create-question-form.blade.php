<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('questions.question_draft') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("questions.question_draft_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('questiondraft.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('questions.topic')"/>
            <x-text-input id="name" name="topic" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="name" :value="old('topic')" />
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.text')"/>
            <x-textarea cols="30" rows="4" id="aaa" name="explanation" class="mt-1 block w-full" required autofocus
                        autocomplete="name">{{old('explanation')}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.correct_choice')"/>
            <x-text-input id="name" name="correct_choice" type="text" class="mt-1 block w-full" required autofocus
                          autocomplete="name" :value="old('correct_choice')" />
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.wrong_choice',['num'=>1])"/>
            <x-text-input id="name" name="wrong_choice_1" type="text" class="mt-1 block w-full" required autofocus
                          autocomplete="name" :value="old('wrong_choice_1')"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.wrong_choice',['num'=>2])"/>
            <x-text-input id="name" name="wrong_choice_2" type="text" class="mt-1 block w-full" required autofocus
                          autocomplete="name" :value="old('wrong_choice_2')"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.wrong_choice',['num'=>3])"/>
            <x-text-input id="name" name="wrong_choice_3" type="text" class="mt-1 block w-full" required autofocus
                          autocomplete="name" :value="old('wrong_choice_3')"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.explanation')"/>
            <x-textarea cols="30" rows="4" id="aaa" name="explanation" class="mt-1 block w-full" required autofocus
                        autocomplete="name">{{old('explanation')}}</x-textarea>
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
