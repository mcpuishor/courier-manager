<?php
declare(strict_types=1);
namespace Mcpuishor\CourierManager;

use Mcpuishor\CourierManager\Contracts\{Courier, CourierManager as CourierManagerInterface};
use Mcpuishor\CourierManager\DataObjects\{Booking, Consignment, Label};
use Illuminate\Support\Collection;
use Mcpuishor\CourierManager\Enums\LabelFileFormat;
use Mcpuishor\CourierManager\Exceptions\EndpointNotAvailableException;
use Mcpuishor\CourierManager\Exceptions\ServiceNotAvailableException;

class CourierManager implements CourierManagerInterface
{
    public function __construct(
        private Courier $courier
    ){
    }

    public function courier(Courier $courier): self
    {
        $this->courier = $courier;

        return $this;
    }

    public function get() : self
    {
        return $this;
    }

    /**
     * @throws ServiceNotAvailableException
     * @throws EndpointNotAvailableException
     */
    public function book(Booking $booking, bool $revalidateServices = false): Consignment
    {
        if (!$this->courier->isEndpointAvailable()) {
            throw new EndpointNotAvailableException('The endpoint for ' . $this->courier->name() . ' is unreacheable.');
        }

        if ($revalidateServices && !$this->courier->isServiceAvailable($booking)) {
            throw new ServiceNotAvailableException('The selected service is not available for the intended booking.');
        }

        return $this->courier->book($booking);
    }

    public function label(string $consignmentWaybill, LabelFileFormat $format=LabelFileFormat::PDF): Label
    {
        return $this->courier->label($consignmentWaybill, $format);
    }

    public function traces(string $consignmentWaybill): Collection
    {
        //check if consignment exists? what happens when an non-existing consignment
        //is being cancelled?

       return $this->courier->traces($consignmentWaybill);
    }

    public function cancel(string $consignmentWaybill): bool
    {
        return $this->courier->cancel($consignmentWaybill);
    }

    public function services(Booking $booking): Collection
    {
       return $this->courier->getServicesForBooking($booking);
    }
}
