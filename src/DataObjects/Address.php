<?php

namespace Mcpuishor\CourierManager\DataObjects;

use Mcpuishor\CourierManager\DataObjects\Contact;

class Address extends DataTransferObject
{
    public string $company;
    public string $line1;
    public string $line2;
    public string $postcode;
    public string $city;
    public string $county;
    public string $country;
    public Contact $contact;

    public function rules(): array
    {
        return [
            'company' => ['nullable', 'string', 'max:35'],
            'line1' => ['required', 'string', 'max:64'],
            'line2' => ['nullable', 'string', 'max:64'],
            'postcode' => ['required', 'string', 'max:10'],
            'city' => ['required', 'string', 'max:32'],
            'county' => ['nullable', 'string', 'max:32'],
            'country' => ['required', 'string', 'max:3'],
            'contact' => ['required']
        ];
    }
}
