<?php
declare(strict_types=1);
namespace Mcpuishor\CourierManager\DataObjects;

readonly class Package {
    public function __construct(
        public int $width,
        public int $height,
        public int $depth,
        public int $weight
    ){}
}
