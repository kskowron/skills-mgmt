<?php
return [
    'components' => [
        'name'=>'Skills-mgmt',
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\UserOutlook',
            'enableAutoLogin' => true,
        ],
    ],
];
