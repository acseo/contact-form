<?php


namespace App\Entity;

use App\Entity\MyTrait\idTrait;
use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 * @ORM\Table(name="question")
 */
class Question
{

   use idTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $commentaire;

    /**
     * @var bool
     *
     *@ORM\Column(type="boolean", options={"default":0})
     */
    private $validee = false;

    /**
     * @var Personne
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne", inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $personne;

    /**
     * @return string
     */
    public function getCommentaire(): string
    {
        return $this->commentaire;
    }

    /**
     * @param string $commentaire
     * @return self
     */
    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;
        return $this;
    }

    /**
     * @return bool
     */
    public function isValidee(): bool
    {
        return $this->validee;
    }

    /**
     * @param bool $validee
     */
    public function setValidee(bool $validee): void
    {
        $this->validee = $validee;
    }

    /**
     * @return Personne
     */
    public function getPersonne(): Personne
    {
        return $this->personne;
    }

    /**
     * @param Personne $personne
     * @return self
     */
    public function setPersonne(Personne $personne): self
    {
        $this->personne = $personne;
        return $this;
    }





}