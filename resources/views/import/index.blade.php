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
                            {{ __('import.import') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('import.list_explain') }}
                        </p>
                    </header>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    Qurin IDとQuiz IDの紐付け
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    Qurin IDの紐付けを行います。紐付けに必要なデータは<br>
                                    [キー]4列目　問題文<br>
                                    [値]2列目　QuizID<br>

                                </p>
                            </header>
                            <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    onClick="location.href='{{ route('import.import') }}'">Qurin ID 紐付け
                            </button>
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    Qurin IDとQuiz IDの紐付け
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    Qurin IDの紐付けを行います。紐付けに必要なデータは<br>
                                    [キー]9列目　問題文<br>
                                    [値]2列目　QuizID<br>

                                </p>
                            </header>
                            <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    onClick="location.href='{{ route('import.import_raw') }}'">Qurin ID 紐付け
                            </button>
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    クラウドで行われた修正の反映
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    クラウドで行われた修正の反映を行います。紐付けに必要なデータは<br>
                                    [キー]2列目　QuizID<br>
                                    [値]4列目　問題文<br>
                                    [値]9列目　正解選択肢<br>
                                    [値]11列目　誤答選択肢[1]<br>
                                    [値]13列目　誤答選択肢[2]<br>
                                    [値]15列目　誤答選択肢[3]<br>
                                </p>
                            </header>
                            <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    onClick="location.href='{{ route('import.modify_import') }}'">修正反映
                            </button>
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <h2 class="text-lg font-medium text-gray-900">
                                QurinIDを持つ問題の一括インポート
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                QurinIDを持つ問題の一括インポートを行います。紐付けに必要なデータは<br>
                                [キー]2列目　QurinID<br>
                                [値]4列目　問題文<br>
                                [値]9列目　正解選択肢<br>
                                [値]11列目　誤答選択肢[1]<br>
                                [値]13列目　誤答選択肢[2]<br>
                                [値]15列目　誤答選択肢[3]<br>
                            </p>
                            <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    onClick="location.href='{{ route('import.all_import') }}'">CSVによる更新
                            </button>
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <h2 class="text-lg font-medium text-gray-900">
                                QurinIDを持つ問題の一括インポート
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                クラウドで行われた修正の反映を行います。紐付けに必要なデータは<br>
                                [キー]0列目　QurinID<br>
                                [値]1列目　解説文<br>
                            </p>

                            <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    onClick="location.href='{{ route('import.explain_import') }}'">解説文のインポート
                            </button>
                        </div>
                    </div>


                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <h2 class="text-lg font-medium text-gray-900">
                                QurinIDを持つ問題の一括インポート
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                クラウドで行われた修正の反映を行います。紐付けに必要なデータは<br>
                                [キー]0列目　QurinID<br>
                                [値]1列目　概要<br>
                            </p>

                            <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    onClick="location.href='{{ route('import.topic_import') }}'">概要のインポート
                            </button>
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <h2 class="text-lg font-medium text-gray-900">
                                QurinIDを持つ問題の一括インポート
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                クラウドで行われた修正の反映を行います。紐付けに必要なデータは<br>
                                [キー]0列目　QurinID<br>
                                [値]1列目　概要<br>ああ
                            </p>

                            <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    onClick="location.href='{{ route('import.import_result') }}'">結果のインポート
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
