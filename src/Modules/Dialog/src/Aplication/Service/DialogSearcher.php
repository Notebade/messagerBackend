<?php

namespace Dialog\Aplication\Service;


use Dialog\Aplication\Entity\Dialog;
use Dialog\Repository\DialogRepository;
use JetBrains\PhpStorm\ArrayShape;
use User\Aplication\Entity\User;

class DialogSearcher
{
    private function getRepository(): DialogRepository
    {
        return new DialogRepository();
    }

    public function createDialog(array $data = []): \PDOException|\Exception|bool|string
    {
        $result = true;
        $dialog = new Dialog($data);
        $dialog->setId($this->getRepository()->createDialog($dialog));
        $result &= $this->getRepository()->dialogConnect($dialog);
        return $result;
    }

    public function connectDialog(array $data = []): \PDOException|\Exception|bool|string
    {
        $result = true;
        $dialog = new Dialog($data);
        $result &= $this->getRepository()->dialogConnect($dialog);
        return $result;
    }

    /**
     * @param array $data
     * @return array
     */
    public function getDialogById(array $data = []): array
    {
        $data['limit'] = $data['limit'] ?? 100;
        return \Dialog\Presenter\Dialog::presentCollectionDialog($this->getRepository()->getDialogById($data));
    }

    public function sendDialog($data)
    {
        $result = true;
        $dialog = new Dialog($data);
        $result &= $this->getRepository()->send($dialog);
        return $result;
    }

    public function listDialogs(User $user): array
    {
        return \Dialog\Presenter\Dialog::presentCollectionListDialog($this->getRepository()->listDialog($user));;
    }

    public function leaveDialog(User $user): array
    {
        return $this->getRepository()->leaveDialog($user);;
    }
}