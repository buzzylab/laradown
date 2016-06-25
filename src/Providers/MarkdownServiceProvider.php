<?php

namespace Buzzylab\Laradown\Providers;

use Parsedown;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MarkdownServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->registerBladeWidgets();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('markdown', function() {

            $markdown = new Parsedown();

            return $markdown;
        });
    }


    protected function registerBladeWidgets()
    {
        // Markdown Blade Directive
        Blade::directive('markdown', function($value)
        {
            return "<?php echo Markdown::text($value); ?>";
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['markdown'];
    }
}