<?php

namespace model;

use \PDO;

class Connection extends PDO
{
    private $dsn = "mysql:dbname=blog;host=localhost;port=3306";
    private $user = "root";
    private $password = "";
    private $handle = null;

    public function __construct()
    {
        try {
            if ($this->handle == null) {

                $dbh = parent::__construct($this->dsn, $this->user, $this->password, array(PDO::ATTR_PERSISTENT => true));
                return $this->handle = $dbh;
            }
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->handle = null;
    }
}

?>