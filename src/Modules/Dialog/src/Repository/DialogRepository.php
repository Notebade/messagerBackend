<?php

namespace Dialog\Repository;

use Adapters\SQLiteAdapter;

use Dialog\Aplication\Entity\Dialog;
use Dialog\Aplication\Entity\Message;
use User\Aplication\Entity\User;

class DialogRepository extends SQLiteAdapter
{
    public function createDialog(Dialog $dialog): \PDOException|\Exception|bool|string
    {
        $sql = "INSERT INTO dialog (
                    'date',
                    'user_id'
                  )
                VALUES (
                    '{$dialog->getDate()}',
                    '{$dialog->getUser()->getId()}'
                        )";
        $this->insert($sql);
        return $this->getLastAdd();
    }

    public function dialogConnect(Dialog $dialog): \PDOException|\Exception|bool|string
    {
        $sql = "INSERT INTO user_dialog (
                    'user_Id',
                    'dialog_id'
                  )
                VALUES (
                    '{$dialog->getUser()->getId()}',
                    '{$dialog->getId()}'
                        )";
        $this->insert($sql);
        return $this->getLastAdd();
    }

    public function send(Dialog $dialog): \PDOException|\Exception|bool|string
    {
        $result = true;
        $dialog->setMessage((new Message(['id' => $this->sendDialog($dialog)])));
        $result &= $this->insertDialogInfo($dialog);
        return $result;
    }

    public function listDialog(User $user): array
    {
        $result = [];
        $sql = "SELECT 
                    d.id, 
                    d.date, 
                    d.user_id 
                FROM dialog d 
                WHERE d.user_id = {$user->getId()}";
        foreach ($this->select($sql)->fetchAll() as $value) {
            $result[] = new Dialog($value);
        }
        return $result;
    }

    public function leaveDialog(User $user)
    {
        //$sql = "DELETE FROM user_dialog ud WHERE ud.dialog_id = {} AND ud.user_id = {}";
    }

    private function sendDialog(Dialog $dialog): \PDOException|\Exception|bool|string
    {
        $sql = "INSERT INTO message (
                    'text',
                    'user_Id',
                    'date'
                  )
                VALUES (
                    '{$dialog->getMessage()->getText()}',   
                    '{$dialog->getUser()->getId()}',
                    '{$dialog->getMessage()->getDate()}'
                        )";
        $this->insert($sql);
        return $this->getLastAdd();
    }

    private function insertDialogInfo(Dialog $dialog): \PDOException|\Exception|bool|string
    {
        $sql = "INSERT INTO message_dialog (
                    'message_id',
                    'dialog_id'
                  )
                VALUES (
                    '{$dialog->getMessage()->getId()}',
                    '{$dialog->getId()}'
                        )";
        $this->insert($sql);
        return $this->getLastAdd();
    }

    public function updateDialog(User $user)
    {
        /*$userArray = \User\Presenter\User::present($user);
        return $this->updateRow('user', $userArray, $user->getId());*/
    }

    public function deleteDialog(int $id): \PDOException|\Exception|bool|\PDOStatement
    {
        return $this->delete("DELETE FROM dialog WHERE id = {$id}");
    }

    public function getDialogById($data = []): array
    {
        $result = [];
        $sql = "SELECT 
                    d.id,
                    d.date,
                    m.user_id AS userId,
                    m.id AS messageId,
                    m.text,
                    m.date AS dateSend
                FROM dialog d 
                LEFT JOIN message_dialog md ON md.dialog_id = d.id 
                LEFT JOIN message m ON m.id = md.message_id
                WHERE d.id = {$data['id']} LIMIT {$data['limit']}";
        foreach ($this->select($sql)->fetchAll() as $value) {
            $result[] = new Dialog([
                'id' => $value['id'],
                'date' => $value['date'],
                'user' => [
                    'id' => $value['userId']
                ],
                'message' => [
                    'id' => $value['messageId'],
                    'text' => $value['text'],
                    'date' => $value['dateSend']
                ]
            ]);;
        }
        return $result;
    }
}