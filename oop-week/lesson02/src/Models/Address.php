<?php

namespace lesson02\src\Models;

/**
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $street
 * @property string $house
 */
class Address
{
    public string $country;
    public string $region;
    public string $city;
    public string $street;
    public string $house;

    public function __construct($country, $region, $city, $street, $house)
    {
        $this->country = $country;
        $this->region = $region;
        $this->city = $city;
        $this->street = $street;
        $this->house = $house;
    }
}