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

    <form method="post" action="{{ route('section.update',$section->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="quiz_id" :value="__('sections.id')"/>
            {{ $section->id }}
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
            <input type="checkbox">
            <x-textarea cols="30" rows="4" id="text" name="case_text" class="mt-1 block w-full" required autofocus
                        autocomplete="case_text">{{old('case_text')}}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('case_text')"/>
        </div>

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
