<?php
declare(strict_types=1);

use Illuminate\Support\ServiceProvider;

class CourierManagerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind('courier-manager', function(){
            return new CourierManager();
        });
    }

    public function register(): void
    {
        //
    }
}
