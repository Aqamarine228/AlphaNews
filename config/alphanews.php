<?php

return [
    /*
    |--------------------------------------------------------------------------
    | AlphaNews Models
    |--------------------------------------------------------------------------
    |
    | These are the models used by AlphaNews that will be used in panel.
    | If you want the AlphaNews models to be in a different namespace or
    | to have a different name, you can do it here.
    |
    */
    'models' => [
        'post' => \App\Models\Post::class,

        'post_category' => \App\Models\PostCategory::class,

        'tag' => \App\Models\Tag::class,

        'user' => \App\Models\User::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | AlphaNews Foreign Keys
    |--------------------------------------------------------------------------
    |
    | These are the foreign keys used by AlphaNews in the intermediate tables.
    |
    */
    'foreign_keys' => [
        // User foreign key on AlphaNews's posts table.
        'user' => 'author_id',

        // Post foreign key on AlphaNews's post_tag table.
        'post' => 'post_id',

        // Tag foreign key on AlphaNews's post_tag table.
        'tag' => 'tag_id',

        // PostCategory foreign key on AlphaNews's post_tag table.
        'post_category' => 'post_category_id',

        // PostCategory foreign key on AlphaNews's post_categories table
        'post_category_parent' => 'parent_category_id',
    ],

    /*
    |--------------------------------------------------------------------------
    | AlphaNews Routes
    |--------------------------------------------------------------------------
    |
    | Section to manage everything related with the admin panel routes.
    |
    */

    'routes' => [
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
