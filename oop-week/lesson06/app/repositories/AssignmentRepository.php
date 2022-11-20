<?php

namespace app\repositories;

use app\models\Assignment;
use app\repositories\exceptions\NotFoundException;

class AssignmentRepository
{
    /**
     * @param int $id
     * @return Assignment
     * @throws NotFoundException
     */
    public function find(int $id): Assignment
    {
        if (!$assignment = Assignment::findOne($id)) {
            throw new NotFoundException('Model not found.');
        }
        return $assignment;
    }

    public function add(Assignment $assignment): void
    {
        if (!$assignment->getIsNewRecord()) {
            throw new \RuntimeException('Adding existing model.');
        }
        if (!$assignment->insert(false)) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function save(Assignment $assignment): void
    {
        if ($assignment->getIsNewRecord()) {
            throw new \RuntimeException('Saving new model.');
        }
        if ($assignment->update(false) === false) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function delete(Assignment $assignment): void
    {
        if (!$assignment->delete()) {
            throw new \RuntimeException('Deleting error.');
        }
    }
}