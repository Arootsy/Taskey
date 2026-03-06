<?php

namespace App\Repositories;

use App\Model\Task;

interface TaskRepositoryInterface
{
    /** @return Task[] */
    public function all(): array;

    /** @return ?Task[] */
    public function find(int $id): ?Task;

    public function insert(Task $task): ?Task;

    public function delete(Task $task): bool;

    public function update(Task $task): bool;
}
