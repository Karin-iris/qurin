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
<form method="post" action="{{ route('import.all_import_csv') }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="import_file" id="file_input" type="file">
    <x-primary-button class="ml-3">
        {{ __('TemporarySave') }}
    </x-primary-button>
</form>
    </div>
    </div>
    </div>
    </div>
</x-admin-layout>
