<?php
return [
    'AppName' => 'Hackathon duel platform', 
    'GameName' => 'Battleship',
    'app_info' => [
        'app_name' => 'Hackathon_Presenter',
        'author' => 'TienTN',
        'version' => '1.0'
    ],
    'game_session' => [
        'id' => 'bot1_bot2_id',
        'admin' => 'tientn@evolableasia.vn'
    ],
    'game_logic' => [
        'presenter' => [
            'ais' => [
                'bot1' => 'bot1',
                'bot2' => 'bot2',
            ],
            'init' => [
                'url' => 'http://gameengine:5000/init'
                // 'url' => 'http://laravel.dev/api/gamelogic/init'
            ],
            'round' => [
                'url' => 'http://gameengine:5000/round'
                // 'url' => 'http://laravel.dev/api/gamelogic/round'
            ]
        ]
    ]
];
