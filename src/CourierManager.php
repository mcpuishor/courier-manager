<?php
declare(strict_types=1);
namespace Mcpuishor\CourierManager;

use Mcpuishor\CourierManager\Contracts\{Courier, CourierManager as CourierManagerInterface};
use Mcpuishor\CourierManager\DataObjects\{Booking, Consignment, Label};
use Mcpuishor\CourierManager\Enums\LabelFileFormat;
use Mcpuishor\CourierManager\Exceptions\EndpointNotAvailableException;
use Mcpuishor\CourierManager\Exceptions\ServiceNotAvailableException;

class CourierManager implements CourierManagerInterface
{
    public function __construct(
        private Courier $courier
    ){}

    public function courier(Courier $courier): self
    {
        $this->courier = $courier;

        return $this;
    }

    /**
     * @throws ServiceNotAvailableException
     * @throws EndpointNotAvailableException
     */
    public function book(Booking $booking): Consignment
    {
        if (!$this->courier->isEndpointAvailable()) {
            throw new EndpointNotAvailableException();
        }

       if (!$this->courier->isServiceAvailable($booking)) {
            throw new ServiceNotAvailableException();
       }

        return $this->courier->book($booking);
    }

    public function label(Consignment $consignment, LabelFileFormat $format=LabelFileFormat::PDF): Label
    {
        return $this->courier->label($consignment->waybill, $format);
    }
}
