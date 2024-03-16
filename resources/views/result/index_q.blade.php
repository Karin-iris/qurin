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
                            <th>正答率</th>
                            <th>誤答１</th>
                            <th>誤答２</th>
                            <th>誤答３</th>
                            <th>無回答数</th>
                            <th>問題統計</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                        @foreach($questions as $question)
                            <tr>
                                <td>{{ $question->id }}</td>
                                <td>{{ mb_substr($question->text,'0','50') }}</td>
                                <td>{{ $question->answers_count }}</td>
                                <td>{{ $question->correct_count }}</td>
                                <td>{{ $question->correct_rate }}</td>
                                <td>{{ $question->wrong1_count }}</td>
                                <td>{{ $question->wrong2_count }}</td>
                                <td>{{ $question->wrong3_count }}</td>
                                <td>{{ $question->na_count }}</td>
                                <td>
                                    @if(!empty($question->id))
                                        <a href="{{ route('result.view_q', ['questionId'=> $question->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                            </svg>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
