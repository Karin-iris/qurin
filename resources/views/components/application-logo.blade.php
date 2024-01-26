@if (env('APP_COM_NAME')=="dlp")
<img src="{{ asset('images/logo_dlp.png')}}" {{ $attributes }}>
@endif
@if (env('APP_COM_NAME')=="tc")
<img src="{{ asset('images/logo_tc.png')}}" {{ $attributes }}>
@endif
