<x-app-layout>
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
                            onClick="location.href='{{ route('userquestion.create') }}'">
                        <i class="fas fa-heart"></i> With Icon and Text
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
                        @foreach($user_questions as $user_question)
                            <tr class="border-b border-gray-500 bg-white">
                                <td>{{$user_question->topic}}</td>
                                <td>{{$user_question->text}}</td>
                                <td>{{$user_question->created_at}}</td>
                                <td>{{$user_question->updated_at}}</td>
                                <td>
                                    @if(!empty($user_question->id))
                                        <a href="{{ route('userquestion.edit', ['id'=> $user_question->id]) }}">編集</a>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($user_question->id))
                                        <a href="{{ route('userquestion.destroy', ['id'=> $user_question->id]) }}">削除</a>
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
                            {{ __('questions.my_cases') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('questions.case_explain') }}
                        </p>
                    </header>
                    <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            onClick="location.href='{{ route('userquestion.create_c') }}'">
                        <i class="fas fa-heart"></i> With Icon and Text
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
                        @foreach($user_question_cases as $user_question_case)
                            <tr class="border-b border-gray-500 bg-white">
                                <td>{{$user_question_case->topic}}</td>
                                <td>{{$user_question_case->text}}</td>
                                <td>{{$user_question_case->created_at}}</td>
                                <td>{{$user_question_case->updated_at}}</td>
                                <td>
                                    @if(!empty($user_question_case->id))
                                        <a href="{{ route('userquestion.edit_c', ['id'=> $user_question_case->id]) }}">編集</a>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($user_question_case->id))
                                        <a href="{{ route('userquestion.destroy_c', ['id'=> $user_question_case->id]) }}">削除</a>
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

</x-app-layout>
