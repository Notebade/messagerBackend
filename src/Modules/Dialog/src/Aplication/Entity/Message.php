<?php

namespace Dialog\Aplication\Entity;

class Message
{
    private mixed $id;

    private mixed $text;

    private mixed $userId;

    private mixed $date;

    public function __construct($data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->text = $data['text'] ?? null;
        $this->date = date('Y.m.d H:m:s');
        $this->userId = $data['userId'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getText(): mixed
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText(mixed $text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getUserId(): mixed
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId(mixed $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getDate(): mixed
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate(mixed $date): void
    {
        $this->date = $date;
    }


}