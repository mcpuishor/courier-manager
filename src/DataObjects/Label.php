<?php
declare(strict_types=1);

namespace Mcpuishor\CourierManager\DataObjects;

use Mcpuishor\CourierManager\Enums\LabelFileFormat;
use Illuminate\Validation\Rules\Enum;

class Label extends DataTransferObject
{
    public string $consignmentNumber;
    public LabelFileFormat $format;
    public int $pages;
    public string $labelData;

    public function rules(): array
    {
        return [
            'consignmentNumber' => ['required', 'string', 'min:8'],
            'format' => ['required', new Enum(LabelFileFormat::class)],
            'pages' => ['required', 'int', 'gt:0'],
        ];
    }
}
