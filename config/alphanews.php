<?php

return [
    /*
    |--------------------------------------------------------------------------
    | AlphaNews Panel
    |--------------------------------------------------------------------------
    |
    | Section to manage everything related with the admin panel.
    |
    */

    'panel' => [
        /*
        |--------------------------------------------------------------------------
        | AlphaNews Panel Register
        |--------------------------------------------------------------------------
        |
        | This manages if routes used for the admin panel should be registered.
        | Turn this value to false if you don't want to use AlphaNews admin panel
        |
        */

        'register' => false,

        /*
        |--------------------------------------------------------------------------
        | AlphaNews Panel Path
        |--------------------------------------------------------------------------
        |
        | This is the URI path where AlphaNews panel will be accessible from.
        |
        */

        'path' => 'alphanews',

        /*
        |--------------------------------------------------------------------------
        | AlphaNews Panel Route Middleware
        |--------------------------------------------------------------------------
        |
        | These middleware will get attached onto each AlphaNews panel route.
        |
        */

        'middleware' => ['web'],

        /*
         |--------------------------------------------------------------------------
         | AlphaNews Panel Route Middleware
         |--------------------------------------------------------------------------
         |
         | This is the name prefix with which every name of admin panel route
         | will start.
         |
         */

        'route_name_prefix' => 'alphanews',
    ],
];
