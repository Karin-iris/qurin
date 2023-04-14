<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('questions.my_question_edit') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("questions.my_question_case_edit_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('userquestion.update_c',$user_question_case->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="name" :value="__('questions.topic')"/>
            <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="topic" :value="old('topic',$user_question_case->topic)" />
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="text" :value="__('questions.text')"/>
            <x-textarea cols="30" rows="4" id="text" name="text" class="mt-1 block w-full" required autofocus
                        autocomplete="text">{{old('text',$user_question_case->text)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('text')"/>
        </div>

        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="is_request" value="0">

        <x-primary-button class="ml-3" onClick="resetRequestValue();">
            {{ __('TemporarySave') }}
        </x-primary-button>

        <x-danger-button class="ml-3" onClick="changeRequestValue();return confirm('レビュー依頼送信後は編集できません。よろしいでしょうか。')">
            {{ __('SubmitReview') }}
        </x-danger-button>
    </form>
</section>
