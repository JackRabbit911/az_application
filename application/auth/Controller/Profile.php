<?php

namespace Auth\Controller;

use Auth\Component\ProfileForm;
use Auth\User;
use Modules\Image\Im;
use Sys\Template\ComponentForm;

final class Profile extends AuthAbstract
{
    use ComponentForm;

    private string $view = '@auth/profile';

    public function showForm(ProfileForm $form)
    {
        $this->setReferer();
        // dd($form->title);
        return $form->render($this->user);
        // $data = config('profile');
        // return $this->_render($data, $this->user);
    }

    public function save()
    {
        $this->user->update($this->request->getParsedBody())->save();
        $this->saveAvatar();

        return $this->redirect($this->getReferer());
    }

    private function saveAvatar()
    {
        $file = $this->request->getUploadedFiles()['avatar'];

        if ($file->getError() !== UPLOAD_ERR_OK) {
            return;
        }

        $avatarPath = $this->user->avatar(User::AVATAR_NAME);
        $file->moveTo($avatarPath);

        chmod($avatarPath, 0666);
        
        $im = new Im($avatarPath);
        $im->crop(300)->thumb(80)->save();
    }
}
