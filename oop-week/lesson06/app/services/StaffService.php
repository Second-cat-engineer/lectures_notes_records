<?php

namespace app\services;

use app\models\Interview;
use app\repositories\InterviewRepository;

class StaffService
{
    private InterviewRepository $interviewRepository;
    private NotifierInterface $notifier;
    private LoggerInterface $logger;

    public function __construct(
        InterviewRepository $interviewRepository,
        NotifierInterface $notifier,
        LoggerInterface $logger
    )
    {
        $this->interviewRepository = $interviewRepository;
        $this->notifier = $notifier;
        $this->logger = $logger;
    }

    public function joinToInterview($lastName, $firstName, $email, $date): Interview
    {
        $interview = Interview::join($lastName, $firstName, $email, $date);
        $this->interviewRepository->add($interview);


        $this->notifier->notify($interview->email, 'interview/join', ['model' => $interview], 'You are joined to interview!');
        $this->logger->log($interview->last_name . ' ' . $interview->first_name . ' is joined to interview');

        return $interview;
    }

    public function editInterview(int $id, $lastName, $firstName, $email): void
    {
        $interview = $this->interviewRepository->find($id);
        $interview->editData($lastName, $firstName, $email);
        $this->interviewRepository->save($interview);

        $this->logger->log('Interview ' . $interview->id . ' is updated');
    }

    public function moveInterview(int $id, $date): void
    {
        $interview = $this->interviewRepository->find($id);
        $interview->move($date);
        $this->interviewRepository->save($interview);

        $this->notifier->notify($interview->email, 'interview/move', ['model' => $interview], 'Your interview is moved');
        $this->logger->log('Interview ' . $interview->id . ' is moved on ' . $interview->date);
    }

    public function rejectInterview($id, $reason): void
    {
        $interview = $this->interviewRepository->find($id);
        $interview->reject($reason);
        $this->interviewRepository->save($interview);


        $this->notifier->notify($interview->email, 'interview/reject', ['model' => $interview], 'Your interview is rejected');
        $this->logger->log('Interview ' . $interview->id . ' is rejected');
    }

    public function deleteInterview(int $id)
    {
        $interview = $this->interviewRepository->find($id);
        $interview->remove();
        $this->interviewRepository->delete($interview);

        $this->logger->log('Interview ' . $interview->id . ' is removed');
    }
}