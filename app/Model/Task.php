<?php

namespace App\Model;

class Task
{
    public int $id;

    public string $title;

    public string $description;

    public int $priority;

    public int $status;

    public int $progress;

    public int $createdAt;

    public ?int $completedAt;

    public function __construct(
        int $id,
        string $title,
        string $description,
        int $priority,
        int $status,
        int $progress,
        int $createdAt,
        ?int $completedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->priority = $priority;
        $this->status = $status;
        $this->progress = $progress;
        $this->createdAt = $createdAt;
        $this->completedAt = $completedAt;
    }
}
