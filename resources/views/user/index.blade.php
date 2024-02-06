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
                    @if(session('status') === 'saved')
                        <div class="p-4 mb-4 text-sm text-gray-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                            <span class="font-medium">ユーザーを登録しました。</span>
                        </div>
                    @elseif(session('status') === 'updated')
                        <div class="p-4 mb-4 text-sm text-gray-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                            <span class="font-medium">ユーザーを編集しました。</span>
                        </div>
                    @elseif(session('status') === 'error')
                        <div class="p-4 mb-4 text-sm text-gray-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                            <span class="font-medium">エラーが出ています。</span>
                        </div>
                    @endif

                    <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            onClick="location.href='{{ route('user.create') }}'">
                        {{ __('users.add') }}
                    </button>

                    <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            onClick="location.href='{{ route('user.invite') }}'">
                        {{ __('users.invite') }}
                    </button>

                    <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            onClick="location.href='{{ route('user.admin_invite') }}'">
                        {{ __('users.admin_invite') }}
                    </button>

                    <table class="w-full text-lg text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="p-10 text-sm text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="border-b-2 border-gray-500">
                            <th class="w-20">User ID</th>
                            <th>{{ __('users.name')}}</th>
                            <th>{{ __('users.email')}}</th>
                            <td>{{ __('users.code') }}</td>
                            <th>編集</th>
                        </tr>
                        </thead>
                        <tbody class="text-md">
                        @foreach($users as $user)
                            <tr class="border-b border-gray-500 text-sm">
                                <td><strong>{{ $user->id }}</strong></td>
                                <td>{{ \Crypt::decryptString($user->name) }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->code }}</td>
                                <td>
                                    @if(!empty($user->id))
                                        <a href="{{ route('user.edit', ['id'=> $user->id]) }}">
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
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
