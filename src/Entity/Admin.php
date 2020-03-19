<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 */
class Admin implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eMail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $roles = [];


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEMail(): ?string
    {
        return $this->eMail;
    }

    public function setEMail(string $eMail): self
    {
        $this->eMail = $eMail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_ADMIN';
        return array_unique($roles);
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->eMail;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
