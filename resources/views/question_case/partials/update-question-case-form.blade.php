<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('questions.question_case_edit') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("questions.question_case_edit_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('question.update_c',$question_case->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="name" :value="__('questions.topic')"/>
            <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="topic" :value="old('topic',$question_case->topic)"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="text" :value="__('questions.text')"/>
            <x-textarea cols="30" rows="4" id="text" name="text" class="mt-1 block w-full" required autofocus
                        autocomplete="text">{{old('text',$question_case->text)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('text')"/>
        </div>

        <div>
            <x-input-label for="case_text" :value="__('questions.case_text')"/>
            <x-textarea cols="30" rows="4" id="case_text" name="case_text" class="mt-1 block w-full" required autofocus
                        autocomplete="case_text">{{old('text',$question_case->case_text)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('case_text')"/>
        </div>

        <input type="hidden" name="is_request" value="0">
        <input type="hidden" name="is_approve" value="0">

        <x-primary-button class="ml-3">
            {{ __('TemporarySave') }}
        </x-primary-button>

        <x-primary-button class="ml-3" onClick="resetApproveValue();">
            {{ __('SaveAndRemand') }}
        </x-primary-button>

        <x-danger-button class="ml-3" onClick="changeApproveValue();">
            {{ __('Approve') }}
        </x-danger-button>
    </form>
</section>
