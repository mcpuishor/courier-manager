<?php
declare(strict_types=1);

namespace Mcpuishor\CourierManager\DataObjects;

use Illuminate\Support\Collection;

class Consignment extends DataTransferObject
{
    public string $waybill;
    public string $reference;
    public string $service;
    public Address $to;
    public Address $from;
    public string $deliveryInstructions;
    public Collection $packages;

    public function rules(): array
    {
        return [
            'waybill' => ['required', 'string', 'max:32'],
            'reference' => ['required', 'string', 'max:32'],
            'service' => ['required', 'string', 'max:16'],
            'to' => ['required'],
            'from' => ['required'],
            'deliveryInstructions' => ['sometimes', 'string', 'max:64'],
            'packages' => ['required'],
        ];
    }

}
