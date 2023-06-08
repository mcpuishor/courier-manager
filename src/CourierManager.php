<?php
declare(strict_types=1);
namespace Mcpuishor\CourierManager;

use Mcpuishor\CourierManager\Contracts\{Courier, CourierManager as CourierManagerInterface};
use Mcpuishor\CourierManager\DataObjects\{Booking, Consignment, Label};
use Mcpuishor\CourierManager\Enums\LabelFileFormat;
use Mcpuishor\CourierManager\Exceptions\CourierServiceNotAvailableException;

class CourierManager implements CourierManagerInterface
{
    private Courier $courier;

    public function courier(Courier $courier): self
    {
        $this->courier = $courier;

        return $this;
    }

    /**
     * @throws CourierServiceNotAvailableException
     */
    public function book(Booking $booking): Consignment
    {
       if (!$this->courier->isServiceAvailable($booking)) {
            throw new CourierServiceNotAvailableException();
       }

        return $this->courier->book($booking);
    }

    public function label(Consignment $consignment, LabelFileFormat $format=LabelFileFormat::PDF): Label
    {
        return $this->courier->label($consignment->waybill, $format);
    }
}
