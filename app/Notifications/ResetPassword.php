<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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
            ->line('Para continuar con el proceso, haz clic en el botón de aquí abajo:')
            ->action('Restablecer Mi Contraseña', $url)
            ->line('Este enlace expirará en **' . $expire . ' minutos** por razones de seguridad.')
            ->line('Si **no** solicitaste este cambio, ignora este mensaje. Tu cuenta permanecerá segura.')
            ->line('---')
            ->salutation('Atentamente, el equipo de **UWorkFlow**');
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
