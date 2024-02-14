<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('examinations.edit') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("examinations.edit_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('examination.update',$examination->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="quiz_id" :value="__('examinations.id')"/>
            {{ $examination->id }}
        </div>


        <div>
            <x-input-label for="title" :value="__('examinations.title')"/>
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="title" :value="old('title', $examination->title)" />
            <x-input-error class="mt-2" :messages="$errors->get('title')"/>
        </div>

        <div>
            <x-input-label for="topic" :value="__('examinations.topic')"/>
            <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="topic" :value="old('topic', $examination->topic)" />
            <x-input-error class="mt-2" :messages="$errors->get('topic')"/>
        </div>

        <div>
            <x-input-label for="text" :value="__('examinations.text')"/>
            <x-textarea cols="30" rows="4" id="text" name="text" class="mt-1 block w-full" required autofocus
                        autocomplete="text">{{old('text', $examination->text)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('text')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('examinations.explanation')"/>
            <x-textarea cols="30" rows="8" id="explanation" name="explanation" class="mt-1 block w-full" required autofocus
                        autocomplete="explanation">{{old('explanation', $examination->explanation)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('explanation')"/>
        </div>

        <x-primary-button class="ml-3">
            {{ __('TemporarySave') }}
        </x-primary-button>

        <x-danger-button class="ml-3" x-on:click="$dispatch('close')">
            {{ __('Save') }}
        </x-danger-button>
    </form>
</section>
