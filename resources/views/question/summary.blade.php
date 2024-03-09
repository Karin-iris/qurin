@section('page-vite')
    @vite(['resources/js/mySectionTable.js'])
@endsection

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sections') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <header class="mb-5">
                        <h2 class="text-lg font-medium text-gray-900">
                            大分類別集計
                            <!--{{ __('sections.list') }}-->
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            <!--{{ __('sections.list_explain') }}-->
                        </p>
                    </header>
                    <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="p-10 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="border-b-2 border-gray-500">
                            <th class="w-20">カテゴリコード</th>
                            <th>カテゴリ名</th>
                            <th>問題数</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                    @foreach($p_summary as $raw)
                        <tr class="border-b border-gray-500 text-sm bg-white">
                            <td><strong>{{$raw->p_c_code}}</strong></td>
                            <td><strong>{{$raw->p_c_name}}</strong></td>
                            <td><strong>{{$raw->count_questions}}</strong></td>
                        </tr>
                    @endforeach
                        </tbody>
                    </table>
            </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <header class="mb-5">
                        <h2 class="text-lg font-medium text-gray-900">
                            中分類別集計
                            <!--{{ __('sections.list') }}-->
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            <!--{{ __('sections.list_explain') }}-->
                        </p>
                    </header>
                    <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="p-10 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="border-b-2 border-gray-500">
                            <th class="w-20">カテゴリコード</th>
                            <th>カテゴリ名</th>
                            <th>問題数</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                        @foreach($s_summary as $raw)
                            <tr class="border-b border-gray-500 text-sm bg-white">
                                <td><strong>{{$raw->p_c_code}}-{{$raw->s_c_code}}</strong></td>
                                <td><strong>{{$raw->s_c_name}}</strong></td>
                                <td><strong>{{$raw->count_questions}}</strong></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <header class="mb-5">
                        <h2 class="text-lg font-medium text-gray-900">
                            小分類別集計
                            <!--{{ __('sections.list') }}-->
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            <!--{{ __('sections.list_explain') }}-->
                        </p>
                    </header>
                    <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="p-10 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="border-b-2 border-gray-500">
                            <th class="w-20">カテゴリコード</th>
                            <th>カテゴリ名</th>
                            <th>問題数</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                        @foreach($summary as $raw)
                            <tr class="border-b border-gray-500 text-sm bg-white">
                                <td><strong>{{$raw->p_c_code}}-{{$raw->s_c_code}}-{{$raw->c_code}}</strong></td>
                                <td><strong>{{$raw->c_name}}</strong></td>
                                <td><strong>{{$raw->count_questions}}</strong></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
