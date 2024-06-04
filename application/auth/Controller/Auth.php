<?php

namespace Auth\Controller;

use Auth\Model\TokenAuth;
use HttpSoft\Response\RedirectResponse;
use Az\Route\Route;
use Auth\Middleware\AuthGuardMiddleware;
use Auth\Middleware\AuthValidation;
use Auth\Middleware\GuestGuardMiddleware;
use Sys\Form\Form;

final class Auth extends AuthAbstract
{
    public function showForm(Form $form)
    {
        $ref = $this->setReferer();

        if ($this->user !== null) {
            return new RedirectResponse($ref);
        }

        $form->title('Sign in to your account');
        $form->form('@auth/auth')
            ->action(path('auth', ['action' => 'login']))
            ->id('authform');

        $form->text('email');
        $form->password();
        $form->checkbox('remember')
            ->label('Remember me')->checked(true);

        return view('@auth/form_wrapper', ['form' => $form]);
    }

    #[Route(methods: 'post', pipe: AuthValidation::class)]
    public function login(TokenAuth $tokenAuth)
    {
        $user = $this->model->getUser();

        $this->session->remove('uid');
        $this->session->remove('code');
        $this->session->user_id = $user->id;
        $this->session->regenerate(true);

        $tokenAuth->remember('remember', $user->id);

        return new RedirectResponse($this->getReferer());
    }

    #[Route(unPipe: GuestGuardMiddleware::class, pipe: AuthGuardMiddleware::class)]
    public function logOut(TokenAuth $tokenAuth)
    {
        $this->session->destroy();
        $tokenAuth->forget($this->request->getCookieParams());
        $referer = $this->getReferer();
        $referer .= (parse_url($referer, PHP_URL_QUERY) ? '&' : '?') . 'redirect=1';
        
        return new RedirectResponse($referer);
    }
}
