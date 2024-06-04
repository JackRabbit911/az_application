<?php

namespace Auth\Middleware;

use Auth\Model\ModelUser;
use Az\Validation\Validation;
use Az\Validation\Middleware\ValidationMiddleware;

final class ProfileValidation extends ValidationMiddleware
{
    private ModelUser $model;

    public function __construct(Validation $validation, ModelUser $model)
    {
        parent::__construct($validation);
        $this->model = $model;
    }

    protected function setRules($request)
    {
        $email = $request->getAttribute('user')->email;
        $newEmail = ':value';

        $path = APPPATH . 'auth/messages';
        
        $this->validation->addMsgPath($path)
            ->rule('name', 'required|username')
            ->rule('email', 'required|email')
            ->rule('email', [$this->model, 'isUniqueOrOwnEmail'], $email)
            ->rule('dob', 'validDate')
            ->rule('phone', 'phone')
            ->rule('sex', 'integer')
            ->rule('avatar', 'size(1M)|img');
    }

    protected function modifyData($data)
    {
        if (empty($data['phone'])) {
            $data['phone'] = null;
        }

        if (isset($data['phone'])) {
            $data['phone'] = preg_replace('/\D+/', '', $data['phone']);
        };

        if ($data['dob'] === '') {
            $data['dob'] = null;
        };

        return $data;
    }

    protected function debug()
    {
        // dd($data, $this->validation->getResponse());
    }
}
