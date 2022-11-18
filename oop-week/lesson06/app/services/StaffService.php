<?php

namespace app\services;

use app\models\Interview;
use app\models\Log;
use app\repositories\InterviewRepository;
use Yii;

class StaffService
{
    private InterviewRepository $interviewRepository;

    public function __construct(InterviewRepository $interviewRepository)
    {
        $this->interviewRepository = $interviewRepository;
    }

    public function joinToInterview($lastName, $firstName, $email, $date): Interview
    {
        $interview = Interview::join($lastName, $firstName, $email, $date);
        $this->interviewRepository->add($interview);


        $this->notify($interview->email, 'interview/join', ['model' => $interview], 'You are joined to interview!');
        $this->log($interview->last_name . ' ' . $interview->first_name . ' is joined to interview');

        return $interview;
    }

    public function editInterview($id, $lastName, $firstName, $email): void
    {
        $interview = $this->interviewRepository->find($id);
        $interview->editData($lastName, $firstName, $email);
        $this->interviewRepository->save($interview);

        $this->log('Interview ' . $interview->id . ' is updated');
    }

    public function rejectInterview($id, $reason): void
    {
        $interview = $this->interviewRepository->find($id);
        $interview->reject($reason);
        $this->interviewRepository->save($interview);


        $this->notify($interview->email, 'interview/reject', ['model' => $interview], 'Your interview is rejected');
        $this->log('Interview ' . $interview->id . ' is rejected');
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