<?php

namespace Adapters;

use DBConnection\DBConnect;
use Exception;
use PDOException;
use PDOStatement;

/**
 * Class SQLiteAdapter
 * @package Adapters
 */
class SQLiteAdapter
{
    /**
     * @var DBConnect
     */
    private $pdo;

    /**
     * SQLiteAdapter constructor.
     */
    public function __construct()
    {
        global $pdo;
        if(empty($this->pdo))
        {
            $this->pdo = $pdo->getPdo();
        }
    }

    /**
     * @param $sql
     * @return Exception|false|PDOException|PDOStatement
     */
    protected function select($sql): PDOException|bool|Exception|PDOStatement
    {
        try {
            $result = $this->pdo->query($sql);
        }catch (PDOException $e)
        {
            return $e;
        }
        return $result;
    }

    protected function getLastAdd(): PDOException|bool|Exception|string
    {
        try {
            $result = $this->pdo->lastInsertId();
        }catch (PDOException $e)
        {
            return $e;
        }
        return $result;
    }

    /**
     * @param $sql
     * @return Exception|false|PDOException|PDOStatement
     */
    protected function delete($sql): PDOException|bool|Exception|PDOStatement
    {
        try {
            $result = $this->pdo->query($sql);
        }catch (PDOException $e)
        {
            return $e;
        }
        return $result;
    }

    /**
     * @param $sql
     * @return Exception|false|PDOException|PDOStatement
     */
    protected function update($sql): PDOException|bool|Exception|PDOStatement
    {
        try {
            $result = $this->pdo->query($sql);
        }catch (PDOException $e)
        {
            return $e;
        }
        return $result;
    }

    public function updateRow(string $tableName, array $fieldsValues, int $id): bool
    {
        if (empty($id)) {
            return false;
        }
        $set = self::fieldValuesToSet($fieldsValues);
        $sql = "UPDATE `$tableName` SET $set WHERE id = '$id'";
        try {
            return $this->update($sql);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $sql
     * @return Exception|false|PDOException|PDOStatement
     */
    protected function insert($sql): PDOException|bool|Exception|PDOStatement
    {
        try {
            $result = $this->pdo->query($sql);
        }catch (PDOException $e)
        {
            return $e;
        }
        return $result;
    }

    public static function fieldValuesToSet(array $fieldsValues): string
    {
        $set = array();
        foreach ($fieldsValues as $key => $value) {
            if ($value !== null) {
                if ($value !== 'NULL') {
                    $set[] = $key . "='" . $value . "'";
                } else {
                    $set[] = $key . '=' . $value;
                }
            }
        }
        return implode(", ", $set);
    }
}