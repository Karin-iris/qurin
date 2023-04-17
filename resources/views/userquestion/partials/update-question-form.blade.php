<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('questions.my_question_edit') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("questions.my_question_edit_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('userquestion.update',$user_question->id) }}" enctype="multipart/form-data"
          class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="code" :value="__('categories.category_p')"/>
            <p>{{$user_question->p_c_name}}</p>
            <x-input-label for="code" :value="__('categories.category_s')"/>
            <p>{{$user_question->s_c_name}}</p>
            <x-input-label for="code" :value="__('categories.category')"/>
            <p>{{$user_question->c_name}}</p>
        </div>

        <div>
            <x-input-label for="name" :value="__('questions.topic')"/>
            <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="topic" :value="old('topic',$user_question->topic)"/>
            <x-input-error class="mt-2" :messages="$errors->get('topic')"/>
        </div>

        <div>
            <x-input-label for="text" :value="__('questions.text')"/>
            <x-textarea cols="30" rows="4" id="text" name="text" class="mt-1 block w-full" required autofocus
                        autocomplete="name">{{old('text',$user_question->text)}}</x-textarea>
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
            <x-file-input name="image[new]" id="image_1"></x-file-input>
            <input type="hidden" name="image_id[new]" value=""></input-input>
            <x-input-error class="mt-2" :messages="$errors->get('image.0')"/>
        </div>

        <div>
            <x-input-label for="correct_choice" :value="__('questions.correct_choice')"/>
            <x-textarea cols="30" rows="2" id="correct_choice" name="correct_choice" type="text" class="mt-1 block w-full" required
                          autofocus
                          autocomplete="correct_choice">{{old('correct_choice',$user_question->correct_choice)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('correct_choice')"/>
        </div>

        <div>
            <x-input-label for="wrong_choice_1" :value="__('questions.wrong_choice',['num'=>1])"/>
            <x-textarea cols="30" rows="2" id="wrong_choice_1" name="wrong_choice_1" type="text" class="mt-1 block w-full" required
                          autofocus
                          autocomplete="wrong_choice_1">{{old('wrong_choice_1',$user_question->wrong_choice_1)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('wrong_choice_1')"/>
        </div>

        <div>
            <x-input-label for="wrong_choice_2" :value="__('questions.wrong_choice',['num'=>2])"/>
            <x-textarea cols="30" rows="2" id="wrong_choice_2" name="wrong_choice_2" type="text" class="mt-1 block w-full" required
                          autofocus
                          autocomplete="wrong_choice_2">{{old('wrong_choice_2',$user_question->wrong_choice_2)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('wrong_choice_2')"/>
        </div>

        <div>
            <x-input-label for="wrong_choice_3" :value="__('questions.wrong_choice',['num'=>3])"/>
            <x-textarea cols="30" rows="2" id="wrong_choice_3" name="wrong_choice_3" type="text" class="mt-1 block w-full" required
                          autofocus
                          autocomplete="wrong_choice_3">{{old('wrong_choice_3',$user_question->wrong_choice_3)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('wrong_choice_3')"/>
        </div>

        <div>
            <x-input-label for="explanation" :value="__('questions.explanation')"/>
            <x-textarea cols="30" rows="4" id="explanation" name="explanation" class="mt-1 block w-full" required
                        autofocus
                        autocomplete="explanation">{{old('explanation',$user_question->explanation)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('explanation')"/>
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
