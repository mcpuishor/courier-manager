<?php
declare(strict_types=1);
namespace Mcpuishor\CourierManager\Providers;

use Illuminate\Support\ServiceProvider;
use Mcpuishor\CourierManager\CourierManager;

class CourierManagerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/courier-manager.php' => config_path('courier-manager.php'),
        ]);

    }

    public function register(): void
    {
        $this->app->bind(
            'courier-manager',
            fn() => new CourierManager( $this->app->make(config('courier-manager.courier.driver')) )
        );
    }
}
