<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use App\Repository\MessageRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(["getMessages", "getContact"])]
    private ?string $message = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(["getMessages", "getContact"])]
    private ?\DateTimeInterface $dateMessage = null;

    #[ORM\Column(nullable: true)]
    #[Groups(["getMessages", "getContact"])]
    private ?bool $resolved = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["getContact"])]
    private ?Contact $Contact = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDateMessage(): ?\DateTimeInterface
    {
        return $this->dateMessage;
    }

    public function setDateMessage(\DateTimeInterface $dateMessage): self
    {
        $this->dateMessage = $dateMessage;

        return $this;
    }

    public function isResolved(): ?bool
    {
        return $this->resolved;
    }

    public function setResolved(?bool $resolved): self
    {
        $this->resolved = $resolved;

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->Contact;
    }

    public function setContact(?Contact $Contact): self
    {
        $this->Contact = $Contact;

        return $this;
    }

}
