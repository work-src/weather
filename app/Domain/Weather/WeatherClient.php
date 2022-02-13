<?php declare(strict_types=1);

namespace App\Domain\Weather;


use Illuminate\Support\Facades\Http;

final class WeatherClient
{
    private string $apiKey;
    private string $apiUrl;

    public function __construct()
    {
        $this->apiKey = env('OPENWEATHER_KEY');
        $this->apiUrl = env('OPENWEATHER_URL');
    }

    public function getCurrentWeather(string $locale, string $cityName = null, int $cityId = null): WeatherDTO
    {
        $params = [
            'appid' => $this->apiKey,
            'lang' => $locale,
        ];

        if (null !== $cityName) {
            $params['q'] = $cityName;
        } elseif (null !== $cityId) {
            $params['id'] = $cityId;
        } else {
            throw new \InvalidArgumentException('Either $cityName or $cityId must not be null');
        }

        $response = Http::get(
            $this->apiUrl,
            $params
        );

        if ($response->ok()) {
            $data = $response->json();

            return new WeatherDTO(
                $data['weather'][0],
                $data['main'],
                $data['wind'],
                $data['name']
            );
        }

        throw $response->toException();
    }
}
