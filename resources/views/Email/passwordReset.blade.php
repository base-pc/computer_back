@component('mail::message')
# Resetowanie hasła

Aby zresetować swoje hasło w sklepie BASE-PC kliknij w przycisk znajdujący
się poniżej.

@component('mail::button', ['url' =>'http://localhost:8080/#/home/password_reset?token='.$token])
        Resetuj hasło
@endcomponent

Dziękujemy i życzymy udanych zakupów<br>

@endcomponent

