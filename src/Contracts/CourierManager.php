<?php
declare(strict_types=1);

namespace Mcpuishor\CourierManager\Contracts;

use Mcpuishor\CourierManager\Contracts\Courier;
use Mcpuishor\CourierManager\DataObjects\{Booking, Consignment, Label};

interface CourierManager
{
    public function courier(Courier $courier) : self;

    public function book(Booking $booking): Consignment;

    public function label(Consignment $consignment): Label;

}
