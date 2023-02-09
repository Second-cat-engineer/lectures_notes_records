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

    public function update(float $temp, float $humidity, float $pressure)
    {
        $this->temperature = $temp;
        $this->humidity = $humidity;

        $this->display();
    }

    public function display()
    {
        echo "Current conditions: " . $this->temperature . "F degrees and " . $this->humidity . "% humidity" . PHP_EOL;
    }
}