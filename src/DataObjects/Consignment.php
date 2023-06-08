<?php
declare(strict_types=1);

namespace Mcpuishor\CourierManager\DataObjects;

use Illuminate\Support\Collection;

class Consignment
{
    public function __construct(
        public string $waybill,
        public string $reference,
        public string $service,
        public Address $to,
        public Address $from,
        public string $deliveryInstructions,
        public Collection $packages,
    ){}
}
