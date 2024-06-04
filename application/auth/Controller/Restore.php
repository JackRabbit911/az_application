<?php

namespace Auth\Controller;

use App\Listener\MailByData;
use Az\Route\Route;
use Auth\Middleware\EmailValidation;
use Sys\Form\Form;
use Sys\Middleware\ControllerAttribute;

final class Restore extends AuthAbstract
{
    public array $mailData;

    public function showForm(Form $form)
    {
        $form->title('Restore password');
        $form->form('@auth/email')->id('emailform')
            ->action(path('restore', ['action' => 'saveSessionSendMail']));

        $form->text('email')
            ->placeholder('Enter the email you provided');

        return view('@auth/form_wrapper', ['form' => $form]);
    }

    #[Route(methods: 'post', pipe: [
        EmailValidation::class, 
        ControllerAttribute::class])]
    #[MailByData]
    public function saveSessionSendMail()
    {
        $user = $this->model->getUser();
        
        $this->session->uid = $user->id;
        $this->session->code = bin2hex(random_bytes(16));

        $this->mailData = require $this->dataPath . 'restore_password_email.php';
        $this->mailData['email'] = $user->email;
        $this->mailData['name'] = $user->name;

        $data = config('messages', 'restore.info');
        $data['view'] = 'info';
        $data['user'] = $user->name;
        
        return view('@auth/message_wrapper', $data);
    }

    public function confirm($code)
    {
        if ($code === $this->session->get('code')) {
            return $this->redirect(path('restore.password', ['action' => 'showForm']));  
        }

        $data = config('messages', 'restore.whoops');
        $data['view'] = 'whoops';

        return view('@auth/message_wrapper', $data);
    }
}
