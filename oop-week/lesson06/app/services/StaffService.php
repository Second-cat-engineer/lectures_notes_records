<?php

namespace app\services;

use app\dispatchers\EventDispatcherInterface;
use app\events\interview\InterviewDeleteEvent;
use app\events\interview\InterviewEditEvent;
use app\events\interview\InterviewJoinEvent;
use app\events\interview\InterviewMoveEvent;
use app\events\interview\InterviewRejectEvent;
use app\models\Interview;
use app\repositories\InterviewRepository;

class StaffService
{
    private InterviewRepository $interviewRepository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(InterviewRepository $interviewRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->interviewRepository = $interviewRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function joinToInterview($lastName, $firstName, $email, $date): Interview
    {
        $interview = Interview::join($lastName, $firstName, $email, $date);
        $this->interviewRepository->add($interview);

        $this->eventDispatcher->dispatch(new InterviewJoinEvent($interview));

        return $interview;
    }

    public function editInterview(int $id, $lastName, $firstName, $email): void
    {
        $interview = $this->interviewRepository->find($id);
        $interview->editData($lastName, $firstName, $email);
        $this->interviewRepository->save($interview);

        $this->eventDispatcher->dispatch(new InterviewEditEvent($interview));
    }

    public function moveInterview(int $id, $date): void
    {
        $interview = $this->interviewRepository->find($id);
        $interview->move($date);
        $this->interviewRepository->save($interview);

        $this->eventDispatcher->dispatch(new InterviewMoveEvent($interview));
    }

    public function rejectInterview($id, $reason): void
    {
        $interview = $this->interviewRepository->find($id);
        $interview->reject($reason);
        $this->interviewRepository->save($interview);

        $this->eventDispatcher->dispatch(new InterviewRejectEvent($interview));
    }

    public function deleteInterview(int $id): void
    {
        $interview = $this->interviewRepository->find($id);
        $interview->remove();
        $this->interviewRepository->delete($interview);

        $this->eventDispatcher->dispatch(new InterviewDeleteEvent($interview));
    }
}