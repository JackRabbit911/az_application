<?php

namespace Modules\Guide;

use Sys\Template\Template;
use Parsedown;
use Sys\Config\Config;
use Sys\Controller\WebController;
use Sys\Exception\ExceptionResponseFactory;
use Sys\Helper\ResponseType;

class GuideController extends WebController
{
    private ExceptionResponseFactory $factory;
    private string $dataPath = APPPATH . 'modules/Guide/data/';
    private string $tplPath = APPPATH . 'modules/Guide/views';

    public function __construct(Template $tpl, ExceptionResponseFactory $factory)
    {
        $tpl->getEngine()->getLoader()
            ->prependPath(realpath($this->tplPath), 'guide');

        $this->factory = $factory;
    }

    public function __invoke(Parsedown $parser, $part = null, $file = null)
    {
        $part = ($part) ? $part . '/' : '';
        $file = ($file) ? $file : 'index.md';
        $file = $this->dataPath . $part . $file;

        if (!is_file($file)) {
            return $this->factory->createResponse(ResponseType::html, 404);
        }

        $content = $parser->text(file_get_contents($file));

        return view('@guide/guide', ['content' => $content]);
    }
}
