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
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('questions.questions') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('questions.question_explain') }}
                        </p>
                    </header>
                    <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            onClick="location.href='{{ route('question.create') }}'">{{ __('questions.create') }}
                    </button>
                    <table class="border-1 border-gray-900 w-full text-lg text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="border-b-2 border-gray-500">
                            <th>試験問題（要約）</th>
                            <th>試験問題</th>
                            <th>作成時間</th>
                            <th>更新時間</th>
                            <th>編集</th>
                            <th>削除</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                        @foreach($questions as $question)
                            <tr class="border-b border-gray-500 bg-white">
                                <td>{{$question->topic}}</td>
                                <td>{{$question->text}}</td>
                                <td>{{$question->created_at}}</td>
                                <td>{{$question->updated_at}}</td>
                                <td>
                                    @if(!empty($question->id))
                                        <a href="{{ route('question.edit', ['id'=> $question->id]) }}">編集</a>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($question->id))
                                        <a href="{{ route('question.destroy', ['id'=> $question->id]) }}">削除</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('questions.cases') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('questions.case_explain') }}
                        </p>
                    </header>
                    <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            onClick="location.href='{{ route('question.create_c') }}'">{{ __('questions.create') }}
                    </button>
                    <table class="border-1 border-gray-900 w-full text-lg text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="border-b-2 border-gray-500">
                            <th>ケース問題（要約）</th>
                            <th>ケース問題</th>
                            <th>作成時間</th>
                            <th>更新時間</th>
                            <th>編集</th>
                            <th>削除</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                        @foreach($question_cases as $question_case)
                            <tr class="border-b border-gray-500 bg-white">
                                <td>{{$question_case->topic}}</td>
                                <td>{{$question_case->text}}</td>
                                <td>{{$question_case->created_at}}</td>
                                <td>{{$question_case->updated_at}}</td>
                                <td>
                                    @if(!empty($question_case->id))
                                        <a href="{{ route('question.edit_c', ['id'=> $question_case->id]) }}">編集</a>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($question_case->id))
                                        <a href="{{ route('question.destroy_c', ['id'=> $question_case->id]) }}">削除</a>
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
