# COURIER MANAGER

A package to manage booking parcels, pallets and other shipping items (as consignments ) 
via external couriers. This package is abstracting the interaction with the courier. 
Packages for specific services need to be created to be able to interact 
with an external courier.

This includes methods to book a consignment, retrieve information 
about a consignment and associated labels, track the consignment in the courier's system. 

**NOTA BENE: At least one courier package needs to be installed for this package to work.
Additional configuration for couriers may be required. This can be configured in the `config/courier-manager.php`.**

## Installing the package
This package should not be installed on its own. 

To install the package as part of the process of dealing with a courier, run:

``composer require mcpuishor/courier-manager``

Once the package is installed, at least one driver should be installed to be able 
to use the features of this package. 

## Defined couriers (driver modules)
* APC (New Horizon - Hypaship)
* Royal Mail (Parcels)
* Total Pallet Network 

## Extending the defined couriers 
Additional packages must require this package as part of the dependencies 
and make use of the contracts and data structures defined.

## Configuring Courier Manager's default courier

Multiple couriers can be used at the same time, by extending in `AppServiceProvider.php` 
or by specifying at runtime the courier driver to be used.

## Usage

To instantiate a new Courier Manager with the default settings, use the facade:

``` 
use Mcpuishor\CourierManager\Facades\CourierManager;

$booking = new Booking(
        reference: 'YOUR INTERNAL REFERENCE',
        service: 'COURIER SERVICE',
        to: $customer_address,
        from: $merchant_address,
        deliveryInstructions: 'Leave somewhere safe',
        packages: $packages,
    );

$consignment = CourierManager::book($booking);
```

If a different courier than the default needs to be used: 

```
$consignment = CourierManager::courier('courier-identifier-string')->book($booking);
```

The Courier Manager will return a Consignment once the booking is successful. 
If the service is not available at the selected courier's end point, 
a ``\Mcpuishor\CourierManager\Exceptions\CourierServiceNotAvailableException`` is thrown.

Other exceptions are thrown by the respective driver package if booking is unsuccessful.
