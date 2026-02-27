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

    private function fromDbRecord(mixed $row): Task {
        return new Task(
            $row['id'],
            $row['title'],
            $row['description'],
            $row['priority'],
            $row['status'],
            $row['progress'],
            $row['created_at'],
            $row['completed_at']
        );
    }

    /** @return Task[]  */
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
        $result = $this->database->run('SELECT * FROM tasks WHERE :id;', ['id' => $id ])->fetch();
        return $this->fromDbRecord($result);
    }
}
