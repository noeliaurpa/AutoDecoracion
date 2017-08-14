<?php
return [
    'driver' =>  'smtp',
    'host' => env('MAIL_HOST', 'smtp.gmail.com'),
    'port' => env('MAIL_PORT', 587),
    'from' => ['address' => 'noeurpa1114@gmail.com', 'name' => 'Autodecoración Palmares'],
    'encryption' => 'tls',
    'username' => env('MAIL_USERNAME', 'noeurpa1114@gmail.com'),
    'password' => env('MAIL_PASSWORD','Noelia111495'),
    'sendmail' => '/usr/sbin/sendmail -bs',
];
