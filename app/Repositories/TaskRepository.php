<?php

namespace App\Repositories;

use App\Model\Task;

class TaskRepository implements TaskRepositoryInterface
{
    /** @var array<int, mixed> */
    private array $tempTasks = array(
        array(
            "id" => 1,
            "title" => "Form the Fellowship",
            "description" => "Assemble representatives of the Free Peoples in Rivendell",
            "priority" => 3,
            "status" => 4,
            "progress" => 100,
            "created_at" => 1008710400,
            "completed_at" => 1008720400),
        array(
            "id" => 2,
            "title" => "Cross the Misty Mountains",
            "description" => "Find a safe passage through or around the mountains",
            "priority" => 2,
            "status" => 1,
            "progress" => 50,
            "created_at" => 1008720400,
            "completed_at" => null),
        array(
            "id" => 3,
            "title" => "Enter Moria",
            "description" => "Take the risky path through the Mines of Moria",
            "priority" => 2,
            "status" => 3,
            "progress" => 0,
            "created_at" => 1008740400,
            "completed_at" => null)
    );

    /** @return Task[]  */
    public function all(): array
    {
        $tasks = [];

        foreach ($this->tempTasks as $tempTask) {
            $tasks[$tempTask['id']] = new Task(
                $tempTask['id'],
                $tempTask['title'],
                $tempTask['description'],
                $tempTask['priority'],
                $tempTask['status'],
                $tempTask['progress'],
                $tempTask['created_at'],
                $tempTask['completed_at']
            );
        }

        return $tasks;
    }

    /** @return ?Task[] */
    public function find(int $id): ?array
    {
        return $this->tempTasks[$id] ?? null;
    }
}
