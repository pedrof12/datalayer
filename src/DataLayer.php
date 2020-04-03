<?php

namespace PedroF12\Datalayer;
use PDO;

class DataLayer extends Connect
{
    protected $table;

    private $statment;

    private $sql;

    private $limit;

    private $by1;

    private $by2;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function get(string $row = "*")
    {
        $conn = self::$instance;

        $this->sql = "SELECT {$row} FROM {$this->table}";

        $this->statment = $conn->prepare($this->sql);

        $this->statment->execute();

        return $this;
    }

    public function limit(int $limit = 10)
    {
        $conn = self::$instance;

        $this->limit = $limit;

        $this->sql = $this->sql." LIMIT {$limit}";

        $this->statment = $conn->prepare($this->sql);

        $this->statment->execute();

        return $this;
    }

    public function findBy($row, $sta)
    {
        $conn = self::$instance;

        $this->sql = $this->sql." WHERE {$row} = '{$sta}'";

        $this->statment = $conn->prepare($this->sql);

        $this->statment->execute();

        return $this;
    }

    public function fetch()
    {
        $conn = self::$instance;

        $this->statment = $this->statment->fetchAll(PDO::FETCH_OBJ);

        return $this;
    }


    public function foreach()
    {
        $conn = self::$instance;

        return $this->statment;
    }

    public function count()
    {
        $conn = self::$instance;

        return count($this->statment);
    }
}