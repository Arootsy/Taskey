<?php

namespace App\Model;

class Project
{
    public int $id;

    public string $title;

    public string $description;

    public function __construct(int $id, string $title, string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }
}