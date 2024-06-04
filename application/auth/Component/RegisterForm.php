<?php declare(strict_types=1);

namespace Auth\Component;

use Sys\Form\Form;

class RegisterForm extends Form
{
    public function __construct()
    {
        $this->title('Register');
        $this->form('@auth/register')
            ->id('registerform')
            ->action(path('register', ['action' => 'saveSessionSendMail']));

        $this->text('name')->placeholder('Username');
        $this->text('email');
        $this->password();
        $this->password('confirm')->placeholder('Confirm password');
        $this->checkbox('agree')->checked(true)
            ->label(view('@auth/agree_label'));
    }
}
