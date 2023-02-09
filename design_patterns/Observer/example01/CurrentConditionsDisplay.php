<?php

namespace Observer\example01;

class CurrentConditionsDisplay implements Observer, DisplayElement
{
    private Subject $weatherData;
    private float $temperature;
    private float $humidity;

    public function __construct(Subject $weatherData)
    {
        $this->weatherData = $weatherData;
        $this->weatherData->registerObserver($this);
    }

    public function update()
    {
        $this->temperature = $this->weatherData->getTemperature();
        $this->humidity = $this->weatherData->getHumidity();

        $this->display();
    }

    public function display()
    {
        echo "Current conditions: " . $this->temperature . "F degrees and " . $this->humidity . "% humidity" . PHP_EOL;
    }
}