<?php
namespace Config;

use mysqli;

class Database
{
    private $host     = '127.0.0.1';
    private $db       = 'task_api';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db);

        if ($this->conn->connect_errno) {
            die(json_encode(
                [
                    "error" => "Connection failed",
                ]
            ));
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
