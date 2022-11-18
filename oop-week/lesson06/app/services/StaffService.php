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


        $this->notify($interview->email, 'interview/join', ['model' => $interview], 'You are joined to interview!');
        $this->log($interview->last_name . ' ' . $interview->first_name . ' is joined to interview');

        return $interview;
    }

    public function editInterview($id, $lastName, $firstName, $email): void
    {
        $interview = $this->findInterviewModel($id);
        $interview->editData($lastName, $firstName, $email);
        $interview->save(false);

        $this->log('Interview ' . $interview->id . ' is updated');
    }

    public function rejectInterview($id, $reason): void
    {
        $interview = $this->findInterviewModel($id);
        $interview->reject($reason);
        $interview->save(false);


        $this->notify($interview->email, 'interview/reject', ['model' => $interview], 'Your interview is rejected');
        $this->log('Interview ' . $interview->id . ' is rejected');
    }

    private function findInterviewModel(int $id): Interview
    {
        if (!$interview = Interview::findOne($id)) {
            throw new \DomainException('Interview not found');
        }
        return $interview;
    }

    private function log(string $message): void
    {
        $log = new Log();
        $log->message = $message;
        $log->save();
    }

    private function notify($email, $view, $params, $message): void
    {
        if ($email) {
            Yii::$app->mailer->compose($view, $params)
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($email)
                ->setSubject($message)
                ->send();
        }
    }
}