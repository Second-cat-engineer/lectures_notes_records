<?php

namespace app\services;

interface NotifierInterface
{
    public function notify($email, $view, $data, $subject);
}