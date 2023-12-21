@section('page-vite')
    @vite(['resources/js/category.js'])
@endsection

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('questions.question_add') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("questions.question_add_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('question_case.create_q', ['case_id'=> 1]) }} " class="mt-6 space-y-6">
        @csrf
        @method('post')
        <div>
            <x-input-label for="code" :value="__('question_cases.case_text')"/>

        </div>
        <div id="category-app">
            <x-input-label for="topic" :value="__('questions.category')"/>
            <category-component></category-component>
        </div>

        <div>
            <x-input-label for="topic" :value="__('questions.topic')"/>
            <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="topic" :value="old('topic')" />
            <x-input-error class="mt-2" :messages="$errors->get('topic')"/>
        </div>

        <div>
            <x-input-label for="text" :value="__('questions.text')"/>
            <x-textarea cols="30" rows="4" id="text" name="text" class="mt-1 block w-full" required autofocus
                        autocomplete="name">{{old('text')}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('text')"/>
        </div>

        <div>
            <x-input-label for="correct_choice" :value="__('questions.correct_choice')"/>
            <x-textarea cols="30" rows="2" id="correct_choice" name="correct_choice" type="text" class="mt-1 block w-full" required autofocus
                        autocomplete="correct_choice">{{old('correct_choice')}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('correct_choice')"/>
        </div>

        <div>
            <x-input-label for="wrong_choice_1" :value="__('questions.wrong_choice',['num'=>1])"/>
            <x-textarea cols="30" rows="2" id="wrong_choice_1" name="wrong_choice_1" type="text" class="mt-1 block w-full" required autofocus
                        autocomplete="wrong_choice_1">{{old('wrong_choice_1')}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('wrong_choice_1')"/>
        </div>

        <div>
            <x-input-label for="wrong_choice_2" :value="__('questions.wrong_choice',['num'=>2])"/>
            <x-textarea cols="30" rows="2" id="wrong_choice_2" name="wrong_choice_2" type="text" class="mt-1 block w-full" required autofocus
                        autocomplete="wrong_choice_2">{{old('wrong_choice_2')}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('wrong_choice_2')"/>
        </div>

        <div>
            <x-input-label for="wrong_choice_3" :value="__('questions.wrong_choice',['num'=>3])"/>
            <x-textarea cols="30" rows="2" id="wrong_choice_3" name="wrong_choice_3" type="text" class="mt-1 block w-full" required autofocus
                        autocomplete="wrong_choice_3">{{old('wrong_choice_3')}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('wrong_choice_3')"/>
        </div>


        <div>
            <x-input-label for="explanation" :value="__('questions.explanation')"/>
            <x-textarea cols="30" rows="4" id="explanation" name="explanation" class="mt-1 block w-full" required autofocus
                        autocomplete="name">{{old('explanation')}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('explanation')"/>
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
