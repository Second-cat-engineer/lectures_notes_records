<?php

namespace app\dispatchers;

use app\events\Event;
use app\events\LoggedEvent;
use app\services\LoggerInterface;

class LoggedEventDispatcher implements EventDispatcherInterface
{
    private EventDispatcherInterface $next;
    private LoggerInterface $logger;

    public function __construct(EventDispatcherInterface $next, LoggerInterface $logger)
    {
        $this->next = $next;
        $this->logger = $logger;
    }

    public function dispatch(Event $event)
    {
        $this->next->dispatch($event);
        if ($event instanceof LoggedEvent) {
            $this->logger->log($event->getLogMessage());
        }
    }
}