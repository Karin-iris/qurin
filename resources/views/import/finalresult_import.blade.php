<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QuestionEdit') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('import.import_finalresult_csv') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <x-input-label for="title" :value="__('questions.title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" autofocus
                                          autocomplete="title" :value="old('title')"/>
                            <x-input-error class="mt-2" :messages="$errors->get('question_id')"/>
                        </div>

                        <div>
                            <x-input-label for="file_input" :value="__('questions.file_input')" />
                            <input  class="mt-1 block w-full" name="import_file" id="file_input" type="file">
                            <x-input-error class="mt-2" :messages="$errors->get('file_input')"/>
                        </div>

                        <x-primary-button class="ml-3">
                            {{ __('TemporarySave') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
