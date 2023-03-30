<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
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
    </div>
</x-app-layout>
