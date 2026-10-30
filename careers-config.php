<?php
declare(strict_types=1);

// Recruitment settings are separate from the education portal.
return [
    'recipient' => 'lkconfiance@gmail.com',
    'sender' => 'no-reply@confiance.lk',
    'roles' => [
        'japanese-teacher' => 'Japanese Language Teacher',
        'general' => 'General application',
    ],
    'max_cv_bytes' => 5 * 1024 * 1024,
    'minimum_form_age' => 3,
    'minimum_interval' => 60,
    'hourly_limit' => 5,
];
