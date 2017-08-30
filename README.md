Laradown
--------


[![Latest Stable Version](https://poser.pugx.org/buzzylab/laradown/version)](https://packagist.org/packages/buzzylab/laradown)
[![Total Downloads](https://poser.pugx.org/buzzylab/laradown/downloads)](https://packagist.org/packages/buzzylab/laradown)
[![Latest Unstable Version](https://poser.pugx.org/buzzylab/laradown/v/unstable)](//packagist.org/packages/buzzylab/laradown)
[![License](https://poser.pugx.org/buzzylab/laradown/license)](https://packagist.org/packages/buzzylab/laradown)
[![StyleCI](https://styleci.io/repos/61923982/shield)](https://styleci.io/repos/61923982)

A New `Markdown` parser for Laravel built on [Parsedown](https://github.com/erusev/parsedown) and [Parsedown Extra](https://github.com/erusev/parsedown-extra).

## Installation

The best and easiest way to install this package is through [Composer](https://getcomposer.org/).


### Compatibility

This package fully compatible with **[Laravel](https://laravel.com)** `5.1.*|5.2.*|5.3.*|5.4.*|5.5.x`.

### Require Package

Open your application's `composer.json` file and add the following line to the `require` array:
```json
"buzzylab/laradown": "0.1.*"
```

> **Note:** Make sure that after the required changes your `composer.json` file is valid by running `composer validate`.

After installing the package, open your Laravel config file located at `config/app.php` and add the following service provider to the `$providers` array:
```php
Buzzylab\Laradown\MarkdownServiceProvider::class,
```

> **Note:** Checkout Laravel's [Service Providers](https://laravel.com/docs/5.5/providers) and [Service Container](https://laravel.com/docs/5.5/container) documentation for further details.

And add the following to `$aliases`

```php
'Markdown' => Buzzylab\Laradown\Facades\MarkdownFacade::class
```


## Usage

```php
<?php

echo Markdown::render(); // OR echo Markdown::convert();
```
That's all.


## Blade Directive:

### Use `@markdown` directive with parameter:

```php
@extends('layouts.master')

@section('content')
<div>
    
  {{-- $content is markdown data --}}
  @markdown($content)
</div>
@stop
```

### Use `@markdown` with `@endmarkdown` as directive block:

```php
@extends('layouts.master')

@section('content')
<div>
  @markdown
  
  # Laradown Packag
  
  @endmarkdown
</div>
@stop
```

### Add style to your converted html with `@markdownstyle`

```php
    {{-- Get defaute style file --}}
    @markdownstyle
    
    {{-- Custom style file --}}
    @markdownstyle($file)
```
## Helper Functions:

### `markdown($markdown)`
Convert markdown content to html

### `markdown_style()`
Add style to converted html

## License

This software is released under [The MIT License (MIT)](LICENSE).
