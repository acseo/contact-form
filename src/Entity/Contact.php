<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 * @UniqueEntity("email")
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email( message = "The email '{{ value }}' is not a valid email." )
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="contact")
     */
    private $messages;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of messages
     */ 
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set the value of messages
     *
     * @return  self
     */ 
    public function setMessages($messages)
    {
        $this->messages = $messages;

        return $this;
    }
}
