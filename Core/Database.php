<?php

namespace Core;

use PDO;

require base_path('config.php');

class Database
{
    public $connection;
    public $statement;
    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        //dd($dsn);
        $this->connection = new PDO($dsn, $username, $password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        //dd($this->connection);
    }

    public function query($query, $params = [])
    {

        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        //return $statement; // This returns the PDOStatement object that has fetch or fetch all methods 
        return $this;
    }
    public function find()
    {
        return $this->statement->fetch();
    }
    public function get()
    {
        return $this->statement->fetchAll();
    }
    public function findORFail()
    { // to use db=>query()->findorFail
        $result = $this->find();
        if (!$result) {
            abort(404);
        }
        return $result;
    }
    /**
     * Execute a query and return all results as array
     * @param string $query The SQL query
     * @param array $params The parameters for prepared statement
     * @return array
     */
    // public function fetchAll($query, $params = []): array
    // {
    //     $statement = $this->query($query, $params);
    //     return $statement->fetchAll();
    // }

    /**
     * Execute a query and return single result
     * @param string $query The SQL query
     * @param array $params The parameters for prepared statement
     * @return array|null
     */
    // public function fetch($query, $params = []): ?array
    // {
    //     $statement = $this->query($query, $params);
    //     return $statement->fetch() ?: null;
    // } 
}
