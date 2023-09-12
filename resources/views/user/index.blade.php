<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <header class="mb-5">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('users.users') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('users.list_users') }}
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
                    @endif

                    <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            onClick="location.href='{{ route('user.create') }}'">
                        {{ __('users.add') }}
                    </button>

                    <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="p-10 text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="border-b-2 border-gray-500">
                            <th class="w-20">User ID</th>
                            <th>{{ __('users.name')}}</th>
                            <th>{{ __('users.email')}}</th>
                            <th>{{ __('users.password')}}</th>
                            <th>編集</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                        @foreach($users as $user)
                            <tr class="border-b border-gray-500 text-sm">
                                <td><strong>{{ $user->id }}</strong></td>
                                <td>{{ encrypt($user->name) }}</td>
                                <td>{{ decrypt(encrypt($user->email)) }}</td>
                                <td>{{ $user->password }}</td>
                                <td>編集</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
