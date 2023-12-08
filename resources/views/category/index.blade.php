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
                @if (session('status') === 'updated')
                    <div class="p-4 mb-4 text-sm text-gray-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                        <span class="font-medium">カテゴリを更新しました。</span>
                    </div>
                @elseif(session('status') === 'saved')
                    <div class="p-4 mb-4 text-sm text-gray-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                        <span class="font-medium">カテゴリを登録しました。</span>
                    </div>
                @endif

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
                        <tr class=" bg-white border-t dark:border-gray-700
                    ">
                    <td>{{$category->order}}</td>
                    <td>{{$category->p_code}}</td>
                    <td>@if(!empty($category->p_id))<a
                            href="{{ route('category.edit_p', ['id'=> $category->p_id]) }}">[{{$category->p_code}}
                            ]{{$category->p_name}}</a>
                        @endif
                    </td>
                    <td>@if(!empty($category->s_id))<a
                            href="{{ route('category.edit_s', ['id'=> $category->s_id]) }}">[{{$category->s_code}}
                            ]{{$category->s_name}}</a>
                        @else
                            <form action="{{ route('category.destroy_p', ['id'=>$category->p_id]) }}"
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
                    <td>@if(!empty($category->id))<a
                            href="{{ route('category.edit', ['id'=> $category->id]) }}">[{{$category->code}}
                            ]{{$category->name}}</a>
                        @elseif(!empty($category->s_id))
                            <form action="{{ route('category.destroy_s', ['id'=>$category->s_id]) }}"
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
                    <td>
                        @if(!empty($category->id))
                            <form action="{{ route('category.destroy', $category->id) }}"
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
    </div>
</x-admin-layout>
