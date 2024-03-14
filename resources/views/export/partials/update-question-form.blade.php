@section('page-vite')
    @vite(['resources/js/searchIdQuestionText.js'])
@endsection
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

    <form method="post" action="{{ route('export.update_q',['resultId'=>$resultId,'id'=>$question->id]) }}"
          class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="quiz_id" :value="__('questions.id')"/>
            {{ $question->id }}
        </div>

        <div id="search-id-text-app">
            <search-id-question-component></search-id-question-component>
        </div>

        <div>
            <x-input-label for="topic" :value="__('questions.text')"/>
            <x-textarea cols="30" rows="2" id="text" name="text" type="text"
                        class="mt-1 block w-full" required autofocus
                        autocomplete="text">{{old('text', $question->text)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('text')"/>
        </div>

        <div>
            <x-input-label for="text" :value="__('questions.question_id')"/>
            <x-text-input id="question_id" name="question_id" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="question_id" :value="old('question_id')"/>
            <x-input-error class="mt-2" :messages="$errors->get('question_id')"/>
        </div>


        <x-primary-button class="ml-3">
            {{ __('Save') }}
        </x-primary-button>
    </form>
</section>
