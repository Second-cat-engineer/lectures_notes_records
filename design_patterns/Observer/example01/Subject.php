<?php

namespace Observer\example01;

interface Subject
{
    public function registerObserver(Observer $observer);
    public function removeObserver(Observer $observer);
    public function notifyObservers();
}