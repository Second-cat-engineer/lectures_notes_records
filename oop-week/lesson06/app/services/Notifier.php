<?php

namespace app\services;

use Yii;

class Notifier implements NotifierInterface
{
    private $fromEmail;

    public function __construct($fromEmail)
    {
        $this->fromEmail = $fromEmail;
    }

    public function notify($email, $view, $data, $subject)
    {
        if ($email) {
            Yii::$app->mailer->compose($view, $data)
                ->setFrom($this->fromEmail)
                ->setTo($email)
                ->setSubject($subject)
                ->send();
        }
    }
}