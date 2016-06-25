# Laradown #

[![Latest Stable Version](https://poser.pugx.org/buzzylab/laradown/version)](https://packagist.org/packages/buzzylab/laradown)
[![Total Downloads](https://poser.pugx.org/buzzylab/laradown/downloads)](https://packagist.org/packages/buzzylab/laradown)
[![Latest Unstable Version](https://poser.pugx.org/buzzylab/laradown/v/unstable)](//packagist.org/packages/buzzylab/laradown)
[![License](https://poser.pugx.org/buzzylab/laradown/license)](https://packagist.org/packages/buzzylab/laradown)


A New `Markdown` parser for Laravel built on [parsedown](https://github.com/erusev/parsedown).

### Installation

The best and easiest way to install this package is through [Composer](https://getcomposer.org/).


### Compatibility

This package fully compatible with **[Laravel](https://laravel.com)** `5.2.*`.

### Require Package

Open your application's `composer.json` file and add the following line to the `require` array:
```json
"buzzylab/laradown": "dev-master"
```

> **Note:** Make sure that after the required changes your `composer.json` file is valid by running `composer validate`.

After installing the package, open your Laravel config file located at `config/app.php` and add the following service provider to the `$providers` array:
```php
Buzzylab\Laradown\Providers\MarkdownServiceProvider::class,
```

> **Note:** Checkout Laravel's [Service Providers](https://laravel.com/docs/5.2/providers) and [Service Container](https://laravel.com/docs/5.2/container) documentation for further details.

And add the following to `$aliases`

```php
'Markdown' => Buzzylab\Laradown\Facades\MarkdownFacade::class
```


### Usage

```php
@extends('layouts.master')

@section('content')
<div>
  {!! Markdown::render($content) !!}
</div>
@stop
```

And you can use `@markdown` directive

```php
@extends('layouts.master')

@section('content')
<div>
  @markdown($content)
</div>
@stop
```

## License

This software is released under [The MIT License (MIT)](LICENSE).