<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('questions.my_question_case_add') }}
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
        <input type="hidden" name="is_request" value="0">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <x-primary-button class="ml-3" onClick="resetRequestValue();">
            {{ __('TemporarySave') }}
        </x-primary-button>

        <x-danger-button class="ml-3" onClick="changeRequestValue();return confirm('レビュー依頼送信後は編集できません。よろしいでしょうか。')">
            {{ __('SubmitReview') }}
        </x-danger-button>
    </form>
</section>
