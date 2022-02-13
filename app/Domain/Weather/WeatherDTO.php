<?php

namespace App\Domain\Weather;

use JsonSerializable;

class WeatherDTO implements JsonSerializable
{
    public array $weather = [   // ОПИСАНИЕ ПОГОДЫ
        "id" => '',
        "main" => '',
        "description" => '',
        "icon" => ''
    ];
    public array $main = [      // ОСНОВНЫЕ ДАННЫЕ
        "temp" => '',       // температура
        "feels_like" => '', // ощущается
        "temp_min" => '',   // минимальная
        "temp_max" => '',   // максимальная
        "pressure" => '',   // давление
        "humidity" => '',   // влажность
    ];
    public array $wind = [  // ВЕТЕР
        "speed" => '',  // скорость
        "deg" => '',    // направление
        "gust" => ''    // порывы
    ];
    public string $nameCity;

    public function __construct(array $weather, array $main, array $wind, string $nameCity)
    {
        $this->weather = $weather;
        $this->main = $main;
        $this->wind = $wind;
        $this->nameCity = $nameCity;
    }

    public function jsonSerialize()
    {
        return [
            "weather" => $this->weather,
            "main" => $this->main,
            "wind" => $this->wind,
            "name" => $this->nameCity
        ];
    }
}
