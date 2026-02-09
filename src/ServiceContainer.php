<?php

namespace Framework;

use Exception;

class ServiceContainer
{
    /** @var array<class-string, object>  */
    private array $instances = [];

    /**
     * @param class-string $id
     * @param object $object
     * @throws Exception
     */
    public function set(string $id, object $object): void
    {
        if (isset($this->instances[$id])) {
            throw new Exception('Target binding [$id] already exists');
        }
        $this->instances[$id] = $object;
    }

    /**
     * @throws Exception
     */
    public function get(string $id): object
    {
        if (!isset($this->instances[$id])) {
            throw new Exception("Service [$id] not found.");
        }

        return $this->instances[$id];
    }
}
