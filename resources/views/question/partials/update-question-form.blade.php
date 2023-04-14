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
            <x-input-label for="code" :value="__('categories.category_p')"/>
            <p>{{$question->p_c_name}}</p>
            <x-input-label for="code" :value="__('categories.category_s')"/>
            <p>{{$question->s_c_name}}</p>
            <x-input-label for="code" :value="__('categories.category')"/>
            <p>{{$question->c_name}}</p>

        </div>

        <div>
            <x-input-label for="name" :value="__('questions.topic')"/>
            <x-text-input id="name" name="topic" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="topic" :value="old('topic', $question->topic)" />
            <x-input-error class="mt-2" :messages="$errors->get('topic')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.text')"/>
            <x-textarea cols="30" rows="4" id="text" name="text" class="mt-1 block w-full" required autofocus
                        autocomplete="text">{{old('explanation', $question->text)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('text')"/>
        </div>

        <div>
            <x-input-label for="image" :value="__('questions.image')"/>
            @if(!empty($user_question->images))
                @foreach($user_question->images as $key => $image)
                    <img src="{{ \Storage::url($image->filepath."/".$image->filename) }}">
                    <x-file-input name="image[{{$key}}]" id="image_1"></x-file-input>
                    <input type="hidden" name="image_id[{{$key}}]" value="{{$image->id}}"></input-input>
                @endforeach
            @endif
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
            <x-textarea cols="30" rows="4" id="explanation" name="explanation" class="mt-1 block w-full" required autofocus
                        autocomplete="explanation">{{old('explanation', $question->explanation)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('explanation')"/>
        </div>

        <input type="hidden" name="is_request" value="1">
        <input type="hidden" name="is_approve" value="0">

        <x-primary-button class="ml-3">
            {{ __('TemporarySave') }}
        </x-primary-button>

        <x-primary-button class="ml-3" onClick="resetRequestValue();resetApproveValue();">
            {{ __('SaveAndRemand') }}
        </x-primary-button>

        <x-danger-button class="ml-3" onClick="resetRequestValue();changeApproveValue();">
            {{ __('Approve') }}
        </x-danger-button>
    </form>
</section>
