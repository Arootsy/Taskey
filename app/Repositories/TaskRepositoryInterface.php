<?php

namespace App\Repositories;

use App\Model\Task;

interface TaskRepositoryInterface
{
    /** @return Task[] */
    public function all(): array;

    /** @return ?Task[] */
    public function find(int $id): ?Task;
}