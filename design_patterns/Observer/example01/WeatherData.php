<?php

namespace Observer\example01;

class WeatherData implements Subject
{
    /** @var Observer[]  */
    private array $observers = [];
    private float $temperature;
    private float $humidity;
    private float $pressure;

    public function registerObserver(Observer $observer)
    {
        $this->observers[get_class($observer)] = $observer;
    }

    public function removeObserver(Observer $observer)
    {
        unset($this->observers[get_class($observer)]);
    }

    public function notifyObservers()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->temperature, $this->humidity, $this->pressure);
        }
    }

    public function measurementsChanged()
    {
        $this->notifyObservers();
    }

    public function setMeasurements(float $temperature, float $humidity, float $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;

        $this->measurementsChanged();
    }
}