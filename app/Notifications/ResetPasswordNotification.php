<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends BaseResetPassword
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @param string $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Construire l'URL de réinitialisation manuellement
        // Format: /reset-password?token=XXX&email=YYY
        $resetUrl = url('/reset-password') . '?' . http_build_query([
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        // Retourner le mail avec notre template personnalisé (français + cool)
        return (new MailMessage)
            ->subject('🔐 Réinitialisation de votre mot de passe NoflayHub')
            ->view('emails.reset-password', [
                'user' => $notifiable,
                'resetUrl' => $resetUrl,
                'expiresIn' => config('auth.passwords.users.expire'),
            ]);
    }

    /**
     * Get the mail representation of the notification (Markdown format alternative).
     * 
     * Cette méthode n'est pas utilisée car on utilise view() au lieu de markdown()
     */
    public function toMailUsingView($notifiable)
    {
        // Cette méthode n'est pas utilisée
        // On utilise le template HTML personnalisé via view()
        return null;
    }
}

