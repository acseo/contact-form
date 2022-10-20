<?php

namespace App\Controller;

use DateTime;
use App\Repository\ContactRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminFromJsonFileController extends AbstractController
{
    private $m_jsonFile ;
    private $m_filesystem;

    public function __construct() 
    {
        
    }



    #[Route('/admin/from_json_file', name: 'app_admin_from_json_file')]
    #[IsGranted('ROLE_ADMIN', message: "Vous n'avez pas les droits suffisants pour accéder")]    
    /**
     * admin
     * Méthode permettant d'accéder aux données stockés dans le fichiers Json avec un rôle admin
     *
     * @return Response
     */
    public function adminFormJsonFile(Request $request, SerializerInterface $serializer, ContactRepository $contactRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        if($this->isGranted('ROLE_ADMIN'))
        {
            $data = $this->readJsonFile();
            
            $defaultData = ['eeeeeee' => 'Type your message here']; 
            $form = $this->createFormBuilder($defaultData)
                ->add('message', TextareaType::class, ['disabled' => true])
                ->add('date', null, ['disabled' => true])
                ->add('resolved', CheckboxType::class)
                ->getForm();
            

            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $dataUpated = $form->getData();

            // ... perform some action, such as saving the task to the database

            //return $this->redirectToRoute('task_success');
        }

            return $this->renderForm('admin_from_json_file/index.html.twig', [
                'data' => $data,
                'form' => $form
            ]);
        }
        else 
        {
            $this->redirectToRoute('app_login');
        }
    }

    
    


    /**
     * readJsonFile : 
     * Méthode permettant de récupérer les données depuis un fichier JSON
     *
     * @return array
     */
    private function readJsonFile(): array
    {
        $data = array();
        $filesystem = new Filesystem();

        $jsonFile = $this->getParameter('app.json_file') . '/acseo.json';

        if($filesystem->exists($jsonFile)){
            $jsonData = file_get_contents($jsonFile);
            // On récupère les données dans le fichier
            $data = json_decode($jsonData, true);
        }
        return $data;
    }
}
