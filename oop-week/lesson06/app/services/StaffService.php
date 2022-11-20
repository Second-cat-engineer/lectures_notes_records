<?php

namespace app\services;

use app\dispatchers\EventDispatcherInterface;
use app\events\employee\EmployeeRecruitByInterviewEvent;
use app\events\employee\EmployeeRecruitEvent;
use app\events\interview\InterviewDeleteEvent;
use app\events\interview\InterviewEditEvent;
use app\events\interview\InterviewJoinEvent;
use app\events\interview\InterviewMoveEvent;
use app\events\interview\InterviewRejectEvent;
use app\models\Contract;
use app\models\Employee;
use app\models\Interview;
use app\models\Order;
use app\models\Recruit;
use app\repositories\ContractRepository;
use app\repositories\EmployeeRepository;
use app\repositories\InterviewRepository;
use app\repositories\PositionRepository;
use app\repositories\RecruitRepository;
use app\services\dto\RecruitData;

class StaffService
{
    private InterviewRepository $interviewRepository;
    private EventDispatcherInterface $eventDispatcher;

    private $employeeRepository;
    private $contractRepository;
    private $recruitRepository;
    private $positionRepository;
    private $transactionManager;

    public function __construct(
        InterviewRepository $interviewRepository,
        EmployeeRepository $employeeRepository,
        ContractRepository $contractRepository,
        RecruitRepository $recruitRepository,
        PositionRepository $positionRepository,
        TransactionManager $transactionManager,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->interviewRepository = $interviewRepository;
        $this->eventDispatcher = $eventDispatcher;

        $this->employeeRepository = $employeeRepository;
        $this->contractRepository = $contractRepository;
        $this->recruitRepository = $recruitRepository;
        $this->positionRepository = $positionRepository;
        $this->transactionManager = $transactionManager;
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

    public function createEmployeeByInterview($interviewId, RecruitData $recruitData, $orderDate, $contractDate, $recruitDate)
    {
        $interview = $this->interviewRepository->find($interviewId);
        $employee = Employee::create(
            $recruitData->firstName,
            $recruitData->lastName,
            $recruitData->address,
            $recruitData->email
        );
        $interview->passBy($employee);
        $contract = Contract::create($employee, $recruitData->lastName, $recruitData->firstName, $contractDate);
        $recruit = Recruit::create($employee, $orderDate, $recruitDate);

        $transaction = $this->transactionManager->begin();
        try {
            $this->employeeRepository->add($employee);
            $this->interviewRepository->save($interview);
            $this->recruitRepository->add($recruit);
            $this->contractRepository->add($contract);
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        $this->eventDispatcher->dispatch(new EmployeeRecruitByInterviewEvent($employee, $interview));
        return $employee;
    }

    public function createEmployee(RecruitData $recruitData, $orderDate, $contractDate, $recruitDate): Employee
    {
        $employee = Employee::create(
            $recruitData->firstName,
            $recruitData->lastName,
            $recruitData->address,
            $recruitData->email
        );
        $contract = Contract::create($employee, $recruitData->lastName, $recruitData->firstName, $contractDate);
        $recruit = Recruit::create($employee, Order::create($orderDate), $recruitDate);

        $transaction = $this->transactionManager->begin();
        try {
            $this->employeeRepository->add($employee);
            $this->contractRepository->add($contract);
            $this->recruitRepository->add($recruit);
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        $this->eventDispatcher->dispatch(new EmployeeRecruitEvent($employee));

        return $employee;
    }
}