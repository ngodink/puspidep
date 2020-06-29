<?php

$domain = env('APP_DOMAIN');

return [

    'web' => $domain,

    'administration' => 'admin.'.$domain,

    'account' => 'akun.'.$domain,

];
