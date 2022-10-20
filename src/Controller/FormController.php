<?php

namespace App\Controller;

use DateTime;

use Exception;
use App\Entity\Contact;
use App\Entity\Message;

use App\Form\MessageType;
use App\Repository\ContactRepository;
use Symfony\Component\Filesystem\Path;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

class FormController extends AbstractController
{

    function __construct()
    {
        
    }

    #[Route('/contact', name: 'app_contact', methods: ['POST'])]    
    /**
     * index
     * Méthode permettant d'afficher le formulaire
     *
     * @param  Request $request gère les requêtes reçus
     * @param SerializerInterface $serializer pour la gestikon de la sérialisation en json
     * 
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $em, ContactRepository $contactRepository, ManagerRegistry $doctrine, SerializerInterface $serializer): Response
    {
        // On construit le formulaire
        //$defaultData = ['nom' => '', 'email'=> '', 'resolved'=> false, 'message' => ''];
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        
        $form->handleRequest($request);
        
        if ($request->isMethod('POST')) {
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isSubmitted() && $form->isValid()) {
                // data is an array with "name", "email", and "message" keys
                try{
                    $message = $form->getData();
                    $date = new DateTime();
                    $today = $date->format('d-m-Y'); 
                    $message->setDateMessage($date);
                    $message->setResolved(false);
                    $contact = $contactRepository->findOneBy(['email' => $message->getContact()->getEmail()]);
                   
                    if($contact === null)
                    {
                        $contact = new Contact();
                        $contact->setName($message->getContact()->getName());
                        $contact->setEmail($message->getContact()->getEmail());
                        $contact->addMessage($message);
                        $message->setContact($contact);
                        $em->persist($contact);
                    }
                    else
                    {
                        $contact->addMessage($message);
                        $em->persist($contact);
                    }
                    
                    
                    
    
                    //$em->persist($message);
                    $em->flush();
                    //$this->createJsonFileFromData($dataForm, $serializer);
                    //$jsonData = 

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
                catch (IOExceptionInterface $exception) {
                    throw $exception;
                }
                //catch(Exception $exception)
                //{
                //    $title = "Une erreur est survenue : " . $exception->getCode();
                //    $message = $exception->getMessage();
                //    return $this->render('exception/error.html.twig', [
                //        'title' => $title,
                //        'message' => $message
                //    ]);
                //}
                
                return $this->redirectToRoute('app_send');
            }
        }
        
        return $this->renderForm('form/index.html.twig', [
            'controller_name' => 'FormController',
            'form' => $form
        ]);
    }

    #[Route('/send', name: 'app_send', methods: ['GET'])]    
    public function send(Request $request)
    {
        return $this->render('form/success.html.twig', []);
    }

    
    
}


