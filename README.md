# AlphaNews (Laravel Package)

[![Tests](https://github.com/Aqamarine228/AlphaNews/workflows/Test/badge.svg)](https://github.com/Aqamarine228/AlphaNews/actions)
![GitHub](https://img.shields.io/github/license/aqamarine228/alphanews)
[![Latest Stable Version](http://poser.pugx.org/aqamarine/alphanews/v)](https://packagist.org/packages/aqamarine/alphanews)
[![Latest Unstable Version](http://poser.pugx.org/aqamarine/alphanews/v/unstable)](https://github.com/Aqamarine228/AlphaNews)

[//]: # ([![PHP Version Require]&#40;http://poser.pugx.org/aqamarine/alphanews/require/php&#41;]&#40;https://packagist.org/packages/aqamarine/alphanews&#41;)

[//]: # ([![Dependents]&#40;http://poser.pugx.org/aqamarine/alphanews/dependents&#41;]&#40;https://packagist.org/packages/aqamarine/alphanews&#41;)


Package used to easily and fast add news managing functionality to Laravel project

## Installation

Using the package manager [composer](https://getcomposer.org)

```bash
$ composer require aqamarine/alphanews
```

## Package Configuration

For package to work publishing assets and migrations is needed

### Publish Config (Optional)

```bash
php artisan vendor:publish --tag="alphanews-config"
```

### Publish Assets (Optionally publish all needed js and css plugins)

```bash
php artisan vendor:publish --tag="alphanews-assets"
```

## Module setup

For using this package create [module](https://github.com/nWidart/laravel-modules) first

```bash
php artisan module:make {module_name}
```

Then generate all needed files by running command bellow

```bash
php artisan alphanews:generate-all {module_name}
```

