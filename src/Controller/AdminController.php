<?php

namespace App\Controller;

use Exception;
use App\Form\AdminContactsType;
use App\Form\MessagesContactType;
use Symfony\Component\Mime\Message;
use App\Repository\ContactRepository;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

class AdminController extends AbstractController
{
    private $m_jsonFile ;
    private $m_filesystem;

    public function __construct() 
    {
        
    }



    #[Route('/admin', name: 'app_admin')]
    #[IsGranted('ROLE_ADMIN', message: "Vous n'avez pas les droits suffisants pour accéder")]    
    /**
     * admin
     * Méthode permettant d'accéder aux données stockés dans le fichiers Json avec un rôle admin
     *
     * @return Response
     */
    public function admin(Request $request, SerializerInterface $serializer, ContactRepository $contactRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        if($this->isGranted('ROLE_ADMIN'))
        { 
            $contacts = $contactRepository->findAll();
            
            return $this->render('admin/index.html.twig', [
                'contacts' => $contacts
            ]);
        }
        else 
        {
            $this->redirectToRoute('app_login');
        }
    }

    
    #[Route('/admin/update_data/{idMessage}', name:'app_update_data')]
    #[IsGranted('ROLE_ADMIN', message: "Vous n'avez pas les droits suffisants pour accéder")]
    public function updateData(Request $request, int $idMessage, MessageRepository $messageRepository, EntityManagerInterface $em , SerializerInterface $serializer )
    {
        $message = $messageRepository->find($idMessage);
        // retrieves GET and POST variables respectively
        $resolved = !$message->isResolved();
        $message->setResolved( $resolved );

        $em->persist($message);
        $em->flush();
        // On retourne une réponse
        $id = $message->getId();
        $resolu = "La modification pour le message n° $id s'est bien passé. Il est marqué comme résolu ";
        //return new JsonResponse($jsonMessage, Response::HTTP_OK, [], true);
        return new response($resolu, 201);
    }

    #[Route('/admin/export', name: 'app_admin_export')]
    #[IsGranted('ROLE_ADMIN', message: "Vous n'avez pas les droits suffisants pour accéder")]
    public function export(Request $request, ContactRepository $contactRepository, SerializerInterface $serializer)
    {
        try {
            $listContact = $contactRepository->findAll();
            $arrayContact = array();
            
            foreach($listContact as $key => $value) {
                $messages = array();
                foreach($value->getMessages() as $messageKey => $message) {
                    dump($message);
                    $messages[] = array (
                        'key' => $messageKey + 1,
                        'message' => $message->getMessage(),
                        'date' => $message->getDateMessage(),
                        'resolved' => $message->isResolved()
                    );

                }
                
                $val = array(
                    'id' => $key + 1,
                    'name' => $value->getName(),
                    'email' => $value->getEmail(),
                    'messages' => $messages
                );
                $arrayContact[] = $val;
            }


            $fileSystem = new Filesystem();
            $context = (new ObjectNormalizerContextBuilder())
                ->withGroups('getMessages');
            
            $fileSystem->mkdir($this->getParameter('app.json_file')); 
            $jsonFile = $this->getParameter('app.json_file') . '/acseo.json';
            $jsonContact = $serializer->serialize($arrayContact, 'json');
            $fileSystem->dumpFile($jsonFile, $jsonContact);

        }
        catch(IOException $ioEsception) {
            $title = "Une Exception s'est produite avec le code : " . $ioEsception->getCode();
            $message = $ioEsception->getMessage();
            return $this->render('exception/exception.html.twig', [
                '$title' => $title,
                'message' => $message
            ]);
        }
        catch(Exception $Esception) {
            $title = "Une Exception s'est produite avec le code : " . $Esception->getCode();
            $message = $Esception->getMessage();
            return $this->render('exception/exception.html.twig', [
                '$title' => $title,
                'message' => $message
            ]);
        }
        
        return new Response("L'exportation s'est bien passé", 201);
    }

}
