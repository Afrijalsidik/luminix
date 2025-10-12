<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        // Add custom Blade directive for default image
        Blade::directive('courseImage', function ($expression) {
            return "<?php echo \$expression ? Storage::url(\$expression) : asset('images/placeholder.png'); ?>";
        });
    }
}
