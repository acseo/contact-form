<?php


namespace App\Service;


use App\Beans\Service\Personne\SavePersonneBean;

class PersonneJsonService
{
    private string $jsonDirectory;

    /**
     * PersonneJsonService constructor.
     * @param string $jsonDirectory
     */
    public function __construct(string $jsonDirectory)
    {
        $this->jsonDirectory = $jsonDirectory;
    }


    public function saveJson(SavePersonneBean $savePersonneBean): void
    {
        $infoToJson = [
            'nom' => $savePersonneBean->getNom(),
            'email' => $savePersonneBean->getEmail(),
            'question' => $savePersonneBean->getQuestion(),
        ];

        $now = new \DateTime();
        $jsonData = json_encode($infoToJson);
        $filename = $this->jsonDirectory
            .'contact'
            . $savePersonneBean->getNom()
            . $now->format('Ymdis')
            . '.json';

        file_put_contents($filename, $jsonData);
    }
}