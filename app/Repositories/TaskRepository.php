<?php

namespace App\Repositories;

use App\Model\Task;
use Framework\Database;

class TaskRepository implements TaskRepositoryInterface
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    private function fromDbRecord(mixed $row): Task
    {
        return new Task(
            $row['id'],
            $row['title'],
            $row['description'],
            $row['priority'],
            $row['status'],
            $row['progress'],
            $row['created_at'],
            $row['completed_at'],
            $row['project_id']
        );
    }

    /** @return Task[] */
    public function all(): array
    {
        $tasks = [];
        $results = $this->database->query('SELECT * FROM tasks;');

        foreach ($results as $result) {
            $tasks[] = $this->fromDbRecord($result);
        }

        return $tasks;
    }

    /**
     * @param int $id
     * @return Task
     */
    public function find(int $id): Task
    {
        $result = $this->database
            ->run('SELECT * FROM tasks WHERE id = :id', ['id' => $id])
            ->fetch();
        return $this->fromDbRecord($result);
    }

    public function update(Task $task): bool
    {
        $stmt = $this->database->run('
            UPDATE tasks SET 
            title = :title,
            description = :description,
            priority = :priority,
            status = :status,
            progress = :progress,
            created_at = :created_at,
            completed_at = :completed_at,
            project_id = :project_id
            WHERE id = :id
        ', [
            "id" => $task->id,
            "title" => $task->title,
            "description" => $task->description,
            "priority" => $task->priority,
            "status" => $task->status,
            "progress" => $task->progress,
            "created_at" => $task->createdAt,
            "completed_at" => $task->completedAt,
            "project_id" => $task->project_id
        ]);

        return $stmt->rowCount() == 1;
    }

    public function insert(Task $task): ?Task
    {
        $stmt = $this->database->run('
            INSERT INTO tasks 
            (title, description, priority, status, progress, created_at, completed_at, project_id)
            VALUES
            (:title, :description, :priority, :status, :progress, :created_at, :completed_at, :project_id)
        ', [
            "title" => $task->title,
            "description" => $task->description,
            "priority" => $task->priority,
            "status" => $task->status,
            "progress" => $task->progress,
            "created_at" => $task->createdAt,
            "completed_at" => $task->completedAt,
            "project_id" => $task->project_id == 0 ? null : $task->project_id
        ]);

        $task->id = $this->database->getLastID();

        return $task;
    }

    public function delete(Task $task): bool
    {
        $stmt = $this->database->run("
            DELETE FROM tasks
            WHERE id = :id;
        ", [
            "id" => $task->id
        ]);

        return $stmt->rowCount() == 1;
    }

    /** @return Task[] */
    public function getTaskFromProject(int $project_id): array
    {
        $tasks = [];
        $results = $this->database->query(
            'SELECT * FROM tasks 
            WHERE project_id = :project_id
        ');

        foreach ($results as $result) {
            $tasks[] = $this->fromDbRecord($result);
        }

        return $tasks;
    }
}
