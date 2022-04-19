@component('mail::message')
# Welcome

Hi, {{ $user->name }}
<br>
Welcome to Laracamp, your account has been created successfully, Now you can chose your best match camp!

@component('mail::button', ['url' => route('welcome')])
Login Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
