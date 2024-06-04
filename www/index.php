<?php

$GLOBALS['_start'] = hrtime(true);
$GLOBALS['_ram'] = memory_get_usage();

define('DOCROOT', './');
define('ROOTPATH', '../');
define('SYSPATH', ROOTPATH);
define('APPPATH', ROOTPATH . 'application/');
define('STORAGE', ROOTPATH . 'storage/');
define('CONFIG', APPPATH . 'common/config/');
define('ENVPATH', ROOTPATH);

if (!empty(getenv('TZ'))) {
    date_default_timezone_set(getenv('TZ'));
}   

require_once SYSPATH . 'vendor/autoload.php';
require_once SYSPATH . 'vendor/az/sys/src/autoload.php';
require_once SYSPATH . 'vendor/az/sys/src/library.php';
require_once CONFIG . 'bootstrap.php';

$mode = getMode(CONFIG . 'mode.php');

$container = (new Sys\ContainerFactory($mode))->create(new DI\ContainerBuilder());
$app = $container->get(Sys\App::class);
$app->run();
