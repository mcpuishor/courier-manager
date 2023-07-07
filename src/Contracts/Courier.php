<?php
declare(strict_types=1);

namespace Mcpuishor\CourierManager\Contracts;

use Mcpuishor\CourierManager\DataObjects\{Booking, Consignment, Label};
use Illuminate\Http\Client\PendingRequest;
use Mcpuishor\CourierManager\Enums\LabelFileFormat;
use Illuminate\Support\Collection;

interface Courier
{
    public function authentication() : string;
    public function prepareRequest() : PendingRequest;
    public function book(Booking $booking): Consignment;
    public function name() : string;

    public function isEndpointAvailable() : bool;
    public function isServiceAvailable(Booking $booking) : bool;
    public function getServicesForBooking(Booking $booking) : Collection;
    public function label(string $consignmentNumber, LabelFileFormat $format) : Label;
    public function traces(string $consignmentNumber) : Collection;

    public function cancel(string $consignmentNumber) : bool;
}
