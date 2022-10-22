<?php

namespace User\Repository;

use Adapters\SQLiteAdapter;
use User\Aplication\Entity\User;

class UserRepository extends SQLiteAdapter
{
    public function createUser(User $user): \PDOException|\Exception|bool|string
    {
        $sql = "INSERT INTO user (
                    'token',
                    'date', 
                    'keyAdd',
                    'info'
                  )
                VALUES (
                    '{$user->getToken()}', 
                    '{$user->getDate()}', 
                    '{$user->getKeyId()}',
                    '{$user->getInfo()}'
                        )";
        $this->insert($sql);
        return $this->getLastAdd();
    }

    public function updateUser(User $user): \PDOException|\Exception|bool|string
    {
        $userArray = \User\Presenter\User::present($user);
        return $this->updateRow('user', $userArray, $user->getId());
    }

    public function deleteUser(int $id): \PDOException|\Exception|bool|\PDOStatement
    {
        return $this->delete("DELETE FROM USER WHERE id = {$id}");
    }

    public function getUsers(): array
    {
        $result = [];
        $sql = "SELECT * FROM user";
        foreach ($this->select($sql)->fetchAll() as $value) {
            $result[] = new User($value);
        }
        return $result;
    }

    public function getUserById(int $id): User
    {
        $result = new User();
        $sql = "SELECT * FROM user WHERE id = {$id}";
        foreach ($this->select($sql)->fetchAll() as $value) {
            $result = new User($value);
        }
        return $result;
    }

    public function findUser($token): User
    {
        $result = new User();
        $sql = "SELECT * FROM user WHERE token = '$token'";
        foreach ($this->select($sql)->fetchAll() as $value) {
            $result = new User($value);
        }
        return $result;
    }
}