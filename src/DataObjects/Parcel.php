<?php
declare(strict_types=1);

namespace Mcpuishor\CourierManager\DataObjects;

class Parcel extends DataTransferObject
{
    public int $width;
    public int $height;
    public int $length;
    public int $weight;

    public function rules(): array
    {
        return [
            'width' => ['required', 'numeric', 'gt:0'],
            'height' => ['required', 'numeric', 'gt:0'],
            'length' => ['required', 'numeric', 'gt:0'],
            'weight' => ['required', 'numeric', 'gt:0'],
        ];
    }
}
