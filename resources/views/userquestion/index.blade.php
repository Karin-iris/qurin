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
                    <header class="mb-5">
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

                    <table class="border-gray-900 w-full text-lg text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="p-10 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="border-b-2 border-gray-500">
                            <th>{{ __('categories.category_p')}}</th>
                            <th>{{ __('categories.category_s')}}</th>
                            <th>{{ __('categories.category')}}</th>
                            <th>試験問題（要約）</th>
                            <th class="w-3/12">作成時間<br>更新時間</th>
                            <th class="w-1/12">編集</th>
                            <th class="w-1/12">削除</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                        @foreach($user_questions as $user_question)
                            <tr class="border-b border-gray-500 @if($user_question->is_approve == 1) bg-red-50 @elseif($user_question->is_request == 1) bg-blue-50 @else bg-white @endif">
                                <td>{{$user_question->p_c_code}}</td>
                                <td class="text-sm">{{$user_question->s_c_code}}{{ mb_substr($user_question->s_c_name,0,20)}}</td>
                                <td>{{$user_question->c_code}}</td>
                                <td class="text-sm">{{mb_substr($user_question->topic,0,30)}}</td>
                                <td class="text-sm">{{$user_question->created_at}}<br>
                                    {{$user_question->updated_at}}</td>
                                <td>
                                    @if(!empty($user_question->id) && $user_question->is_approve == 0 && $user_question->is_request == 0)
                                        <a href="{{ route('userquestion.edit', ['id'=> $user_question->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($user_question->id) && $user_question->is_approve == 0 && $user_question->is_request == 0)
                                        <form action="{{ route('userquestion.destroy', ['id'=>$user_question->id]) }}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onClick="return confirm('削除しますか')"
                                                    class="inline-flex items-center justify-center w-8 h-8 mr-2 text-pink-100 transition-colors duration-150 bg-pink-700 rounded-lg focus:shadow-outline hover:bg-pink-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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

            {{--
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <header class="mb-5">
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
                    <table class="border-gray-900 w-full text-lg text-left text-gray-500 dark:text-gray-400">
                        <thead class="p-10 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="border-b-2 border-gray-500">
                            <th class="w-7/12">ケース問題（要約）</th>
                            <th class="w-3/12">作成時間<br>更新時間</th>
                            <th class="w-1/12">編集</th>
                            <th class="w-1/12">削除</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                        @foreach($user_question_cases as $user_question_case)
                            <tr class="border-b border-gray-500 @if($user_question_case->is_approve == 1) bg-red-50 @elseif($user_question_case->is_request == 1) bg-blue-50 @else bg-white @endif">
                                <td>{{$user_question_case->topic}}</td>
                                <td>{{$user_question_case->created_at}}<br>
                                    {{$user_question_case->updated_at}}</td>
                                <td>
                                    @if(!empty($user_question_case->id) && $user_question_case->is_approve == 0 && $user_question_case->is_request == 0)
                                    <a href="{{ route('userquestion.edit_c', ['id'=> $user_question_case->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($user_question_case->id) && $user_question_case->is_approve == 0 && $user_question_case->is_request == 0)
                                        <form action="{{ route('userquestion.destroy_c', ['id'=>$user_question_case->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onClick="return confirm('削除しますか')" class="inline-flex items-center justify-center w-8 h-8 mr-2 text-pink-100 transition-colors duration-150 bg-pink-700 rounded-lg focus:shadow-outline hover:bg-pink-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
            </div>--}}
        </div>
    </div>

</x-app-layout>
