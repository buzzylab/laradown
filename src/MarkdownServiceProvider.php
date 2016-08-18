<?php

namespace Buzzylab\Laradown;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use ParsedownExtra;

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
            $parsedown = new ParsedownExtra();

            return new Laradown($parsedown);
        });
    }

    protected function registerBladeWidgets()
    {
        // Markdown Start Blade Directive
        Blade::directive('markdown', function ($markdown) {
            if (!is_null($markdown)) {
                return "<?php echo Laradown::convert{$markdown}; ?>";
            }

            return '<?php Markdown::collect() ?>';
        });

        // Markdown End Blade Directive
        Blade::directive('endmarkdown', function () {
            return '<?php echo Laradown::endCollect() ?>';
        });
    }
}
