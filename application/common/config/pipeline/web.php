<?php

use Az\Session\SessionGuardMiddleware;
use Az\Session\SessionMiddleware;
use Sys\I18n\I18nMiddleware;

$this->pipe(SessionMiddleware::class);
// $this->pipe(SessionGuardMiddleware::class);
// $this->pipe(I18nMiddleware::class);
