@component('mail::message')
# Vérifiez votre adresse e-mail

Bonjour,

Merci de vous être inscrit ! Pour finaliser la création de votre compte, veuillez vérifier votre adresse e-mail.

Vous pouvez le faire en cliquant sur le bouton ci-dessous :

@component('mail::button', ['url' => $url, 'color' => 'success'])
Vérifier mon e-mail
@endcomponent

Si le bouton ne fonctionne pas, vous pouvez également utiliser le code à 6 chiffres suivant sur la page de vérification :

@component('mail::panel')
{{ $code }}
@endcomponent

Ce lien de vérification expirera dans {{ config('auth.verification.expire', 60) }} minutes.

Si vous n'avez pas créé de compte, aucune action n'est requise.

Cordialement,<br>
L'équipe {{ config('app.name') }}
@endcomponent
