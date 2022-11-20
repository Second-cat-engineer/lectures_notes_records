<?php

namespace app\repositories;

use app\models\Recruit;
use app\repositories\exceptions\NotFoundException;

class RecruitRepository
{
    /**
     * @param int $id
     * @return Recruit
     * @throws NotFoundException
     */
    public function find(int $id): Recruit
    {
        if (!$recruit = Recruit::findOne($id)) {
            throw new NotFoundException('Model not found.');
        }
        return $recruit;
    }

    public function add(Recruit $recruit): void
    {
        if (!$recruit->getIsNewRecord()) {
            throw new \RuntimeException('Adding existing model.');
        }
        if (!$recruit->insert(false)) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function save(Recruit $recruit): void
    {
        if ($recruit->getIsNewRecord()) {
            throw new \RuntimeException('Saving new model.');
        }
        if ($recruit->update(false) === false) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function delete(Recruit $recruit): void
    {
        if (!$recruit->delete()) {
            throw new \RuntimeException('Deleting error.');
        }
    }
}