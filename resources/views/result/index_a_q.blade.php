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
                            <th>問題文</th>
                            <th>回答数</th>
                            <th>正解数</th>
                            <th>誤答１</th>
                            <th>誤答２</th>
                            <th>誤答３</th>
                            <th>無回答数</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                        @foreach($questions as $question)
                            <tr>
                                <td>{{ $question->order }}</td>
                                <td>{{ mb_substr($question->text,'0','50') }}</td>
                                <td>{{ $question->answers_count }}</td>
                                <td>{{ $question->correct_count }}</td>
                                <td>{{ $question->wrong1_count }}</td>
                                <td>{{ $question->wrong2_count }}</td>
                                <td>{{ $question->wrong3_count }}</td>
                                <td>{{ $question->na_count }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
