<?php

namespace User\Presenter;

use JetBrains\PhpStorm\ArrayShape;

class User
{
    #[ArrayShape(['id' => "mixed", 'token' => "mixed", 'date' => "mixed", 'keyAdd' => "mixed", 'info' => "mixed"])]
    public static function present(\User\Aplication\Entity\User $user): array
    {
        return [
            'id' => $user->getId(),
            'token' => $user->getToken(),
            'date' => $user->getDate(),
            'keyAdd' => $user->getKeyId(),
            'info' => $user->getInfo(),
        ];
    }

    public static function presentCollection(array $users): array
    {
        $result = [];
        foreach ($users as $user) {
            $result[] = [
                'id' => $user->getId(),
                'token' => $user->getToken(),
                'date' => $user->getDate(),
                'keyAdd' => $user->getKeyId(),
                'info' => $user->getInfo(),
            ];
        }
        return $result;
    }

}