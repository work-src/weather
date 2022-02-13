<?php

namespace App\Repository;

use App\Domain\Weather\WeatherClient;
use App\Domain\Weather\WeatherDTO;
use Illuminate\Support\Facades\Http;

class WeatherRepository
{
    private WeatherClient $weatherClient;

    public function __construct(WeatherClient $weatherClient)
    {
        $this->weatherClient = $weatherClient;
    }

    public function getWeatherByCityName(string $locale, string $cityName): WeatherDTO
    {
        return $this->weatherClient->getCurrentWeather(
            locale: $locale,
            cityName: $cityName,
        );
    }

    public function getWeatherByCityId(string $locale, int $cityId): WeatherDTO
    {
        return $this->weatherClient->getCurrentWeather(
            locale: $locale,
            cityId: $cityId,
        );
    }
}
