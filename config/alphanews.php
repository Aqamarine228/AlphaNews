<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AlphaNews Default Language
    |--------------------------------------------------------------------------
    |
    | Sets default language to be used inside managing panel, language code needs to be set.
    |
    */

    'default_language' => 'en',

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
        | AlphaNews Media Filesystem
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

            /*
            |--------------------------------------------------------------------------
            | AlphaNews Media Folder News
            |--------------------------------------------------------------------------
            |
            | ID of Media Folder in which media related to news will be stored.
            |
            */
            'news' => 1,

            /*
            |--------------------------------------------------------------------------
            | AlphaNews Media Folder Advertising
            |--------------------------------------------------------------------------
            |
            | ID of Media Folder in which media related to advertising will be stored.
            |
            */
            'advertising' => 2,
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | AlphaNews Posts
    |--------------------------------------------------------------------------
    |
    | Section to manage everything related with posts.
    |
    */

    'posts' => [

        /*
        |--------------------------------------------------------------------------
        | AlphaNews Preview Images Height
        |--------------------------------------------------------------------------
        |
        | Height of posts preview image.
        |
        */

        'preview_images_height' => 720,
    ],
];
