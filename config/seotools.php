<?php

return [
    'inertia' => env('SEO_TOOLS_INERTIA', false),

    'meta' => [
        'defaults' => [
            'title'       => false,
            'titleBefore' => false,
            'description' => false,
            'separator'   => ' - ',
            'keywords'    => [],
            'canonical'   => false,
            'robots'      => false,
        ],
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],
        'add_notranslate_class' => false,
    ],

    'opengraph' => [
        'defaults' => [
            'title'       => false,
            'description' => false,
            'url'         => false,
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],

    'twitter' => [
        'defaults' => [
            'card' => false,
            'site' => false,
        ],
    ],

    'json-ld' => [
        'defaults' => [
            'title'       => false,
            'description' => false,
            'url'         => false,
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];