<?php

namespace App\Domain\City;

interface CityRepositoryInterface
{
    /**
     * @return CityDTO[]
     */
    public function getAllByCountryCode(string $countryCode): array;
}
