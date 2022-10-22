<?php

namespace User\Aplication\Service;


use JetBrains\PhpStorm\ArrayShape;
use User\Aplication\Entity\User;
use User\Repository\UserRepository;

class UserSearcher
{
    private function getRepository(): UserRepository
    {
        return new UserRepository();
    }

    /**
     * @param array $data
     * @return \PDOException|\Exception|bool|string
     */
    public function createUser(array $data = []): \PDOException|\Exception|bool|string
    {
        $user = new User($data);
        return $this->getRepository()->createUser($user);
    }

    /**
     * @param $id
     * @return array
     */
    public function getUserById($id): array
    {
        return \User\Presenter\User::present($this->getRepository()->getUserById($id));
    }

    /**
     * @param User $user
     * @return \PDOException|\Exception|bool|string
     */
    public function updateUser(User $user): \PDOException|\Exception|bool|string
    {

        return $this->getRepository()->updateUser($user);
    }

    /**
     * @param User $user
     * @return \PDOException|\Exception|bool|string
     */
    public function deleteUser(User $user): \PDOException|\Exception|bool|string
    {
        return $this->getRepository()->deleteUser($user->getId());
    }
}