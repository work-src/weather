<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\City\CityService;
use App\Domain\Weather\WeatherService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class WeatherController extends Controller
{
    private WeatherService $weatherService;
    private CityService $cityService;

    public function __construct(WeatherService $weatherService, CityService $cityService)
    {
        $this->weatherService = $weatherService;
        $this->cityService = $cityService;
    }

    public function getCityList()
    {
        $countryCode = strtoupper(app()->getLocale());

        $cityList = $this->cityService->getCityList($countryCode);

        return view('welcome', ['cityList' => $cityList] );
    }

    public function getCurrentWeather(Request $request)
    {
        $parameters = current($request->query);

        if (!is_numeric($parameters['id'])) {
            return response()->json([
                'error' => [
                    'code' => 'ecc505ef-2a40-471e-a019-ae0382819cdc',
                    'message' => 'Invalid parameter',
                    'data' => [
                        'path' => 'id',
                        'desc' => 'must be int',
                    ],
                ],
            ], Response::HTTP_BAD_REQUEST);
        }

        return json_encode($this->weatherService->getWeatherToday(
                locale: $parameters['lang'],
                cityId: $parameters['id'] ? (int)$parameters['id'] : null,

            ),
            JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
        );
    }
}
