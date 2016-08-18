<?php

namespace Buzzylab\Laradown;

use ParsedownExtra;

class Laradown
{
    /**
     * @var ParsedownExtra
     */
    protected $markdown;

    /**
     * Indicator for markdown collect block
     *
     * @var bool
     */
    protected $collect_indicator = false;

    /**
     * Laradown constructor.
     *
     * @param ParsedownExtra $markdown
     */
    public function __construct(ParsedownExtra $markdown)
    {
        $this->markdown = $markdown;
    }

    /**
     * Convert markdown to html
     *
     * @param $markdown
     *
     * @return mixed|string
     */
    public function convert($markdown)
    {
        return $this->markdown->text($markdown);
    }

    /**
     * Start collect markdown block
     */
    public function collect()
    {
        // Make indicator true
        $this->collect_indicator = true ;

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
     * Check collect block started
     *
     * @throws \Exception
     */
    protected function checkCollectBlockStarted()
    {
        if ($this->collect_indicator === false) {
            throw new \Exception("@markdown is missing.");
        }
    }
}