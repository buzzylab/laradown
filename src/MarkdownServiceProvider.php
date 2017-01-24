<?php

namespace Buzzylab\Laradown;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MarkdownServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register blade directive widgets
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
            $filesystem = new Filesystem();

            return new Laradown($filesystem);
        });
    }

    protected function registerBladeWidgets()
    {
        // Markdown Style Blade Directive
        Blade::directive('markdownstyle', function ($file) {
            if (!empty($file)) {
                return "<?php echo Markdown::loadStyle({$file}); ?>";
            }

            return '<?php Markdown::loadStyle(); ?>';
        });

        // Markdown Start Blade Directive
        Blade::directive('markdown', function ($markdown) {
            if (!empty($markdown)) {
                return "<?php echo Markdown::convert($markdown); ?>";
            }

            return '<?php Markdown::collect(); ?>';
        });

        // Markdown End Blade Directive
        Blade::directive('endmarkdown', function () {
            return '<?php echo Markdown::endCollect(); ?>';
        });
    }
}
