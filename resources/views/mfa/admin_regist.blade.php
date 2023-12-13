<x-admin-layout>
    <h1>MFA QR Code</h1>
    <p>Scan this QR code with your MFA app (e.g., Google Authenticator).</p>
    <img src="data:image/png;base64, {{ $qr_image }}" alt="MFA QR Code">

    <form method="POST" action="{{ route('mfa.admin_regist') }}">
        @csrf
        <input type="hidden" name="secret" value="{{ $secret }}">
        <label for="mfa_code">Enter the code from the app:</label>
        <input type="text" name="mfa_code" id="mfa_code" required>
        <button type="submit">Enable MFA</button>
    </form>
</x-admin-layout>
