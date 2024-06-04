<?php

return [
    [
        'title' => 'Item',
        'href' => path('home', ['action' => 'item']),
        'sub' => [
            [
                'title' => 'SubItem 1',
                'href' => path('home', ['action' => 'item', 'param' => 'i1']),
            ],
            [
                'title' => 'SubItem 2',
                'href' => path('home', ['action' => 'item', 'param' => 'i2']),
            ],
            [
                'title' => 'SubItem3',
                'href' => path('home', ['action' => 'item', 'param' => 'i3']),
                'border' => true,
            ],
        ],
    ],
    [
        'title' => 'Search',
        'href' => path('home', ['action' => 'search']),
    ],
    [
        'title' => 'News',
        'href' => path('home', ['action' => 'news']),
    ],
    [
        'title' => 'About Us',
        'href' => path('home', ['action' => 'about']),
    ],
];
