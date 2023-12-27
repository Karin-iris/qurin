<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('examinations.add') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("examinations.add_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('examination.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="title" :value="__('examinations.title')"/>
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="title" :value="old('title')"/>
            <x-input-error class="mt-2" :messages="$errors->get('title')"/>
        </div>

        <div>
            <x-input-label for="topic" :value="__('examinations.topic')"/>
            <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="topic" :value="old('topic')"/>
            <x-input-error class="mt-2" :messages="$errors->get('topic')"/>
        </div>

        <div>
            <x-input-label for="text" :value="__('examinations.text')"/>
            <x-textarea cols="30" rows="4" id="text" name="text" class="mt-1 block w-full" required autofocus
                        autocomplete="name">{{old('text')}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('text')"/>
        </div>

        <div>
            <x-input-label for="explanation" :value="__('examinations.explanation')"/>
            <x-textarea cols="30" rows="4" id="explanation" name="explanation" class="mt-1 block w-full" required
                        autofocus
                        autocomplete="name">{{old('explanation')}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('explanation')"/>
        </div>

        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-primary-button class="ml-3" x-on:click="$dispatch('close')">
            {{ __('Save') }}
        </x-primary-button>

        <x-danger-button class="ml-3">
            {{ __('Submit') }}
        </x-danger-button>
    </form>
</section>
