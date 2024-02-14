@section('page-vite')
    @vite(['resources/js/toggleText.js'])
@endsection

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('admins.admin_edit') }}
        </h2>

        @if (session('status') === 'question-updated')
        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <span class="font-medium">問題の更新に成功しました。</span>
        </div>
        @endif

        <p class="mt-1 text-sm text-gray-600">
            {{ __("admins.my_question_edit_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('user.admin_update',$admin->id) }}" enctype="multipart/form-data"
          class="mt-6 space-y-6">
        @csrf
        @method('put')



        <div>
            <x-input-label for="name" :value="__('admins.name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autofocus
                                    autocomplete="name" :value="old('name',$admin->name)" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>


        <div>
            <x-input-label for="email" :value="__('admins.email')"/>
            <x-text-input id="topic" name="email" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="email" :value="old('email',$admin->email)"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
        </div>


        <div>
            <x-input-label for="code" :value="__('admins.code')"/>
            <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="code" :value="old('code',$admin->code)" />
            <x-input-error class="mt-2" :messages="$errors->get('code')" />
        </div>

        <div id="toggle-text-app">
            <x-input-label for="password" :value="__('admins.password')"/>
            <toggle-text-component></toggle-text-component>
        </div>

        <input type="hidden" name="admin_id" value="{{ Auth::user('admin')->id }}">
        <input type="hidden" name="id" value="{{ $admin->id }}">
        <input type="hidden" name="mode" value="update">
        <x-danger-button class="ml-3" x-on:click="$dispatch('close')">
            {{ __('Save') }}
        </x-danger-button>
    </form>

</section>
