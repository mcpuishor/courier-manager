<?php

namespace Mcpuishor\CourierManager\DataObjects;

class Contact extends DataTransferObject
{
    public string $name;
    public string $phone;
    public string $email;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:32'],
            'phone' => ['required', 'string', 'min:5', 'max:16'],
            'email' => ['sometimes', 'email'],
        ];
    }
}
