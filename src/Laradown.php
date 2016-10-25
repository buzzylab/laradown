<?php

namespace Buzzylab\Laradown;

use ParsedownExtra;

class Laradown extends ParsedownExtra
{
    /**
     * @var
     */
    protected $files;

    /**
     * Indicator for markdown collect block.
     *
     * @var bool
     */
    protected $collect_indicator = false;

    /**
     * Laradown constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->files = app('files');
    }

    protected function element(array $Element)
    {
        $markup = '';

        if(str_is('h*' , $Element['name'])){
            $link = str_replace(' ', '-', strtolower($Element['text']));
            $markup = '<a target="_self" href="#' .$link.'"><i class="fa fa-link"></i>Link</a>';
        }

        $markup .= parent::element($Element);

        return $markup;
    }

    /**
     * Convert markdown to html.
     *
     * @param $markdown
     *
     * @return mixed|string
     */
    public function convert($markdown)
    {
        return $this->text($markdown);
    }

    /**
     * Convert markdown to html.
     *
     * @param $markdown
     *
     * @return mixed|string
     */
    public function render($markdown)
    {
        return $this->convert($markdown);
    }

    /**
     * Start collect markdown block.
     */
    public function collect()
    {
        // Make indicator true
        $this->collect_indicator = true;

        // Start collect
        ob_start();
    }

    public function endCollect()
    {
        // Check if collect block start is not missing
        $this->checkCollectBlockStarted();

        // End the indicator
        $this->collect_indicator = false;

        // Get the markdown content from block
        $markdown = ob_get_clean();

        // Convert the markdown content to html
        return $this->convert($markdown);
    }

    /**
     * Check collect block started.
     *
     * @throws \Exception
     */
    protected function checkCollectBlockStarted()
    {
        if ($this->collect_indicator === false) {
            throw new \Exception('@markdown is missing.');
        }
    }

    /**
     * Get style.
     *
     * @param null $file
     *
     * @return string
     */
    public function loadStyle($file = null)
    {
        // init required vars
        $content = '';

        // Get style file or get default
        if (is_null($file)) {
            $file = __DIR__.'/../public/github.css';
        }

        // check if style file exists
        if ($this->files->exists($file)) {
            $content = $this->files->get($file);
        }

        // Finally return style
        return "<style>{$content}</style>";
    }
}
