<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InviteFriendButton extends Component
{
    public $href;
    public $icon;
    public $text;
    public $inviteText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($href = '#', $icon = null, $text = 'Invite Friends', $inviteText = null)
    {
        $this->href = $href;
        $this->icon = $icon;
        $this->text = $text;
        $this->inviteText = $inviteText ?? 'Abraham is inviting you to join them on Meto. Get started here: www.web.meto-intl.org.';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.invite-friend-button');
    }
}
