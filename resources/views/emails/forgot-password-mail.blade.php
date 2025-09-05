@component('mail::message')
    # Hello {{ $user->name }},

    We understand it happens.

    @component('mail::button', ['url' => url('/reset-password/' . $user->remember_token)])
        Reset Your Password
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
