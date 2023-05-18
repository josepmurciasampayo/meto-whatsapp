<?php

namespace App\Actions;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class MetoWelcomeNotification extends \Spatie\WelcomeNotification\WelcomeNotification
{
    public function buildWelcomeNotificationMessage(): MailMessage
    {
        return (new MailMessage)
            ->subject(Lang::get('Welcome to Meto'))
            ->line(Lang::get('You are receiving this email because an account was created for you and your database is ready.'))
            ->action(Lang::get('Set initial password'), $this->showWelcomeFormUrl)
            ->line(Lang::get('This welcome link will expire in :count hours.', ['count' => $this->validUntil->diffInRealHours()]));
    }
}
