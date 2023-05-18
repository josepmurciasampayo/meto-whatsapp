<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Spatie\WelcomeNotification\WelcomeController as BaseWelcomeController;

class MetoWelcomeController extends BaseWelcomeController
{
    public function sendPasswordSavedResponse(): RedirectResponse
    {
        return redirect()->route('home');
    }

}
