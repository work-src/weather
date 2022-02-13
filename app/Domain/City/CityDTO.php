<?php

namespace App\Domain\City;

use JsonSerializable;

class CityDTO implements JsonSerializable
{
    public int $id;
    public string $name;
    public string $country;

    public function __construct(int $id, string $name, string $country)
    {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'country' => $this->country
        ];
    }
}
