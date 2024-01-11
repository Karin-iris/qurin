@section('page-vite')
    @vite(['resources/js/questionCaseTable.js'])
@endsection

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QuestionsCase') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <header class="mb-5">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('question_cases.cases') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('question_cases.list_explain') }}
                        </p>
                    </header>
                    @if (session('status') === 'approved')
                        <div class="p-4 mb-4 text-sm text-gray-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                            <span class="font-medium">問題を承認しました。</span>
                        </div>
                    @elseif (session('status') === 'remand')
                        <div class="p-4 mb-4 text-sm text-gray-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                            <span class="font-medium">問題を差し戻しました。</span>
                        </div>
                    @elseif(session('status') === 'saved')
                        <div class="p-4 mb-4 text-sm text-gray-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                            <span class="font-medium">問題を一時保存しました。</span>
                        </div>
                    @endif
                    <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            onClick="location.href='{{ route('question_case.create') }}'">{{ __('question_cases.create_case') }}
                    </button>

                    <div id="question-case-table">
                        <div class="mb-10">
                            <table-component></table-component>
                        </div>
                        <div class="mb-10">
                            <table-question-component></table-question-component>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
