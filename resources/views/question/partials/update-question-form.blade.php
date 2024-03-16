@section('page-vite')
    @vite(['resources/js/category.js',
'resources/js/searchIdQuestionText.js',
'resources/js/gptPromptText.js'
])
@endsection
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('questions.question_edit') }}
        </h2>


        @if (session('status') === 'updated')
            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                <span class="font-medium">問題の更新に成功しました。</span>
            </div>
        @endif

        @if (session('status') === 'error')
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
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

    <form method="post" action="{{ route('question.update',$question->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="quiz_id" :value="__('questions.id')"/>
            {{ $question->id }}
        </div>

        <div>
            <x-input-label for="section_id" :value="__('questions.section_id')"/>
            <x-questions.select-sections name="section_id"
                                             class="mt-1 block w-full" autofocus
                                             autocomplete="section_id"
                                             :value="old('section_id',$question->section_id)" :options="$sections" />
            <x-input-error class="mt-2" :messages="$errors->get('section_id')" />
        </div>

        <div>
            <x-input-label for="quiz_id" :value="__('questions.quiz_id')"/>
            <x-text-input id="quiz_id" name="quiz_id" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="topic" :value="old('quiz_id', $question->quiz_id)" />
            <x-input-error class="mt-2" :messages="$errors->get('quiz_id')"/>
        </div>

        <div>
            <x-input-label for="primary_id" :value="__('categories.category_p')"/>
            <x-categories.select-primary-categories name="primary_id"
                                                    class="mt-1 block w-full" autofocus
                                                    autocomplete="primary_id"
                                                    :value="old('primary_id',$question->p_c_id)" :options="$p_categories"/>
            <x-input-label for="secondary_id" :value="__('categories.category_s')"/>
            <x-categories.select-secondary-categories name="secondary_id"
                                                      class="mt-1 block w-full" autofocus
                                                      autocomplete="secondary_id"
                                                      :value="old('secondary_id',$question->s_c_id)" :options="$s_categories" />
            <x-input-label for="category_id" :value="__('categories.category')"/>
            <x-categories.select-categories name="category_id"
                                            class="mt-1 block w-full" autofocus
                                            autocomplete="category_id"
                                            :value="old('category_id',$question->c_id)" :options="$categories" />
            <x-input-error class="mt-2" :messages="$errors->get('primary_id')" />
            <x-input-error class="mt-2" :messages="$errors->get('secondary_id')" />
            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />

        </div>

        <div>
            <x-input-label for="compitency" :value="__('questions.compitency')"/>
            <x-questions.select-compitencies name="compitency"
                                             class="mt-1 block w-full" autofocus
                                             autocomplete="compitency"
                                             :value="old('compitency',$question->compitency)" />
            <x-input-error class="mt-2" :messages="$errors->get('compitency')" />
        </div>

        <div>
            <x-input-label for="topic" :value="__('questions.topic')"/>
            <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="topic" :value="old('topic', $question->topic)" />
            <x-input-error class="mt-2" :messages="$errors->get('topic')"/>
        </div>



        <div>
            <x-input-label for="text" :value="__('questions.text')"/>
            <x-textarea cols="30" rows="4" id="text" name="text" class="mt-1 block w-full" required autofocus
                        autocomplete="text">{{old('text', strip_tags($question->text))}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('text')"/>
        </div>

        {{--<div>
            <x-input-label for="image" :value="__('questions.image')"/>
            @if(!empty($question->images))
                @foreach($question->images as $key => $image)
                    <img src="{{ \Storage::url($image->filepath."/".$image->filename) }}">
                    <x-file-input name="image[{{$key}}]" id="image_1"></x-file-input>
                    <input type="hidden" name="image_id[{{$key}}]" value="{{$image->id}}"></input-input>
                @endforeach
            @endif
        </div>--}}

        <div>
            <x-input-label for="correct_choice" :value="__('questions.correct_choice')"/>
            <x-textarea cols="30" rows="2" id="correct_choice" name="correct_choice" type="text" class="mt-1 block w-full" required
                        autofocus
                        autocomplete="correct_choice">{{old('correct_choice',$question->correct_choice)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('correct_choice')"/>
        </div>

        <div>
            <x-input-label for="wrong_choice_1" :value="__('questions.wrong_choice',['num'=>1])"/>
            <x-textarea cols="30" rows="2" id="wrong_choice_1" name="wrong_choice_1" type="text" class="mt-1 block w-full" required
                        autofocus
                        autocomplete="wrong_choice_1">{{old('wrong_choice_1',$question->wrong_choice_1)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('wrong_choice_1')"/>
        </div>

        <div>
            <x-input-label for="wrong_choice_2" :value="__('questions.wrong_choice',['num'=>2])"/>
            <x-textarea cols="30" rows="2" id="wrong_choice_2" name="wrong_choice_2" type="text" class="mt-1 block w-full" required
                        autofocus
                        autocomplete="wrong_choice_2">{{old('wrong_choice_2',$question->wrong_choice_2)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('wrong_choice_2')"/>
        </div>

        <div>
            <x-input-label for="wrong_choice_3" :value="__('questions.wrong_choice',['num'=>3])"/>
            <x-textarea cols="30" rows="2" id="wrong_choice_3" name="wrong_choice_3" type="text" class="mt-1 block w-full" required
                        autofocus
                        autocomplete="wrong_choice_3">{{old('wrong_choice_3',$question->wrong_choice_3)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('wrong_choice_3')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.explanation')"/>
            <x-textarea cols="30" rows="8" id="explanation" name="explanation" class="mt-1 block w-full" required autofocus
                        autocomplete="explanation">{{old('explanation', $question->explanation)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('explanation')"/>
        </div>

        <!--
        <div>
            <x-input-label for="is_adopt" :value="__('questions.is_adopt')"/>
            <input type="hidden" name="is_adopt" value="0">
            <input type="checkbox" name="is_adopt" id="is_adopt" value="1" {{ old('is_adopt', $question->is_adopt) == '1' ? 'checked' : '' }} />
        </div>
    -->
        <input type="hidden" name="is_request" value="1">
        <input type="hidden" name="is_approve" value="0">
        <input type="hidden" name="is_remand" value="{{old('is_remand', $question->is_remand)}}">


        <x-primary-button class="ml-3">
            {{ __('TemporarySave') }}
        </x-primary-button>

        <x-primary-button class="ml-3" onClick="resetRequestValue();resetApproveValue();changeRemandValue()">
            {{ __('SaveAndRemand') }}
        </x-primary-button>

        <x-danger-button class="ml-3" onClick="resetRequestValue();changeApproveValue();resetRemandValue()">
            {{ __('Approve') }}
        </x-danger-button>
    </form>
</section>
