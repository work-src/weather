<?php declare(strict_types=1);

namespace App\Domain\Weather;

use App\Repository\WeatherRepository;

class WeatherService
{
    private const DEFAULT_CITYNAME = 'Москва';

    private WeatherRepository $weatherRepository;

    public function __construct(WeatherRepository $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;
    }

    public function getWeatherToday(string $locale, ?int $cityId): WeatherDTO
    {
        if ($cityId === null) {
            return $this->weatherRepository->getWeatherByCityName($locale, self::DEFAULT_CITYNAME);
        } else {
            return $this->weatherRepository->getWeatherByCityId($locale, $cityId);
        }
    }
}
