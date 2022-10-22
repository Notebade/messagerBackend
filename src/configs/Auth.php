<?php

use User\Aplication\Entity\User;
use User\Repository\UserRepository;

class Auth
{
    public User $user;

    public function __construct()
    {
      $this->userInfo($_POST['userHash']);
    }
    private function userInfo($token): void
    {
       $this->user = (new UserRepository())->findUser($token);
    }
}