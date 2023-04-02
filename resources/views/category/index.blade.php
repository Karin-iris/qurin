<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('categories.list') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("categories.explain") }}
                    </p>
                </header>
                <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        onClick="location.href='{{ route('category.create') }}'">{{ __('categories.create') }}
                </button>
                <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="border-b-2 border-gray-500">
                        <th>表示順</th>
                        <th>大カテゴリ名</th>
                        <th>中カテゴリ名</th>
                        <th>カテゴリ名</th>
                        <th>登録時間</th>
                        <th>更新時間</th>
                        <th>編集</th>
                        <th>削除</th>
                    </tr>
                    </thead>
                    <tbody class="text-md>
                    @foreach($categories as $category)
                        <tr class=" bg-white border-b dark:bg-gray-900 dark:border-gray-700
                    ">
                    <td>{{$category->order}}</td>
                    <td>{{$category->p_name}}</td>
                    <td>{{$category->s_name}}</td>
                    <td>{{$category->name}}[{{$category->code}}]</td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                    <td>
                        @if(!empty($category->id))
                            <a href="{{ route('category.edit', ['id'=> $category->id]) }}">編集</a>
                        @endif
                    </td>
                    <td>
                        @if(!empty($category->id))
                            <a href="{{ route('category.destroy', ['id'=> $category->id]) }}">削除</a>
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
