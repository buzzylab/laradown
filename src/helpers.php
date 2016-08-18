<?php

if(! function_exists('markdown')){

    /**
     * Markdown helper function
     *
     * @param $content
     * @return mixed
     */
    function markdown($content){
        return app('markdown')->text($content);
    }
}