<?php declare(strict_types=1);

namespace Auth\Component;

use Sys\Form\Form;

class ProfileForm extends Form
{
    public function __construct()
    {
        $this->title('Profile');
        $this->form('@auth/profile')
            // ->title('Profile')
            ->id('profileform')
            ->action(path('profile.save'));

        $this->text('name')->placeholder('Username');
        $this->text('email');
        $this->tel('phone');
        $this->date('dob')->label('Date of birth');
        $this->radio('sex');
        $this->file('avatar')
            ->label('Pick a file for avatar')
            ->extra(['label' => 'Up to 1M']);
    }
}
