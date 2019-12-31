<?php

namespace Buzzylab\Laradown;

use Illuminate\Contracts\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use ParsedownExtra;

class Laradown extends ParsedownExtra
{
    /**
     * The IoC container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Indicator for markdown collect block.
     *
     * @var bool
     */
    protected $collect_indicator = false;

    /**
     * Laradown constructor.
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
    }

    /**
     * Set the IoC container instance.
     *
     * @param \Illuminate\Contracts\Container\Container $container
     *
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Get the IoC container instance or any of it's services.
     *
     * @param string|null $service
     *
     * @return object
     */
    public function getContainer($service = null)
    {
        return is_null($service) ? ($this->container ?: app()) : ($this->container[$service] ?: app($service));
    }

    /**
     * Handlers for all elements.
     *
     * @param array $Element
     *
     * @return string
     */
    protected function element(array $Element)
    {
        $markup = '';

        if (Str::is('h[1-6]', $Element['name'])) {
            $link = str_replace(' ', '-', strtolower($Element['text']));
            $markup = '<a  class="header-link" href="#'.$link.'" id="'.$link.'"><i class="glyphicon glyphicon-link"></i></a>';
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
        // Fire converting event
        $this->getContainer('events')->dispatch('laradown.entity.converting');

        $text = $this->text($markdown);

        // Fire converted event
        $this->getContainer('events')->dispatch('laradown.entity.converted');

        return $text;
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
        // Fire collecting event
        $this->getContainer('events')->dispatch('laradown.entity.collecting');

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

        // Fire collected event
        $this->getContainer('events')->dispatch('laradown.entity.collected');

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
        if ($this->filesystem->exists($file)) {
            $content = $this->filesystem->get($file);
        }

        // Finally return style
        return "<style>{$content}</style>";
    }
}
