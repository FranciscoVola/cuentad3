@component('mail::message')
# ¡Hola!

Recibimos una solicitud para restablecer tu contraseña.

@component('mail::button', ['url' => $url])
Restablecer contraseña
@endcomponent

Este enlace expirará en 60 minutos.

Si no solicitaste el restablecimiento, no es necesario hacer nada.

Saludos,  
CUENTAD3
@endcomponent
