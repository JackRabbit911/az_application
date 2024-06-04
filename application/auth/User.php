<?php

namespace Auth;

use Sys\Entity\Entity;
use Auth\Model\ModelUser;
use DateTime;
use Sys\Trait\FromArray;

#[ModelUser]
final class User extends Entity
{
    use FromArray;

    const FEMALE = 0;
    const MALE = 1;

    const AVATAR_SRC = 'src';
    const AVATAR_HTML = 'html';
    const AVATAR_NAME = 'name';
    const NO_AVATAR = '/no_avatar.jpg';

    private string $jsonProp = 'info';

    public function __construct()
    {
        if (isset($this->info)) {
            $this->info = json_decode($this->info, true);
        }
    }

    public function age(string $date = 'today')
    {
        if (!$this->dob) {
            return 0;
        }

        return (new DateTime($this->dob))->diff(new DateTime($date))->y;
    }

    public function prepareProps()
    {
        if (isset($this->info)) {
            $this->info = json_encode($this->info);
        }

        return $this;
    }

    public function avatar($res = self::AVATAR_SRC)
    {       
        $hash = md5(mb_strtolower($this->email));
        $file = config('upload', 'avatar') . $hash . '.jpg';

        if ($res === self::AVATAR_NAME) {
            return $file;
        }

        if (!is_file($file)) {
            $file = config('upload', 'avatar') . self::NO_AVATAR;
        } 
        
        $file = str_replace('//', '/', $file);
        $src = ltrim($file, '.');    

        return ($res === self::AVATAR_SRC) ? $src 
                : '<img src="' . $src . '" alt="' . $this->name . '" />';
    }
}
