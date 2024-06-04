<?php

namespace Auth\Controller;

use App\Listener\MailByData;
use Auth\Component\RegisterForm;
use Auth\User;
use Az\Route\Route;
use Auth\Middleware\RegisterValidation;
use Sys\Middleware\ControllerAttribute;

final class Register extends AuthAbstract
{
    public $mailData;

    public function showForm(RegisterForm $form)
    {
        return view('@auth/form_wrapper', ['form' => $form]);
    }

    #[Route(methods: 'post', pipe: [
        RegisterValidation::class, 
        ControllerAttribute::class])]
    #[MailByData]
    public function saveSessionSendMail()
    {
        $userdata = $this->request->getParsedBody();
        $this->session->set('userdata', $userdata);
        $this->session->set('code', bin2hex(random_bytes(16)));

        $path = APPPATH . 'auth/messages/data/';
        $this->mailData = require $path . 'register_confirm_mail.php';

        $data = config('messages', 'register.info');
        $data['view'] = 'info';
        $data['user'] = $userdata['name'];
        
        return view('@auth/message_wrapper', $data);
    }

    public function confirmSave($code)
    {
        if ($code === $this->session->get('code')) {
            $userdata = $this->session->pull('userdata');
            $userdata['password'] = password_hash($userdata['password'], PASSWORD_DEFAULT);
            User::fromArray($userdata)->save();
            $data = config('messages', 'register.success');
            $data['view'] = 'success';
        } else {
            $data = config('messages', 'register.whoops');
            $data['view'] = 'whoops';
        }

        $this->session->delete('code');
        $this->session->regenerate(true);

        return view('@auth/message_wrapper', $data);
    }
}
