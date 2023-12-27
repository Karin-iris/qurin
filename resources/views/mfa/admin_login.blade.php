<x-guest-layout>
    <div class="mt-4">
        <form method="POST" action="{{ route('mfa.admin_login') }}">
            @csrf
            <label for="mfa_code">MFA Code:</label>
            <input type="text" name="mfa_code" id="mfa_code" required>
            <x-primary-button class="ml-3">
                Verify
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
