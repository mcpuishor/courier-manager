<?php
declare(strict_types=1);

namespace Mcpuishor\CourierManager\DataObjects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Mcpuishor\CourierManager\Exceptions\{RulesNotDefinedException, DataTransferObjectValidationFailException};
use Mcpuishor\CourierManager\Contracts\DataTransferObjectInterface;

abstract class DataTransferObject implements DataTransferObjectInterface
{

    /**
     * @throws DataTransferObjectValidationFailException
     * @throws RulesNotDefinedException
     */
    public function __construct(array $parameters = [])
    {
        $class = new \ReflectionClass(static::class);

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $reflectionProperty) {
            $property = $reflectionProperty->getName();

            if ( isset($this->inputMap()[$property]) ) {
                $property = $this->inputMap()[$property];
            }

            if ($property !== '') {
                if ($reflectionProperty->getType() instanceOf \ReflectionNamedType) {
                    $this->{$property} = match ($reflectionProperty->getType()->getName()) {
                        'int' => (int)$parameters[$property],
                        'float' => (float)$parameters[$property],
                        'string' => (string)$parameters[$property],
                        'bool' => (bool)$parameters[$property],
                        'Illuminate\Support\Carbon' => Carbon::parse($parameters[$property]),
                        default => $parameters[$property],
                    };
                } else {
                    $this->{$property} = $parameters[$property];
                }
            }
        }
        $this->validate();
    }

    /**
     * @throws DataTransferObjectValidationFailException
     * @throws RulesNotDefinedException
     */
    public static function fromArray(array $array): DataTransferObject
    {
        return new static($array);
    }

    public function fromModel(Model $model): DataTransferObject
    {
        return $this->fromArray($model->toArray());
    }

    /**
     * @throws RulesNotDefinedException
     * @throws DataTransferObjectValidationFailException
     */
    public function validate(): void
    {
        if (is_array($this->rules()) && empty($this->rules())) {
            throw new RulesNotDefinedException('No validation rules have been defined for ' . __CLASS__);
        }

        $validator = Validator::make($this->toArray(false), $this->rules());

        if ($validator->fails()) {
            throw new DataTransferObjectValidationFailException();
        }
    }

    /**
     * @throws RulesNotDefinedException
     */
    public function rules(): array
    {
        throw new RulesNotDefinedException('No validation rules have been defined for ' . __CLASS__);
    }

    public function toArray(bool $withMapping = true): array
    {
        $class = new \ReflectionClass(static::class);
        $result = [];

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $reflectionProperty) {
            $property = $reflectionProperty->getName();
            if ($withMapping) {
                if (is_array($this->map()) && !empty($this->map()) && isset($this->map()[$property])) {
                    $result[$this->map()[$property]] = $this->$property;
                }
            } else {
                $result[$property] = $this->$property;
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    public function map(): array
    {
        return [
            //internal property => takes value from
        ];
    }

    public function inputMap(): array
    {
        return [
            //internal property => takes value from
        ];
    }

}
