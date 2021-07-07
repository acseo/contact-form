<?php


namespace App\Service;


use App\Beans\Service\Personne\SavePersonneBean;
use App\Entity\Personne;
use App\Entity\Question;
use App\Repository\PersonneRepository;

class PersonneService
{

    /**
     * PersonneService constructor.
     */
    public function __construct(PersonneRepository $personneRepository)
    {
        $this->personneRepository = $personneRepository;
    }

    public function save(SavePersonneBean $savePersonneBean): Personne
    {
        $personne = $this->personneRepository->findOneBy(['email' => $savePersonneBean->getEmail()]);

        if (null === $personne) {
            $personne = new Personne();
            $personne->setNom($savePersonneBean->getNom());
            $personne->setEmail($savePersonneBean->getEmail());
        }

        $question = new Question();
        $question->setCommentaire($savePersonneBean->getQuestion());
        $personne->addQuestion($question);
        return $personne;
    }


}