@component('mail::message')

# Restuj hasło

Kliknij poniższy przycisk aby zresetować swoje hasło w sklepie BasePC
@component('mail::button', ['url' =>'http://localhost:8080/#/home/password_reset?token='.$token])
Resetuj hasło
@endcomponent

Życzymy udanych zakupów BasePC<br>

@endcomponent

