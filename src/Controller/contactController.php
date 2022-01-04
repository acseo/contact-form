<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Contact;
use App\Entity\Message;


class contactController extends AbstractController
{
    /**
     * Retourne la vue du formulaire de contact
     * @Route("/", name="index")
     */
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            
            $message = new Message();
            $message->setContent($contactFormData['message']);

            // Si le contact n'existe pas on le crée sinon on set le message au contact existant
            $contact = $doctrine->getRepository(Contact::class)->findOneBy(array('email' => $contactFormData['email']));
            if($contact == null){
                $contact = new Contact();
                $contact->setName($contactFormData['nom']);
                $contact->setEmail($contactFormData['email']);
                
            }
            $message->setContact($contact);
            
            // Renvoie un message pour l'utilisateur
            $this->addFlash('success', 'Vore message a été envoyé');

            //Persiste les données en base
            $entityManager = $doctrine->getManager();
            $entityManager->persist($contact);
            $entityManager->persist($message);
            $entityManager->flush();

            // Creation du json
            $json_message = json_encode($contactFormData);
            $date = (new \DateTime())->format('YmdHis');
            //crée le dossier si il n'existe pas
            if (!is_dir($this->getParameter('app.messages'))) {
                mkdir($this->getParameter('app.messages'));
            }
            $path = $this->getParameter('app.messages')."message-".$date."-".$message->getId().'.json';
            file_put_contents($path,$json_message);

            return $this->redirectToRoute('index');
        }
        return $this->render('contact.html.twig', [
            'our_form' => $form->createView()
        ]);
    }

    /**
     * Retourne la vue avec la liste des messages à traiter
     * @Route("/admin", name="admin")
     */

    public function admin(Request $request, ManagerRegistry $doctrine): Response
    {
        $contacts = $doctrine->getRepository(Contact::class)->findAll();

        return $this->render('admin.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * Passe le statut du message à "traitée"
     * @Route("/admin/message-processed/{id}", name="processedMessage", methods={"GET"})
     */

    public function setProcessedMessage(Request $request,int $id, ManagerRegistry $doctrine): JsonResponse
    {
        $message = $doctrine->getRepository(Message::class)->find($id);
        if($message != null){
            $message->setisProcessed(true);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($message);
            $entityManager->flush();
            // retourne jsonresponse pour traitement dans l'ajax
            return new JsonResponse(['id'=>$id,'status'=>'success']);
        }else{
            return new JsonResponse(['id'=>$id,'status'=>'not found']);
        }
    }

}