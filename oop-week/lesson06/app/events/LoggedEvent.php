<?php

namespace app\events;

interface LoggedEvent
{
    public function getLogMessage(): string;
}