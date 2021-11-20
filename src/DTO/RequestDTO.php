<?php

namespace App\DTO;

use App\Entity\Request;
use Symfony\Component\Validator\Constraints as Assert;

class RequestDTO
{
    /**
     * @Assert\NotBlank(message="Поле должно быть заполнено")
     * @Assert\Length(max=255)
     */
    private ?string $title;

    /**
     * @Assert\NotBlank(message="Поле должно быть заполнено")
     * @Assert\Length(max=10000)
     */
    private ?string $message;

    public static function createFromEntity(Request $request): self
    {
        $dto = new self();
        $dto->setTitle($request->getTitle());
        $dto->setMessage($request->getMessage());

        return $dto;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }


}