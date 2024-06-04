<?php

use Az\Route\Middleware\RouteMatchMiddleware;
use Az\Route\Middleware\RouteMiddleware;
use Az\Route\Middleware\RouteDispatchMiddleware;
use Sys\Middleware\ControllerAttribute;
use Sys\Middleware\ControllerAttributeMiddleware;
use Sys\Template\Middleware\WebTemplateGlobals;

$this->pipe(RouteMatchMiddleware::class);
$this->pipe(RouteMiddleware::class);
// $this->pipe(ControllerAttributeMiddleware::class);
// $this->pipe(ControllerAttribute::class);

if (getMode() === 'web') {
    $this->pipe(WebTemplateGlobals::class);
}

$this->pipe(RouteDispatchMiddleware::class);
