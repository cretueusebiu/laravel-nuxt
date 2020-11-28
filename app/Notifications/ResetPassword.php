<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line(__('You are receiving this email because we received a password reset request for your account.'))
            ->action(__('Reset Password'), $this->resetUrl($notifiable))
            ->line(__('If you did not request a password reset, no further action is required.'));
    }

    /**
     * Get the reset password URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function resetUrl($notifiable)
    {
        $appUrl = config('app.client_url', config('app.url'));

        return url("$appUrl/password/reset/$this->token").'?email='.urlencode($notifiable->email);
    }
}
