<?php

namespace app\repositories;

use app\models\Contract;
use app\repositories\exceptions\NotFoundException;

class ContractRepository
{
    /**
     * @param int $id
     * @return Contract
     * @throws NotFoundException
     */
    public function find(int $id): Contract
    {
        if (!$contract = Contract::findOne($id)) {
            throw new NotFoundException('Model not found.');
        }
        return $contract;
    }

    public function add(Contract $contract): void
    {
        if (!$contract->getIsNewRecord()) {
            throw new \RuntimeException('Adding existing model.');
        }
        if (!$contract->insert(false)) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function save(Contract $contract): void
    {
        if ($contract->getIsNewRecord()) {
            throw new \RuntimeException('Saving new model.');
        }
        if ($contract->update(false) === false) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function delete(Contract $contract): void
    {
        if (!$contract->delete()) {
            throw new \RuntimeException('Deleting error.');
        }
    }
}