<?php

return [
    'view_path' => [
        APPPATH . 'app/views/tw',
        APPPATH . 'app/views/bs',
        APPPATH . 'app/views',
        ],
    'options'   => [
        'strict_variables' => true,
        'debug' => (ENV > PRODUCTION) ? true : false,
    ],
    'ext' => 'twig',
];
