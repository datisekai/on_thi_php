<?php
class Database
{
    public $host = 'localhost';
    public $host_user = 'root';
    public $host_pass = '';
    public $db_name = 'onthi';
    public $connect;

    public function __construct()
    {
        $this->connectDB();
    }

    private function connectDB()
    {
        $this->connect = new mysqli($this->host, $this->host_user, $this->host_pass, $this->db_name);
        if (!$this->connect) {
            echo '<p>Failed connect</p>';
        }
        echo '<p>connected</p> ';
    }

    public function excuteCustom($query)
    {
        $result = $this->connect->query($query);
        return $result;
    }
}
