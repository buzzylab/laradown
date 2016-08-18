<?php

namespace Buzzylab\Laradown;

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
        $this->app->singleton('markdown', function () {
            $markdown = new Laradown();

            return $markdown;
        });
    }

    protected function registerBladeWidgets()
    {
        // Markdown Blade Directive
        Blade::directive('markdown', function ($value) {
            return "<?php echo Markdown::text($value); ?>";
        });
    }
}
