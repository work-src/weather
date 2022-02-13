<?php

namespace App\Domain\City;

class CityService
{
    private CityRepositoryInterface $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function getCityList(string $countryCode): array
    {
        return $this->cityRepository->getAllByCountryCode($countryCode);
    }
}
