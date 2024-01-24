@section('page-vite')
    @vite(['resources/js/imageUpload.js'])
@endsection

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('users.user_edit') }}
        </h2>

        @if (session('status') === 'question-updated')
        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <span class="font-medium">問題の更新に成功しました。</span>
        </div>
        @endif

        <p class="mt-1 text-sm text-gray-600">
            {{ __("users.my_question_edit_message") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data"
          class="mt-6 space-y-6">
        @csrf
        @method('put')



        <div>
            <x-input-label for="name" :value="__('users.name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autofocus
                                    autocomplete="name" :value="old('name',$user->name)" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="icon" :value="__('users.icon')"/>

        @if (!empty($user->icon_image_path))
            @if (env('FILE_STORAGE_METHOD') == 'aws')
            <img src="{{ Storage::disk('s3')->temporaryUrl($user->icon_image_path, now()->addDay()) }}" width="100" height="100">
            @elseif (env('FILE_STORAGE_METHOD') == 'gcp')
            <img src="https://storage.cloud.google.com/qurin-bucket/icon/aaaaaa.jpg" width="100" height="100">
            @endif
        @endif

            <div id="image-upload-app">
                <image-upload-component></image-upload-component>
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('users.email')"/>
            <x-text-input id="topic" name="email" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="email" :value="old('email',$user->email)"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
        </div>

        <div>
            <x-input-label for="code" :value="__('users.code')"/>
            <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" autofocus
                          autocomplete="code" :value="old('code',$user->code)" />
            <x-input-error class="mt-2" :messages="$errors->get('code')" />
        </div>

        <input type="hidden" name="id" value="{{ $user->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="mode" value="update">
        <x-danger-button class="ml-3" onClick="changeRequestValue();resetRemandValue();return confirm('レビュー依頼送信後は編集できません。よろしいでしょうか。')">
            {{ __('Submit') }}
        </x-danger-button>
    </form>

</section>
