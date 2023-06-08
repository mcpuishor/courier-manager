<?php
namespace Mcpuishor\CourierManager\DataObjects;

use Illuminate\Support\Collection;

class Booking
{
    public function __construct(
        public string $reference,
        public string $service,
        public Address $to,
        public Address $from,
        public string $deliveryInstructions,
        public Collection $packages,
    ){}
}
