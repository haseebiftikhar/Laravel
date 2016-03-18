<?php

return [


    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'from' => array('address' => '******@******.com', 'name' => 'Application'),
    'encryption' => 'tls',
    'username' => '******@******.com',
    'password' => 'PAS*****',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,

];
