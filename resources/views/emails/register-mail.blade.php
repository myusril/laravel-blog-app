@component('mail::message')
    # Hello {{ $user->name }},

    Thank you for registering! Please verify your email address by clicking the button below:

    @component('mail::button', ['url' => url('/register/verify/' . $user->verification_token)])
        Verify Email
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
