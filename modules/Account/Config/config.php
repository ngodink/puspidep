<?php

return [
    'name' => 'Akun '.config('app.name'),

    'register' => [
    	'allowed' => false,
    ],

    'admin' => [
    	'name' => 'Administrasi | Akun '.config('app.name'),
    	'breadcrumb' => 'Administrasi'
    ],

    'permission_module' => 'account',

    'root_role' => 1
];
