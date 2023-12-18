@section('page-vite')
    @vite(['resources/js/category.js']);
@endsection

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QuestionCaseAdd') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('question_case.partials.create-question-case-question-form')
                </div>
            </div>
        </div>
    </div>
    <div id="category-app">
        <category-component></category-component>
    </div>
</x-admin-layout>
