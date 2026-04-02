<?php
$host = 'localhost';
$db_name = 'u454754858_hempsuccess';
$username = 'u454754858_hassaanmumtaz2';
$password = 'hassaanmumtaz2';

class NullPDOStatement
{
    public function execute($params = null)
    {
        return false;
    }

    public function fetch($mode = null)
    {
        return false;
    }

    public function fetchAll($mode = null)
    {
        return [];
    }

    public function fetchColumn($column = 0)
    {
        return 0;
    }
}

class NullPDO
{
    public function query($query)
    {
        return new NullPDOStatement();
    }

    public function prepare($query, $options = null)
    {
        return new NullPDOStatement();
    }

    public function exec($statement)
    {
        return 0;
    }
}

// Keep frontend rendering even if DB is temporarily unavailable.
$pdo = new NullPDO();

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $pdo = new NullPDO();
}

?>