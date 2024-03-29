@section('page-vite')
    @vite(['resources/js/questionTable.js'])
@endsection
@section('page-scripts')
    <script type="text/javascript" src="/js/category.js?q={{ time() }}"></script>
    <script type="text/javascript" src="/js/question.js?q={{ time() }}"></script>
@endsection

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
                            {{ __('questions.questions') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('questions.list_explain') }}
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
                    @elseif(session('status') === 'updated')
                        <div class="p-4 mb-4 text-sm text-gray-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                            <span class="font-medium">問題を編集しました。</span>
                        </div>
                    @elseif(session('status') === 'error')
                        <div class="p-4 mb-4 text-sm text-gray-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                            <span class="font-medium">エラーが出ています。</span>
                        </div>
                    @endif
                    <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            onClick="location.href='{{ route('question.summary') }}'">
                        {{ __('questions.summary') }}
                    </button>
                    {{--
                    <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focutexts:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            onClick="location.href='{{ route('question.create') }}'">{{ __('questions.create') }}
                    </button>
                    --}}
                </div>
                {{--
                @if (env('APP_COM_NAME') !== "tc")
        <div id="question-table" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-5">
            <table-component></table-component>
        </div>
                @endif
                @if (env('APP_COM_NAME') === "tc")
                --}}
                <div>
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('question.index') }}" class="mt-6 space-y-6">
                        @csrf
                        <x-input-label for="primary_id" :value="__('categories.category_p')"/>
                    <x-categories.select-primary-categories name="primary_id"
                                                            class="mt-1 block w-full" autofocus
                                                            autocomplete="primary_id"
                                                            :value="old('primary_id')" :options="$p_categories"/>
                        <x-input-label for="secondary_id" :value="__('categories.category_s')"/>
                        <x-categories.select-secondary-categories name="secondary_id"
                                                              class="mt-1 block w-full" autofocus
                                                              autocomplete="secondary_id"
                                                              :value="old('secondary_id')" :options="$s_categories"
                    />
                        <x-input-label for="primary_id" :value="__('categories.category')"/>
                        <x-categories.select-categories name="category_id"
                                                    class="mt-1 block w-full" autofocus
                                                    autocomplete="category_id"
                                                    :value="old('category_id')" :options="$categories"
                    />
                    <x-input-error class="mt-2" :messages="$errors->get('primary_id')"/>
                    <x-input-error class="mt-2" :messages="$errors->get('secondary_id')"/>
                    <x-input-error class="mt-2" :messages="$errors->get('category_id')"/>
                    <x-danger-button class="ml-3">
                        {{ __('検索') }}
                    </x-danger-button>
                    </form>
                </div>

                    <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="p-10 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="border-b-2 border-gray-500">
                            <th class="w-20">Qurin ID<br>Quiz ID</th>
                            <th>{{ __('categories.category_p')}}</th>
                            <th>{{ __('categories.category_s')}}</th>
                            <th>{{ __('categories.category')}}</th>
                            <th>試験問題（要約）</th>
                            <th class="w-30">問題作成者</th>
                            <th class="w-40">作成時間<br>更新時間</th>
                            <th class="w-10">編集</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                        @foreach($questions as $question)
                            <tr class="border-b border-gray-500 text-sm @if($question->is_request == 1)bg-blue-50 @elseif($question->is_remand == 1)bg-yellow-50 @elseif($question->is_approve == 1)bg-red-50 @else bg-white @endif">
                                <td><strong>{{$question->id}}</strong><br>
                                {{$question->quiz_id}}</td>
                                <td>[{{$question->p_c_code}}]{{ mb_substr($question->p_c_name,0,20)}}</td>
                                <td>[{{$question->s_c_code}}]{{ mb_substr($question->s_c_name,0,20)}}</td>
                                <td>[{{$question->c_code}}]{{ mb_substr($question->c_name,0,20)}}</td>
                                <td>{{mb_substr($question->topic,0,30)}}</td>
                                <td>@if(!empty($question->u_name)){{ \Crypt::decryptString($question->u_name) }}@endif</td>
                                <td class="text-sm">{{$question->created_at}}<br>
                                    {{$question->updated_at}}</td>
                                <td>
                                    @if(!empty($question->id))
                                        <a href="{{ route('question.edit', ['id'=> $question->id]) }}">
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
                {{--@endif--}}

            {{--<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <header class="mb-5">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('questions.cases') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('questions.case_list_explain') }}
                        </p>
                    </header>--}}
            {{--
            <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    onClick="location.href='{{ route('question.create_c') }}'">{{ __('questions.create_case') }}
            </button>
            --}}
            {{--<table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
                <thead class="p-10 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                    <tr class="border-b border-gray-500 @if($question_case->is_approve == 1) bg-red-50 @elseif($question_case->is_request == 1) bg-blue-50 @else bg-white @endif">
                        <td>{{$question_case->topic}}</td>
                        <td>{{$question_case->text}}</td>
                        <td>{{$question_case->created_at}}</td>
                        <td>{{$question_case->updated_at}}</td>
                        <td>
                            @if(!empty($question_case->id))
                                <a href="{{ route('question.edit_c', ['id'=> $question_case->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                    </svg>
                                </a>
                            @endif
                        </td>
                        <td>
                            @if(!empty($question_case->id))
                                <form action="{{ route('question.destroy_c', ['id'=>$question_case->id]) }}" method="post">
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
    </div>
    --}}
            </div>
        </div>
    </div>
</x-admin-layout>
