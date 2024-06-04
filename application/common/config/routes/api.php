<?php

use Sys\Console\Controller as ConsoleController;
use App\Http\Controller\Api;

$this->route->post('/api/console/{model}/{method}', ConsoleController::class)
    ->tokens(['model' => '[\w\/]+'])
    ->filter(function ($route) {
        $params = $route->getParameters();
        $model = str_replace('/', '\\', $params['model']);

        if (method_exists($model, $params['method'])) {
            return true;
        }

        return false;
});

$this->route->controller('api/{action?}/{param?}', Api::class);
