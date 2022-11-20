<?php

namespace app\repositories;

use app\models\Position;
use app\repositories\exceptions\NotFoundException;

class PositionRepository
{
    /**
     * @param int $id
     * @return Position
     * @throws NotFoundException
     */
    public function find(int $id): Position
    {
        if (!$position = Position::findOne($id)) {
            throw new NotFoundException('Model not found.');
        }
        return $position;
    }

    public function add(Position $position): void
    {
        if (!$position->getIsNewRecord()) {
            throw new \RuntimeException('Adding existing model.');
        }
        if (!$position->insert(false)) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function save(Position $position): void
    {
        if ($position->getIsNewRecord()) {
            throw new \RuntimeException('Saving new model.');
        }
        if ($position->update(false) === false) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function delete(Position $position): void
    {
        if (!$position->delete()) {
            throw new \RuntimeException('Deleting error.');
        }
    }
}