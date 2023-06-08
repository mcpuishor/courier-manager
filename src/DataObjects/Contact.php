<?php
namespace Mcpuishor\CourierManager\DataObjects;

readonly class Contact {

    private function __construct(
        public string $name,
        public string $phoneNumber,
        public string $email,
    ){}
}
