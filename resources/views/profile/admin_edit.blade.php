<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (env('APP_COM_NAME') !== "tc")
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-admin-profile-information-form')
                </div>
            </div>
            @endif
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-admin-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('MFA Information') }}
                    </h2>
                    <img src="data:image/png;base64, {{ $qr_image }}" alt="MFA QR Code">

                    <form method="POST" action="{{ route('mfa.admin_register',['id' => $admin->id]) }}">
                        @csrf
                        @method('post')

                        <input type="hidden" name="mfa_secret" value="{{ $secret }}">
                        <label for="mfa_code">Enter the code from the app:</label>
                        <input type="text" name="mfa_code" id="mfa_code" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enable MFA</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
