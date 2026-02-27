<?php

namespace Framework;

use PDO;
use PDOStatement;

class Database
{
    private PDO $connection;

    public function __construct(string $name)
    {
        $this->connection = new PDO('sqlite:' . $name);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->connection->exec('PRAGMA foreign_keys = ON;');
    }

    public function query(string $sql): PDOStatement
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    /**
     * @param string $sql;
     * @param string[] $params;
     */
    public function run(string $sql, array $params): PDOStatement
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }

    public function exec(string $sql): void
    {
        $this->connection->exec($sql);
    }

    public function migrate(string $directory): void
    {
        if (!is_dir($directory)) {
            die('Migration directory does not exist: {$directory}');
        }

        $files = array_diff(scandir($directory), ['.', '..']);

        sort($files);

        foreach ($files as $file) {
            echo $file;
            $path = $directory . DIRECTORY_SEPARATOR . $file;
            if (!is_file($path) || pathinfo($path, PATHINFO_EXTENSION) !== 'sql') {
                continue;
            }

            $sql = file_get_contents($path);

            if ($sql === false) {
                die('Could not read migration file: {$path}');
            }

            $this->connection->exec($sql);
        }
    }
}
