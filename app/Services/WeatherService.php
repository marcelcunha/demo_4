<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    private string $apiKey;

    private string $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('weather.api_key');
        $this->apiUrl = config('weather.api_url');
    }

    public function getWeather(): array
    {
        $response = $this->getCachedResponse();

        if (empty($response)) {
            return $response;
        }

        return [
            'temp' => $response['results']['temp'],
            'date' => $response['results']['date'],
            'time' => $response['results']['time'],
            'description' => $response['results']['description'],
            'currently' => $response['results']['currently'],
            'city' => $response['results']['city'],
            'cloudiness' => $response['results']['cloudiness'],
            'condition_slug' => $response['results']['condition_slug'],
        ];
    }

    private function callAPI(): array
    {
        try{
            return Http::acceptJson()
                ->get($this->apiUrl, [
                    'key' => $this->apiKey,
                    'user_ip' => 'remote',
                ])->throw(function ($response) {
                    return [];
                })
                ->json();
        }catch (\Exception $e){
            report($e);
            
            return [];
        }
    }

    private function getCachedResponse(): array
    {
        return Cache::remember('weather', 3600, function () {
            return $this->callAPI();
        });
    }
}
