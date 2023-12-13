<x-guest-layout>
    <h1>Admin Multi-Factor Authentication</h1>
    <form method="POST" action="{{ route('mfa.admin_login') }}">
        @csrf
        <label for="mfa_code">MFA Code:</label>
        <input type="text" name="mfa_code" id="mfa_code" required>
        <button type="submit">Verify</button>
    </form>
</x-guest-layout>
