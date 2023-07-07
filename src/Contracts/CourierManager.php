<?php
declare(strict_types=1);

namespace Mcpuishor\CourierManager\Contracts;

use Mcpuishor\CourierManager\Contracts\Courier;
use Mcpuishor\CourierManager\DataObjects\{Booking, Consignment, Label};
use Illuminate\Support\Collection;

interface CourierManager
{
    public function courier(Courier $courier) : self;

    public function book(Booking $booking, bool $revalidateServices = false): Consignment;

    public function cancel(string $consignmentWaybill): bool;

    public function services(Booking $booking) : Collection;

    public function label(string $consignmentWaybill): Label;

    public function traces(string $consignmentWaybill) : Collection;

}
