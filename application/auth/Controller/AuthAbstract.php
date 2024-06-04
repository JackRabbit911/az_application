<?php

namespace Auth\Controller;

use Auth\Model\ModelUser;
use DI\Attribute\Inject;
use Sys\Controller\WebController;

abstract class AuthAbstract extends WebController
{
    #[Inject]
    protected ModelUser $model;

    protected string $msgFile = APPPATH . 'auth/messages/data.php';
    protected string $tplPath = APPPATH . 'auth/views/tw';
    protected string $dataPath = APPPATH . 'auth/messages/data/';

    protected function setReferer()
    {
        $ref = $this->session->ref;

        if ($ref) {
            return ($ref == url()) ? url('home') : $ref;
        }

        $ref = $this->request->getServerParams()['HTTP_REFERER'] ?? url('home');
        $this->session->ref = $ref;

        return $ref;
    }

    protected function getReferer()
    {
        $home = url('home');
        $default = $this->request->getServerParams()['HTTP_REFERER'] ?? $home;     
        $ref = $this->session->pull('ref', $default);

        return ($ref == url()) ? $home : $ref;
    }

    protected function _before()
    {
        $this->tpl->getEngine()
            ->getLoader()
            ->addPath(realpath($this->tplPath), 'auth');
    }
}
