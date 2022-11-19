<?php

namespace app\dispatchers;

use app\events\Event;

interface EventDispatcherInterface
{
    public function dispatch(Event $event);
}