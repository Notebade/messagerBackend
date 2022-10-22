<?php
namespace DBConnection;

use PDO;
use PDOException;

class DBConnect
{
    /**
     * @var PDO
     */
    private PDO $pdo;

    /**
     * DBConnect constructor.
     */
    public function __construct()
    {
        try {
            $this->pdo = new PDO('sqlite:'.$_SERVER['DOCUMENT_ROOT'] ."/src/DataBase/message.db")/*.getenv('DB_SRC'))*/;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
        return $this;
    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}