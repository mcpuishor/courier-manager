<?php
declare(strict_types=1);
namespace Mcpuishor\CourierManager\DataObjects;

use Mcpuishor\CourierManager\Enums\LabelFileFormat;

readonly class Label {
    public function __construct(
        public string $consignmentNumber,
        public LabelFileFormat $format,
        public int $pages,
        public string $labelData,
    ){}
}
