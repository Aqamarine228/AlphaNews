# AlphaNews (Laravel Package)

[![Tests](https://github.com/Aqamarine228/AlphaNews/workflows/Test/badge.svg)](https://github.com/Aqamarine228/AlphaNews/actions)
![GitHub](https://img.shields.io/github/license/aqamarine228/alphanews)
[![Latest Stable Version](http://poser.pugx.org/aqamarine/alphanews/v)](https://packagist.org/packages/aqamarine/alphanews)
[![Latest Unstable Version](http://poser.pugx.org/aqamarine/alphanews/v/unstable)](https://github.com/Aqamarine228/AlphaNews)

[//]: # ([![PHP Version Require]&#40;http://poser.pugx.org/aqamarine/alphanews/require/php&#41;]&#40;https://packagist.org/packages/aqamarine/alphanews&#41;)

[//]: # ([![Dependents]&#40;http://poser.pugx.org/aqamarine/alphanews/dependents&#41;]&#40;https://packagist.org/packages/aqamarine/alphanews&#41;)


Package used to easily and fast add news managing functionality to Laravel project

## Installation

Using the package manager [composer](https://getcomposer.org).

```bash
$ composer require aqamarine/alphanews
```

## Package Configuration

For package to work publishing assets and migrations is needed

### Publish Assets

```bash
$ php artisan vendor:publish --tag="alphanews-assets"
```

### Publish Migrations

```bash
$ php artisan vendor:publish --tag="alphanews-migrations"
```

### Publish Config (Optional)

```bash
$ php artisan vendor:publish --tag="alphanews-config"
```

## Package Configuration (Module setup)

For using this package as ['nWidart/laravel-modules'](https://github.com/nWidart/laravel-modules) module, install this
package first

```bash
$ composer require nWidart/laravel-modules
```

Next you are planing to use this package only as a Laravel module you need to
change package 'ServiceProvider' to 'OnlyCommandsServiceProvider' in app config file

#### Make sure default package ServiceProvider is commented out

```php
//config/app.php

'providers' => [

    /**
    * Package Service Providers...
    */
    Aqamarine\AlphaNews\OnlyCommandsServiceProvider::class,
//    Aqamarine\AlphaNews\ServiceProvider::class,

    
];
```

Next run 'CreateAlphaNewsModuleCommand' command

```bash
$ php artisan alphanews:create-module
```

## Models Configuration

For package to work you need to specify models path in config

```php
//config/alphanews.php

'models' => [
        'post' => \App\Models\Post::class,

        'post_category' => \App\Models\PostCategory::class,

        'tag' => \App\Models\PostTag::class,

        'user' => \App\Models\User::class,

        'media_folder' => \App\Models\MediaFolder::class,

        'image' => \App\Models\Image::class
]
```

Models required by package should use traits provided by package

```php
//.../Models/Image.php

class Image extends Model
{
    use AlphaNewsoImageTrait;
}

//.../Models/PostCategory.php

class PostCategory extends Model
{
    use AlphaNewsPostCategoryTrait;
}

//.../Models/Post.php

class Post extends Model
{
    use AlphaNewsPostTrait;
}

//.../Models/Tag.php

class Tag extends Model
{
    use AlphaNewsTagTrait;
}

//.../Models/MediaFolder.php

class MediaFolder extends Model
{
   use AlphaNewsMediaFolderTrait;
}
```

## Routes Configuration

Some routes require user model from that initiated request, so by default 'web' and 'auth:web' middlewares are set. You
can change
this behaviour in package config, but package still require '$request->user()' to be set

```php
//config/alphanews.php
'routes' => [
    'middleware' => ['web', 'auth:web'],
]
```


