<?php

namespace Auth\Component;

use Sys\Template\Component;
use Sys\Template\Template;

class Control extends Component
{
    private string $tplPath = APPPATH . 'auth/views/tw';
    private $sm;

    public function __construct(Template $tpl, $sm = false)
    {
        $tpl->getEngine()->getLoader()
            ->addPath(realpath($this->tplPath), 'auth');

        $this->sm = $sm;
    }

    public function render()
    {
        $view = ($this->sm) ? '@auth/control_sm' : '@auth/control';
        return view($view, ['menu' => config('control')]);
    }
}
