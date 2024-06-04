<?php

return [
    'restore' => [
        'info' => [
            'h2'=> 'Restore password',
            'msg' => 'A message with a link to restore password has been sent to the email address you provided.',
        ],
        'success' => [
            'msg' => 'Your password has been successfully changed.',
            'link' => [
                'href' => path('auth', ['action' => 'showForm']),
                'title' => 'Welcome to Sign In!',
            ],
        ],
        'whoops' => [
            'h2' => 'Whoops...',
            'msg' => 'Confirmation code does not match or the link is out of date. Please repeat the',
            'link' => [
                'href' => path('restore.password', ['action' => 'showForm']),
                'title' => 'password change',
            ],
        ],
    ],
    'password' => [
        'success' => [
            'h2' => 'Congratulations!',
            'msg' => 'Your password has been successfully changed.',
            'link' => [
                'href' => path('auth', ['action' => 'showForm']),
                'title' => 'Welcome to Sign In!',
            ],
        ],
    ],
    'register' => [
        'info' => [
            'h2' => 'Register confirmation',
            'msg' => 'A message with a link to complete the registration has been sent to the email address you provided.',
        ],
        'success' => [
            'h2' => 'Congratulations!',
            'msg' => 'You have successfully registered!',
            'link' => [
                'href' => path('auth', ['action' => 'showForm']),
                'title' => 'Welcome to Sign In!',
            ],
        ],
        'whoops' => [
            'h2' => 'Whoops...',
            'msg' => 'Confirmation code does not match or the link is out of date. Please repeat the',
            'link' => [
                'href' => path('register', ['action' => 'showForm']),
                'title' => 'registration',
            ],
        ],
    ],
];
