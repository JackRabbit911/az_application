<?php

namespace Auth\Controller;

use Auth\User;
use Az\Route\Route;
use Auth\Middleware\PasswordConfirmValidation;
use Sys\Form\Form;

final class ChangePassword extends AuthAbstract
{
    public function showForm(Form $form)
    {
        if ($this->session->uid || $this->session->user_id) {
            $form->title('Change password');
            $form->password()
                    ->placeholder('New password');
                $form->password('confirm')
                    ->placeholder('Confirm new password');

            if ($this->session->user_id) {
                $form->form('@auth/password')->id('passwordform')
                    ->action(path('profile.password', ['action' => 'save']));
            } else {
                $form->form('@auth/password')->id('passwordform')
                    ->action(path('restore.password', ['action' => 'save']));
            }

            return view('@auth/form_wrapper', ['form' => $form]);
        }

        return $this->whoops();
    }

    #[Route(methods: 'post', pipe: PasswordConfirmValidation::class)]
    public function save()
    {
        $id = $this->session->uid ?? $this->session->user_id;

        if (!$id) {
            return $this->whoops();
        }

        $user = $this->model->find($id);
        $user->password = password_hash($this->request->getParsedBody()['password'], PASSWORD_DEFAULT);

        $user->save();

        $data = config('messages', 'password.success');
        $data['view'] = 'success';

        return view('@auth/message_wrapper', $data);
    }

    private function whoops()
    {
        $data = config('messages', 'restore.whoops');
        $data['view'] = 'whoops';

        return view('@auth/message_wrapper', $data);
    }
}
