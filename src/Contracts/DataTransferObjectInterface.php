<?php
declare(strict_types=1);

namespace Mcpuishor\CourierManager\Contracts;

use Illuminate\Database\Eloquent\Model;

interface DataTransferObjectInterface
{

    public static function fromArray(array $array): self;

    public function fromModel(Model $model): self;

    public function validate(): void;

    public function rules(): array;

    public function map(): array;
    public function inputMap(): array;

    public function toArray(bool $withMapping=true): array;
}
