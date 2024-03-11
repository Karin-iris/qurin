<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('questions.question_edit') }}
        </h2>


        @if (session('status') === 'updated')
            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                 role="alert">
                <span class="font-medium">問題の更新に成功しました。</span>
            </div>
        @endif

        @if (session('status') === 'error')
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                 role="alert">
                <span class="font-medium">問題の更新に失敗しました。</span>
            </div>
        @endif


        <p class="mt-1 text-sm text-gray-600">
            {{ __("questions.question_edit_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('export.update_a',['resultId'=>$resultId,'id'=>$answer->id]) }}"
          class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="quiz_id" :value="__('answers.id')"/>
            {{ $answer->id }}
        </div>

        <div>
            <x-input-label for="email" :value="__('questions.text')"/>
            {{ $answer->question_text }}
        </div>

        <div>
            <x-input-label for="email" :value="__('questions.qurin_id')"/>
            {{ $answer->qurin_id }}
        </div>

        <div>
            <x-input-label for="email" :value="__('questions.qurin_id')"/>
            {{ $answer->qurin_question_text }}
        </div>

        <div>
            <x-input-label for="email" :value="__('questions.qurin_id')"/>
            {{ $answer->qurin_correct_choice }}
        </div>
        <div>
            <x-input-label for="email" :value="__('questions.qurin_id')"/>
            {{ $answer->qurin_wrong_choice_1 }}
        </div>
        <div>
            <x-input-label for="email" :value="__('questions.qurin_id')"/>
            {{ $answer->qurin_wrong_choice_2 }}
        </div>
        <div>
            <x-input-label for="email" :value="__('questions.qurin_id')"/>
            {{ $answer->qurin_wrong_choice_3 }}
        </div>
        <div>
            <x-input-label for="topic" :value="__('questions.answer_text')"/>
            <x-textarea cols="30" rows="2" id="answer_text" name="answer_text" type="text"
                        class="mt-1 block w-full" required autofocus
                        autocomplete="answer_text">{{old('answer_text', $answer->answer_text)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('answer_text')"/>
        </div>

        <div>
            <x-input-label for="text" :value="__('questions.answer_num')"/>
            <x-text-input id="answer_num" name="answer_num" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="answer_num" :value="old('answer_num')"/>
            <x-input-error class="mt-2" :messages="$errors->get('answer_num')"/>
        </div>

        <input type="hidden" name="result_id" value="{{ $answer->result_id }}">
        <x-primary-button class="ml-3">
            {{ __('Save') }}
        </x-primary-button>
    </form>
</section>
