<?php

namespace User\Aplication\Entity;

class User
{
    private mixed $id;

    private mixed $token;

    private mixed $date;

    private mixed $keyId;

    private mixed $info;

    public function __construct($data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->token =  $data['token'] ?? $this->generateToken($data);
        $this->date = $data['date'] ?? date('Y.m.d');
        $this->keyId =  $data['keyAdd'] ?? null;
        $this->info =  $data['info'] ?? null;
    }

    /**
     * @return mixed|null
     */
    public function getInfo(): mixed
    {
        return $this->info;
    }

    /**
     * @param mixed|null $info
     */
    public function setInfo(mixed $info): void
    {
        $this->info = $info;
    }

    private function generateToken($data)
    {
        return md5('putin'.$data['date'].'hublo');
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
    public function getToken(): mixed
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken(mixed $token): void
    {
        $this->token = $token;
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

    /**
     * @return mixed
     */
    public function getKeyId(): mixed
    {
        return $this->keyId;
    }

    /**
     * @param mixed $keyId
     */
    public function setKeyId(mixed $keyId): void
    {
        $this->keyId = $keyId;
    }

}