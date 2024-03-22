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
                    <p>平均正答率{{ $summary->avg }}</p>
                    <p>標準偏差{{ $summary->stddev }}</p>
                    <p>最高点{{ $summary->max_score }}</p>
                    <p>最低点{{ $summary->min_score }}</p>
                    <p>最高不合格点{{ $summary->max_non_passed_score }}</p>
                    <p>最低合格点{{ $summary->min_passed_score }}</p>
                    <p>合格率{{ $summary->passed_rate }}</p>
                    <form action="{{ route('result.updates_s',['resultId'=>$resultId]) }}" method="post">
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
                                <th>問題数</th>
                                <th>回答数</th>
                                <th>正答数</th>
                                <th>誤答数</th>
                                <th>無回答数</th>
                                <th>正解率</th>
                                <th>偏差値</th>
                                <th>得点</th>
                                <th>合否</th>
                            </tr>
                            </thead>
                            <tbody class="text-md">
                            @foreach($students as $student)
                                <tr style="background-color: {{ $student->is_passed=="1"?"#fcc":"#cff" }}">
                                    <td>{{ $student->code }}</td>
                                    <td>{{ $student->questions_count }}</td>
                                    <td>{{ $student->answers_count }}</td>
                                    <td>{{ $student->answers_score }}/{{ $student->score_count }}</td>
                                    <td>{{ $student->answers_wrong_score }}</td>
                                    <td>{{ $student->answers_null_score }}</td>
                                    <td>{{ $student->correct_rate }}</td>
                                    <td>{{ $student->stddevv }}</td>
                                    <td>{{ $student->score }}</td>
                                    <td>{{ $student->is_passed=="1"?"合格":"不合格" }}</td>
                                    <td>
                                        <div class="flex items-center">
                                            <input type="hidden" name="students[{{ $student->id }}]" value="-1">
                                            <input id="default-checkbox" id="check_{{ $student->id }}" type="checkbox"
                                                   name="students[{{ $student->id }}]"
                                                   @if($student->is_dummy === 1 )checked="checked" @endif value="1"
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="check_{{ $student->id }}"
                                                   class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">dummy</label>
                                        </div>
                                    </td>
                                    <td>
                                        @if(!empty($student->id))
                                            <a href="{{ route('result.view_a_s', ['studentId'=> $student->id,'resultId'=>$resultId]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                                </svg>
                                            </a>
                                        @endif
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
