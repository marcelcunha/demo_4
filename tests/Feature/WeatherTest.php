<?php

use App\Livewire\Weather;
use App\Services\WeatherService;
use Livewire\Livewire;

it('should show weather', function () {
    $this->mock(WeatherService::class, function ($mock) {
        $mock->shouldReceive('getWeather')
            ->once()
            ->andReturn([
                'temp' => 29,
                'date' => '2021-01-01',
                'time' => '12:00',
                'description' => 'Tempo Limpo',
                'currently' => 'dia',
                'city' => 'Macapa, AP',
                'cloudiness' => '0',
                'condition_slug' => 'clear_day',
            ]);
    });

    Livewire::test(Weather::class)
        ->assertSee('Tempo Limpo')
        ->assertSee('29')
        ->assertSee('Macapa, AP')
        ->assertSee('clear_day');
});
