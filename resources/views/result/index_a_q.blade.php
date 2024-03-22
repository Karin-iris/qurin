<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-8 lg:px-10 space-y-6">
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

                    <form action="{{ route('result.updates_q',['resultId'=>$resultId]) }}" method="post">
                        @csrf
                        @method('put')
                        <x-primary-button class="ml-3">
                            {{ __('一括処理') }}
                        </x-primary-button>
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
                            <th>ダミー</th>
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
                                <td>
                                    <div class="flex items-center">
                                        <input type="hidden" name="questions[{{ $question->id }}]" value="-1">
                                        <input id="default-checkbox" id="check_{{ $question->id }}" type="checkbox" name="questions[{{ $question->id }}]" @if($question->is_dummy === 1 )checked="checked" @endif value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="check_{{ $question->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">dummy</label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
