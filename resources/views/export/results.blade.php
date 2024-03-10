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

                    <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="p-10 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="border-b-2 border-gray-500">
                            <th class="w-20">Result ID</th>
                            <th>結果タイトル</th>
                            <th>作成時間<br>更新時間</th>
                            <th>調整</th>
                            <th>ダウンロード</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                    @foreach($results as $result)
                        <tr>
                        <td>{{ $result->id }}</td>
                        <td>{{ $result->title }}</td>
                            <td>{{ $result->result_failed_count }}</td>
                        <td>{{ $result->inserted_at }}</td>
                        </tr>
                    @endforeach
                        </tbody>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
