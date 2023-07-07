<?php

namespace Mcpuishor\CourierManager\DataObjects;

use Carbon\{Carbon, CarbonImmutable};
use Illuminate\Support\Collection;

class Booking extends DataTransferObject
{
    public string $reference;
    public string $service;
    public Carbon|CarbonImmutable $date;
    public Address $to;
    public Address $from;
    public string $deliveryInstructions;
    public Collection $parcels;

    public function rules(): array
    {
        return [
            'reference' => ['required', 'string', 'max:32'],
            'service' => ['required', 'alpha_num', 'max:16'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'to' => ['required'],
            'from' => ['required'],
            'deliveryInstructions' => ['sometimes', 'string', 'max:64'],
            'parcels' => ['required'],
        ];
    }


}
