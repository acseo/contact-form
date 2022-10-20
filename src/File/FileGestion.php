<?php	


namespace App\File;

use DateTime;
use Exception;
use ProxyManager\ProxyGenerator\ValueHolder\MethodGenerator\Constructor;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
	
	class FileGestion
	{
        private $m_jsonFile ;
		private $m_fileSystem ;
        
        
        
        public function __construct($fileSystem, $jsonFile)
        {
            

        }

        

		/**
         * createJsonFileFromData :
         *
         * Méthode qui va traiter les données fournis dans le formulaire. 
         * Ces données sont passées en paramètres sous forme de tableau.
         * Elles sont après traitement convertis en fichier Json. 
         *
         * @param  array $dataForm : tableau des données fourni par le formulaire de contact
         * 
         * @return void
         */
        public function createJsonFromData(array $dataForm, SerializerInterface $serializer): void
        {
            $date = new DateTime();
            $today = $date->format('d-m-Y');
            $data = $this->getDataFormFile();
            $dataToJson = array();
            
            // On regarde dans le fichier qui existe si c'est une personee qui a déjà envoyer un ou d'autres message
            //
            if(empty($data)){
                $data = $this->createNewEntry($dataForm, $today);
                $dataToJson  = array(
                    1 => $data
                );
            }
            else {
                // On parcour notre tableau
                foreach($data as $key => $value)
                {
                    //ON vérifie si l'email de l'utilisateur est déjà présent
                    if($value['id'] === $dataForm['email']) {
                        dump(key($value['messages']));
                        $idMessage = count($value['messages']) + 1;
                        // Si présent on créer un tableau avec le message pour l'ajouter au tableau des message de cet utilisateur
                        $newMessage = array(
                            'id' => $idMessage,
                            'date' => $today,
                            'message' => $dataForm['message'],
                            'resolved' => false 
                        );
                        // On lui ajoute le message
                        $value['messages'][] = $newMessage;
                        $data[$key] = $value;
                    }
                    else{
                        // Si l'email n'est pas présent, on créer un nouveau tableau pour enter les données
                        $data[] = $this->createNewEntry($dataForm, $today); 
                    }
                    $dataToJson = $data;
                }
            }
            $jsonData = $serializer->serialize($dataToJson, 'json');
            // On encode le fichiers
            //$jsonData = json_encode($dataToJson, JSON_OBJECT_AS_ARRAY|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_LINE_TERMINATORS|JSON_NUMERIC_CHECK);
            
            $this->writeToFile($jsonData);
        }
        
        /**
         * createNewEntry :
         * Méthoe qui va créer un nouveau tableau avec les données passées en paramètre
         *
         * @param array $data : données sous forme de tableau à traiter
         * @param string $today : date du jour sous forme de string formatté d-m-Y
         * @param SerializerInterface $serializer pour la gestikon de la sérialisation en json
         *  
         * @return array
         */
        private function createNewEntry(array $data, string $today): array
        {

        // Si l'email n'est pas présent, on créer un nouveau tableau pour enter les données
        return  array(
                'id' => $data['email'],
                'user' => array(
                    'name' => $data['name'] ,
                    'email' => $data['email']
                ),
                'messages' => array(
                    1 =>
                    array (
                        'id' => 1,
                        'date' => $today,
                        'message' => $data['message'],
                        'resolved' => false
                    )
                )
            ); 
            
            // return $val;
        }
        
    

        
        /**
         * fileExist
         *
         * @return bool
         */
        private function fileExist(): bool
        {
            return $this->m_fileSystem->exists($this->m_jsonFile); ;
        }

        
        /**
         * writeToFile
         *
         * @param  mixed $jsonData
         * @return void
         */
        private function writeToFile($jsonData)
        {
            // On écrit les données au format json dans le fichier
            try{
                $this->m_fileSystem->dumpFile($this->m_jsonFile, $jsonData);
            }
            catch (Exception $exception) {
                throw  $exception;
            }
        }


        
        /**
         * getDataFormFile : 
         * Méthode permettant de récupérer les données depuis un fichier JSON
         *
         * @return array
         */
        private function getDataFormFile(): array
        {
            $data = array();
        
            if($this->fileExist()){
                $jsonFile = file_get_contents($this->m_jsonFile);
                // On récupère les données dans le fichier
                $data = json_decode($jsonFile, true);
            }
            return $data;
        }
	}
	