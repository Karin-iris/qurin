<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('MyQuestions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('questions.my_list') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('questions.my_list_explain') }}
                        </p>
                    </header>

                    <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            onClick="location.href='{{ route('userquestion.create') }}'">
                            {{ __('questions.create_my') }}
                    </button>
                    <table class="border-1 border-gray-900 w-full text-lg text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="border-b-2 border-gray-500">
                            <th>{{ __('categories.category_p')}}</th>
                            <th>{{ __('categories.category_s')}}</th>
                            <th>{{ __('categories.category')}}</th>
                            <th>試験問題（要約）</th>
                            <th>作成時間<br>更新時間</th>
                            <th>編集</th>
                            <th>削除</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                        @foreach($user_questions as $user_question)
                            <tr class="border-b border-gray-500 bg-white">
                                <td>{{$user_question->p_c_name}}</td>
                                <td>{{$user_question->s_c_name}}</td>
                                <td>{{$user_question->c_name}}</td>
                                <td>{{$user_question->topic}}</td>
                                <td>{{$user_question->created_at}}<br>
                                    {{$user_question->updated_at}}</td>
                                <td>
                                    @if(!empty($user_question->id))
                                        <a href="{{ route('userquestion.edit', ['id'=> $user_question->id]) }}">
                                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($user_question->id))
                                        <form action="{{ route('userquestion.destroy', ['id'=>$user_question->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onClick="return confirm('削除しますか')" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                                </svg>
                                            </button>
                                        </form>
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
                            {{ __('questions.my_case_list') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('questions.my_case_list_explain') }}
                        </p>
                    </header>
                    <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            onClick="location.href='{{ route('userquestion.create_c') }}'">
                        <i class="fas fa-heart"></i>{{ __('questions.create_my_case') }}
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
                                        <a href="{{ route('userquestion.edit_c', ['id'=> $user_question_case->id]) }}">
                                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                            </svg></a>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($user_question_case->id))
                                        <form action="{{ route('userquestion.destroy_c', ['id'=>$user_question_case->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onClick="return confirm('削除しますか')" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                                </svg>
                                            </button>
                                        </form>
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
