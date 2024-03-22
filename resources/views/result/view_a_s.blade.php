<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questions') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <header class="mb-5">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('export.result') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('export.result_explain') }}
                        </p>
                    </header>
<table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
    <thead
        class="p-10 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr class="border-b-2 border-gray-500">
        <th class="w-20">Result ID</th>
        <th>qurin問題ID</th>
        <th>問題文</th>
        <th>解答</th>
        <th>正誤</th>
        <th>正答率</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody class="text-md">
    @foreach($questions as $question)
        <tr style="">
            <td>{{ $question->order }}</td>
            <td>{{ $question->qurin_question_id }}</td>
            <td>{{ mb_substr($question->text,'0','50') }}</td>
            <td>{{ $question->answer_text }}</td>
            <td>{{ $question->answer_num ==1 ?'正解':'誤答' }}</td>
            <td></td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>


