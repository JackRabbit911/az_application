<?php

return [
    'title' => 'Sign In',
    'href' => path('auth', ['action' => 'showForm']),
    'sub' => [
        [
            'title' => 'Profile',
            'href' => path('profile', ['action' => 'showForm']),
        ],
        [
            'title' => 'Logout',
            'href' => path('auth', ['action' => 'logout']),
            'border' => true,
        ],
    ],
];
