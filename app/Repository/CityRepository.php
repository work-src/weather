<?php

namespace App\Repository;

use App\Domain\City\CityDTO;
use App\Domain\City\CityRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class CityRepository implements CityRepositoryInterface
{
    private string $pathPrefix = 'weather';
    private string $fileName = 'cityList.json.gz';
    private string $filePath;

    public function __construct()
    {
        $this->filePath = storage_path($this->pathPrefix . DIRECTORY_SEPARATOR . $this->fileName);

        $this->uploadFile();
    }

    private function uploadFile(): void
    {
        if (file_exists($this->filePath)) {
            return;
        }

        $url = env('OPENWEATHER_CITY_URL');
        $result = Storage::disk('weather')->put($this->fileName, file_get_contents($url));

        if (!$result) {
            throw new \Exception('Error upload file!');
        }
    }

    private function getFileData(): array
    {
        $fp = gzopen($this->filePath, 'rb');

        $content = '';
        while ($string = gzread($fp, 4096)) {
            $content .= $string;
        }

        gzclose($fp);

        return json_decode($content) ?? [];
    }

    /**
     * @return \App\Domain\City\CityDTO[]
     */
    public function getAllByCountryCode(string $countryCode): array
    {
        return array_map(
            function ($val) use ($countryCode) {
                if ($val->country == $countryCode) {
                    return new CityDTO(
                        id: $val->id,
                        name: $val->name,
                        country: $val->country
                    );
                }
            },
            array_filter($this->getFileData(), function ($item) use ($countryCode) {
                return $item->country == $countryCode;
            })
        );
    }
}
