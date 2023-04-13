<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('questions.my_question_case_edit') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("questions.my_question_case_add_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('userquestion.store_c') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

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
