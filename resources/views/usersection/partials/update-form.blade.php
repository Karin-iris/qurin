<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('sections.section_edit') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("sections.section_edit_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('usersection.update',$section->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="quiz_id" :value="__('sections.id')"/>
            {{ $section->id }}
        </div>

        <div>
            <x-input-label for="sec_id" :value="__('sections.sec_id')"/>
            <x-text-input id="sec_id" name="sec_id" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="sec_id" :value="old('sec_id', $section->sec_id)" />
            <x-input-error class="mt-2" :messages="$errors->get('sec_id')"/>
        </div>

        <div>
            <x-input-label for="title" :value="__('sections.title')"/>
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="title" :value="old('title', $section->title)" />
            <x-input-error class="mt-2" :messages="$errors->get('title')"/>
        </div>

        <div>
            <x-input-label for="topic" :value="__('sections.topic')"/>
            <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="topic" :value="old('topic', $section->topic)" />
            <x-input-error class="mt-2" :messages="$errors->get('topic')"/>
        </div>

        <div>
            <x-input-label for="text" :value="__('sections.case_text')"/>
            <input type="checkbox" name="is_case" value="1" {{ old('is_case', $section->is_case) == '1' ? 'checked' : '' }} />
            <x-textarea cols="30" rows="4" id="text" name="case_text" class="mt-1 block w-full" autofocus
                        autocomplete="case_text">{{old('case_text',$section->case_text)}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('case_text')"/>
        </div>
        <div>
            <input type="checkbox" name="is_default" value="1" {{ old('is_default', $section->is_default) == '1' ? 'checked' : '' }} />
        </div>
        <x-danger-button class="ml-3">
            {{ __('Save') }}
        </x-danger-button>
    </form>
</section>
