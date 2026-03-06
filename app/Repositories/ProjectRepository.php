<?php

namespace App\Repositories;

use App\Model\Project;
use Framework\Database;

class ProjectRepository implements ProjectRepositoryInterface
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    private function fromDbRecord(mixed $row): Project
    {
        return new Project(
            (int)$row['id'],
            $row['title'],
            $row['description']
        );
    }

    /** @return Project[] */
    public function all(): array
    {
        $projects = [];
        $results = $this->database->query('SELECT * FROM projects');

        foreach ($results as $result) {
            $projects[] = $this->fromDbRecord($result);
        }

        return $projects;
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): ?Project
    {
        // TODO: Implement find() method.
    }

    public function insert(Project $Project): ?Project
    {
        // TODO: Implement insert() method.
    }

    public function delete(Project $Project): bool
    {
        // TODO: Implement delete() method.
    }

    public function update(Project $Project): bool
    {
        // TODO: Implement update() method.
    }
}