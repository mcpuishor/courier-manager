<?php
declare(strict_types=1);

namespace Mcpuishor\CourierManager\Contracts;

use Mcpuishor\CourierManager\DataObjects\{Booking, Consignment, Label};
use Mcpuishor\CourierManager\Enums\LabelFileFormat;

interface Courier
{
    public function get(): self;

    public function book(Booking $consignment): Consignment;

    public function isServiceAvailable(Booking $booking) : bool;

    public function label(string $consignmentNumber, LabelFileFormat $format) : Label;
}
