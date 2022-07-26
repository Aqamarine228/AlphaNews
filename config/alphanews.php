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

        'media_folder' => \App\Models\MediaFolder::class,

        'image' => \App\Models\Image::class
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

        // MediaFolder foreign key on AlphaNews's images, posts, media_folders tables.
        'media_folder' => 'media_folder_id',
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
         | AlphaNews Route Name Prefix
         |--------------------------------------------------------------------------
         |
         | This is the name prefix with which every name of admin panel route
         | will start.
         |
         */

        'route_name_prefix' => 'alphanews',
    ],

    /*
    |--------------------------------------------------------------------------
    | AlphaNews Media
    |--------------------------------------------------------------------------
    |
    | Section to manage everything related with media.
    |
    */

    'media' => [

        /*
        |--------------------------------------------------------------------------
        | AlphaNews Media
        |--------------------------------------------------------------------------
        |
        | Section to manage everything related with saving media in filesystem.
        |
        */

        'filesystem' => [

            /*
            |--------------------------------------------------------------------------
            | AlphaNews Media Filesystem Disk
            |--------------------------------------------------------------------------
            |
            | This is disk that will be used to store media.
            |
            */

            'disk' => 'public',

            /*
            |--------------------------------------------------------------------------
            | AlphaNews Media Filesystem Images Path
            |--------------------------------------------------------------------------
            |
            | Filesystem path in which images will be stored.
            |
            */

            'images_path' => 'images',
        ],

        /*
        |--------------------------------------------------------------------------
        | AlphaNews Media Folders
        |--------------------------------------------------------------------------
        |
        | These are media folder id's used for different post types.
        |
        */

        'folders' => [
            'news' => 1,
            'advertising' => 2,
        ]
    ],
];
