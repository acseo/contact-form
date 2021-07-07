<?php


namespace App\Beans\Service\Personne;


class SavePersonneBean
{
    private string $nom;

    private string $email;

    private string $question;

    /**
     * SavePersonneBean constructor.
     * @param string $nom
     * @param string $email
     * @param string $question
     */
    public function __construct(string $nom, string $email, string $question)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }




}