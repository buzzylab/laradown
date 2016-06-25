<?php

namespace Buzzylab\Laradown\Facades;

use Illuminate\Support\Facades\Facade;

class MarkdownFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'markdown';
    }
}