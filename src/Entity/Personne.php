<?php

namespace App\Entity;

use App\Entity\MyTrait\idTrait;
use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 * @ORM\Table(name="personne")
 */
class Personne
{
    use idTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min=1, max=50)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     * @Assert\Email()
     *
     */
    private $email;

    /**
     * @var Question[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="personne", cascade={"persist"})
     *
     */
    private $questions;

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    /**
     * @param Question $question
     */
    public function addQuestion(Question $question): void
    {
        $question->setPersonne($this);
        $this->questions[] = $question;
    }








}
