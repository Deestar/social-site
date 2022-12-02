<?php
class pdoConnect
{
    protected $dbhost = "localhost";
    protected $dbUsername = "root";
    protected $dbPassword = "";
    protected $dbName = "lasu_site";
    protected function connect()
    {
        $dbserverinfo = 'mysql:host=' . $this->dbhost . ';dbname=' . $this->dbName;
        $pdo = new PDO($dbserverinfo, $this->dbUsername, $this->dbPassword);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}
