<?php
declare(strict_types=1);
namespace Mcpuishor\CourierManager\DataObjects;

class Service extends DataTransferObject {
        public string $serviceCode;
        public string $name;
        public int $minTransit;
        public int $maxTransit;
        public int $width;
        public int $length;
        public int $height;
        public int $weight;
        public int $volumetricWeight;
        public int $charge;

    public function rules(): array
    {
        return [
            'serviceCode' => ['required', 'string', 'max:32'],
            'name' => ['required', 'string', 'max:64'],
            'minTransit' => ['required', 'int', 'min:0'],
            'maxTransit' => ['required', 'int', 'min:0', 'gte:minTransit'],
            'width' => ['required', 'numeric', 'gt:0'],
            'height' => ['required', 'numeric', 'gt:0'],
            'length' => ['required', 'numeric', 'gt:0'],
            'weight' => ['required', 'numeric', 'gt:0'],
            'volumetricWeight' => ['required', 'numeric', 'gt:0'],
            'charge' => ['required', 'numeric', 'gt:0']
        ];
    }
}
