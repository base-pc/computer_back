@component('mail::message')
    # Introduction

    The body of your message.

    @component('mail::button', ['url' =>'http://localhost:8080/#/home/password_reset?token='.$token])
        Resetuj hasło
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
