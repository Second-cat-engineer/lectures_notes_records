<?php

namespace app\services;

use app\dispatchers\EventDispatcherInterface;
use app\events\employee\EmployeeAssignEvent;
use app\events\employee\EmployeeRecruitByInterviewEvent;
use app\events\employee\EmployeeRecruitEvent;
use app\models\Assignment;
use app\models\Contract;
use app\models\Employee;
use app\models\Order;
use app\models\Recruit;
use app\repositories\AssignmentRepository;
use app\repositories\ContractRepository;
use app\repositories\EmployeeRepository;
use app\repositories\InterviewRepository;
use app\repositories\PositionRepository;
use app\repositories\RecruitRepository;
use app\services\dto\RecruitData;

class EmployeeService
{
    private InterviewRepository $interviewRepository;
    private EventDispatcherInterface $eventDispatcher;

    private EmployeeRepository $employeeRepository;
    private ContractRepository $contractRepository;
    private RecruitRepository $recruitRepository;
    private PositionRepository $positionRepository;
    private AssignmentRepository $assignmentRepository;
    private TransactionManager $transactionManager;

    public function __construct(
        InterviewRepository $interviewRepository,
        EmployeeRepository $employeeRepository,
        ContractRepository $contractRepository,
        RecruitRepository $recruitRepository,
        PositionRepository $positionRepository,
        AssignmentRepository $assignmentRepository,
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
        $this->assignmentRepository = $assignmentRepository;
        $this->transactionManager = $transactionManager;
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
        $recruit = Recruit::create($employee, Order::create($orderDate), $recruitDate);

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

        // Или можно сделать так.
//        $this->transactionManager->execute(function () use ($employee, $recruit, $contract) {
//            $this->employeeRepository->add($employee);
//            $this->contractRepository->add($contract);
//            $this->recruitRepository->add($recruit);
//        });


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

    public function assignToPosition($employeeId, $positionId, $rate, $salary, $orderDate, $startDate): void
    {
        $employee = $this->employeeRepository->find($employeeId);
        $position = $this->positionRepository->find($positionId);

        $assignment = Assignment::create($employee, $position, Order::create($orderDate), $salary, $rate, $startDate);

        $this->assignmentRepository->add($assignment);
        $this->eventDispatcher->dispatch(new EmployeeAssignEvent($employee, $assignment, $position));
    }
}