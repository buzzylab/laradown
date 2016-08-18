<?php

if (!function_exists('markdown')) {

    /**
     * Markdown helper function.
     *
     * @param $content
     *
     * @return mixed
     */
    function markdown($content)
    {
        return app('markdown')->text($content);
    }
}

if (!function_exists('markdown_style')) {

    /**
     * Load markdown style.
     *
     * @param null $file
     *
     * @return mixed
     */
    function markdown_style($file = null){
        return app('markdown')->loadStyle($file);
    }
}
