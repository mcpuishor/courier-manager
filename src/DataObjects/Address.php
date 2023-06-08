<?php
namespace Mcpuishor\CourierManager\DataObjects;

use Mcpuishor\CourierManager\DataObjects\Contact;
readonly class Address {

    public function __construct(
        public string $company,
        public string $line1,
        public string $line2,
        public string $postcode,
        public string $city,
        public string $county,
        public string $country,
        public Contact $contact,
    ){}
}
