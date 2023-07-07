<?php
declare(strict_types=1);

namespace Mcpuishor\CourierManager\Facades;

use Illuminate\Support\Facades\Facade;

class CourierManager extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'courier-manager';
    }
}
