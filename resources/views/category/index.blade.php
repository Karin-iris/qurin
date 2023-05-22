<x-admin-layout>
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
                        {{ __("categories.list_explain") }}
                    </p>
                </header>
                <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        onClick="location.href='{{ route('category.create_p') }}'">{{ __('categories.create_p') }}
                </button>
                <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        onClick="location.href='{{ route('category.create_s') }}'">{{ __('categories.create_s') }}
                </button>
                <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        onClick="location.href='{{ route('category.create') }}'">{{ __('categories.create') }}
                </button>
                <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="border-b-2 border-gray-500">
                        <th>表示順</th>
                        <th>{{ __('categories.code') }}</th>
                        <th>{{ __('categories.category_p') }}</th>
                        <th>{{ __('categories.category_s') }}</th>
                        <th>{{ __('categories.category') }}</th>
                        <th>削除</th>
                    </tr>
                    </thead>
                    <tbody class="text-md>
                    @foreach($categories as $category)
                        <tr class=" bg-white border-t dark:bg-gray-900 dark:border-gray-700
                    ">
                    <td>{{$category->order}}</td>
                    <td>{{$category->p_code}}</td>
                    <td>@if(!empty($category->p_id))<a
                            href="{{ route('category.edit_p', ['id'=> $category->p_id]) }}">[{{$category->p_code}}
                            ]{{$category->p_name}}</a>@endif</td>
                    <td>@if(!empty($category->s_id))<a
                            href="{{ route('category.edit_s', ['id'=> $category->s_id]) }}">[{{$category->s_code}}
                            ]{{$category->s_name}}</a>@endif</td>
                    <td>@if(!empty($category->id))<a
                            href="{{ route('category.edit', ['id'=> $category->id]) }}">[{{$category->code}}
                            ]{{$category->name}}</a>@endif</td>
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
</x-admin-layout>
