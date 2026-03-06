<?php

namespace App\Repositories;

use App\Model\Project;

interface ProjectRepositoryInterface
{
    /** @return Project[] */
    public function all(): array;

    /** @return ?Project[] */
    public function find(int $id): ?Project;

    public function insert(Project $Project): ?Project;

    public function delete(Project $Project): bool;

    public function update(Project $Project): bool;
}