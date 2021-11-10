<?php

namespace App\Entity;

use App\DTO\RequestDTO;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RequestRepository")
 */
class Request
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(name="message", type="text", length=10000)
     */
    private string $message;

    /**
     * @ORM\Column(name="status", type="smallint", options={"default" : 0})
     */
    private int $status = 0;

    /**
     * @ORM\Column(name="create_at", type="datetime")
     */
    private DateTime $createAt;

    public function __construct(string $title, string $message)
    {
        $this->title = $title;
        $this->message = $message;
        $this->createAt = new DateTime();
    }

    public static function createFromDTO(RequestDTO $dto): self
    {
        return new self($dto->getTitle(), $dto->getMessage());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getCreateAt(): DateTime
    {
        return $this->createAt;
    }

}