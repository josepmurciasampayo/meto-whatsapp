<?php

namespace App\Actions;

use App\Models\Institution;
use Carbon\CarbonInterface;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Spatie\WelcomeNotification\WelcomeNotification;

class MetoWelcomeNotification extends WelcomeNotification
{
    public Institution $uni;

    public function __construct(CarbonInterface $validUntil, Institution $uni)
    {
        parent::__construct($validUntil);
        $this->uni = $uni;
    }

    public function buildWelcomeNotificationMessage(): MailMessage
    {
        return (new MailMessage)
            ->subject(Lang::get('Welcome to Meto'))
            ->line(Lang::get('Your Meto account has been created for :uni. Get started by logging in below to access the database and connect with students.', ['uni' => $this->uni->name]))
            ->action(Lang::get('Set initial password'), $this->showWelcomeFormUrl)
            ->line(Lang::get('Please note, your current account allows you to connect with :count students. If you would like to connect with more students, please initiate an account upgrade request by clicking "Increase Connections" on your database homepage', ['count' => $this->uni->connections]))
            ->line(Lang::get('This welcome link will expire in :count hours.', ['count' => $this->validUntil->diffInRealHours()]))
            ->line(Lang::get('If this link expires, please contact us by reply email.'));
    }
}
