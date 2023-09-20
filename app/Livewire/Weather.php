<?php

namespace App\Livewire;

use App\Services\WeatherService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Weather extends Component
{
    public array $weather = [];

    public function render(): View
    {
        return view('livewire.weather');
    }

    public function mount(WeatherService $service): void
    {
        $this->weather = $service->getWeather();
    }
}
