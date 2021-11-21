<?php

namespace App\DTO;

class UserDTO
{
    private ?string $email;
    private ?string $plainPassword;
    private ?string $hashedPassword;

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getHashedPassword(): ?string
    {
        return $this->hashedPassword;
    }

    public function setHashedPassword(?string $hashedPassword): void
    {
        $this->hashedPassword = $hashedPassword;
    }

}