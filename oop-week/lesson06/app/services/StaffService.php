<?php

namespace app\services;

use app\models\Interview;
use app\models\Log;
use Yii;

class StaffService
{
    public function joinToInterview($lastName, $firstName, $email, $date): Interview
    {
        $interview = Interview::join($lastName, $firstName, $email, $date);
        $interview->save(false);

        if ($interview->email) {
            Yii::$app->mailer->compose('interview/join', ['model' => $interview])
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($interview->email)
                ->setSubject('You are joined to interview!')
                ->send();
        }

        $log = new Log();
        $log->message = $interview->last_name . ' ' . $interview->first_name . ' is joined to interview';
        $log->save();

        return $interview;
    }
}