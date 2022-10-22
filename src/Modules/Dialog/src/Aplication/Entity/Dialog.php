<?php

namespace Dialog\Aplication\Entity;

use User\Aplication\Entity\User;

class Dialog
{
    private mixed $id;

    private mixed $date;

    private User $user;

    private Message $message;

    public function __construct($data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->date = date('Y.m.d');
        $this->user = new User($data['user']);
        $this->message = new Message($data['message']);
    }

    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

    /**
     * @param Message $message
     */
    public function setMessage(Message $message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed|null
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param mixed|null $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed|null
     */
    public function getDate(): mixed
    {
        return $this->date;
    }

    /**
     * @param mixed|null $date
     */
    public function setDate(mixed $date): void
    {
        $this->date = $date;
    }
}