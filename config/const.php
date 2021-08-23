<?php

$mode = env("APP_ENV") === 'local' ? 'sb' : 'lv';
return [
    'show_shop_menu' => env('SHOW_SHOP_MENU', true),
    'mode' => $mode,
    'token_ex' => [
        'mode' => $mode,
        'sb' => [
            'service_url' => 'https://test-api.tokenex.com/',
            'api_key' => 'GY37sTtGqshBFa5ZC03JmTRE4rwBxu7cPC3eeZdk',
            'id' => '3955061100833529'
        ],
        'lv' => [
            'service_url' => 'https://api.tokenex.com/',
            'api_key' => 'AHnRo2tZAoGG5HJFjuYPEnkZa51hogANGW4VH3f3',
            'id' => '4357543053584306'
        ]
    ],
    'nmi' => [
        'mode' => $mode,
        'sb' => [
            'username' => 'demo',
            'password' => 'password'
        ],
        'lv' => [
            'username' => 'bitjarapi2',
            'password' => '1EldmfcROI!'
        ]
    ],
    't1' => [
        'mode' => $mode,
        'sb' => [
            'username' => 'Rsacco',
            'password' => '1EldmfcROI!'
        ],
        'lv' => [
            'username' => 'Rsacco',
            'password' => '1EldmfcROI!'
        ]
    ],
    'payarc' => [
        'mode' => $mode,
        'sb' => [
            'username' => 'payIbuumerang',
            'password' => '1EldmfcROI!'
        ],
        'lv' => [
            'username' => 'payIbuumerang',
            'password' => '1EldmfcROI!'
        ]
    ],
    'metropolitan' => [
        'mode' => $mode,
        'sb' => [
            'username' => 'ibuumerang2020',
            'password' => 'iBuum123!!!'
        ],
        'lv' => [
            'username' => 'ibuumerang2020',
            'password' => 'iBuum123!!!'
        ]
    ],
    'kount' => [
        'mode' => $mode,
        'sb' => [
            'url' => 'https://risk.beta.kount.net/',
            'iframe_url' => 'https://tst.kaptcha.com/',
            'api_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI5OTk2NjYiLCJhdWQiOiJLb3VudC4xIiwiaWF0IjoxNDk0NTM0Nzk5LCJzY3AiOnsia2EiOm51bGwsImtjIjpudWxsLCJhcGkiOmZhbHNlLCJyaXMiOnRydWV9fQ.eMmumYFpIF-d1up_mfxA5_VXBI41NSrNVe9CyhBUGck',
            'merchant_id' => '999666'
        ],
        'lv' => [
            'url' => 'https://risk.kount.net/',
            'iframe_url' => 'https://ssl.kaptcha.com/',
            'api_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2MTYxMDciLCJhdWQiOiJLb3VudC4xIiwiaWF0IjoxNTUwOTQzNDQxLCJzY3AiOnsia2EiOm51bGwsImtjIjpudWxsLCJhcGkiOmZhbHNlLCJyaXMiOnRydWV9fQ.jVbi4AQibs3PE6U18PoS4zhezrcVYMXhVOwEz0O1XmA',
            'merchant_id' => '616107'
        ]
    ],
    'save_on' => [
        'mode' => $mode,
        'sb' => [
            'service_url' => 'https://api.saveonuat.com/',
            'level0' => [
                'club_name' => 'i Go 4 Less (Level 0)',
                'club_id' => '1213',
                'login' => 'iGo4Less0',
                'password' => 'bezp96o5y04oqj73',
            ],
            'level1' => [
                'club_name' => 'i Go 4 Less (Level 1)',
                'club_id' => '12709',
                'login' => 'iGo4less1',
                'password' => 'fwy18ytwmrs8ct1h',
            ],
            'level2' => [
                'club_name' => 'i Go 4 Less (Level 2)',
                'club_id' => '12710',
                'login' => 'iGo4less2',
                'password' => 'mi3q4uliwfrx6hg0',
            ],
            'level3' => [
                'club_name' => 'i Go 4 Less (Level 3)',
                'club_id' => '12711',
                'login' => 'iGo4less3',
                'password' => 'x9ydzxxhuvlh3bik',
            ],
            'boomerang' => [
                'club_name' => 'i Go 4 Less (Boomerang)',
                'club_id' => '12712',
                'login' => 'iGo4lessBoom',
                'password' => 'vyfqlewszsgd4f2v',
            ]
        ],
        'lv' => [
            'service_url' => 'https://api.saveonresorts.com/',
            'level0' => [
                'club_name' => 'i Go 4 Less (Level 0)',
                'club_id' => '12744',
                'login' => 'iGo4Less0',
                'password' => 'bezp96o5y04oqj73',
            ],
            'level1' => [
                'club_name' => 'i Go 4 Less (Level 1)',
                'club_id' => '12716',
                'login' => 'iGo4less1',
                'password' => 'fwy18ytwmrs8ct1h',
            ],
            'level2' => [
                'club_name' => 'i Go 4 Less (Level 2)',
                'club_id' => '12718',
                'login' => 'iGo4less2',
                'password' => 'mi3q4uliwfrx6hg0',
            ],
            'level3' => [
                'club_name' => 'i Go 4 Less (Level 3)',
                'club_id' => '12719',
                'login' => 'iGo4less3',
                'password' => 'x9ydzxxhuvlh3bik',
            ],
            'boomerang' => [
                'club_name' => 'i Go 4 Less (Boomerang)',
                'club_id' => '12715',
                'login' => 'iGo4lessBoom',
                'password' => 'vyfqlewszsgd4f2v',
            ]
        ]
    ],
    'idecide' => [
        'mode' => $mode,
        'service_url' => 'https://api.idecideinteractive.com/idecide/',
        'sb' => [
            'api_user' => 'ibuumerang',
            'api_key' => 'e30bf7c923bd46ab80a83'
        ],
        'lv' => [
            'api_user' => 'ibuumerang',
            'api_key' => 'e30bf7c923bd46ab80a83'
        ]
    ],
    'currency_code' => 'USD',
    'standby_price' => '49.95',
    'bitpay' => [
        'mode' => $mode,
        'server' => 'live',
        'sb' => [
            'url' => 'https://enrolldev.countdown4freedom.com'
        ],
        'lv' => [
            'url' => 'https://join.ibuumerang.com'
        ]
    ],
    'ipayout' => [
        'mode' => $mode,
        'sb' => [
            'MerchantGUID' => '4a812785-50bd-481f-86ae-3b086430a946',
            'MerchantPassword' => '7uKy7ABm25'  ,
            'eWalletAPIURL' => 'https://testewallet.com/eWalletWS/ws_JsonAdapter.aspx',
            'eWalletMerchantURL' => 'https://ibuumerang.testewallet.com',
            'eWalletCheckoutThankYouPageURL' => 'http://myibuumerang.com/thank-you',
        ],
        'lv' => [
            'MerchantGUID' => '4a812785-50bd-481f-86ae-3b086430a946',
            'MerchantPassword' => 'bYYwDaDuvL',
            'eWalletAPIURL' => 'https://www.i-payout.net/eWalletWS/ws_JsonAdapter.aspx',
            'eWalletMerchantURL' => 'https://ibuumerang.globalewallet.com',
            'eWalletCheckoutThankYouPageURL' => 'http://myibuumerang.com/thank-you',
        ],
    ],
    
];
