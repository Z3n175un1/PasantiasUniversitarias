<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ResetPassword extends Notification
{
    use Queueable;

    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        $expire = config('auth.passwords.users.expire', 60);

        return (new MailMessage)
            ->subject('Recuperación de Contraseña — UWorkFlow')
            ->greeting('¡Hola, ' . $notifiable->nombre . '!')
            ->line('Recibimos una solicitud para restablecer la contraseña de tu cuenta en **UWorkFlow**.')
            ->line('Para continuar, haz clic en el siguiente botón:')
            ->action('Restablecer Contraseña', $url)
            ->line('Este enlace expirará en **' . $expire . ' minutos**.')
            ->line('Si no solicitaste este cambio, puedes ignorar este mensaje.')
            ->salutation('Atentamente, el equipo de UWorkFlow')
            ->level('primary');
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
