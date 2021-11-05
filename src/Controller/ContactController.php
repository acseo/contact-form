<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Entity\ContactUser;
use App\Form\ContactType;
use App\Repository\ContactUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use function PHPUnit\Framework\isNull;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, ValidatorInterface $validator): Response
    {

        $contactMessage = new ContactMessage();
        // récupération du formulaire de contact
        $contactMessageForm = $this->createForm(ContactType::class,$contactMessage);
        //  on lie la request avec l'objet de contactMessage
        $contactMessageForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        // si formulaire valide
        if($contactMessageForm->isSubmitted() && $contactMessageForm->isValid()){
            /** @var ContactMessage $contactMessage */
            $contactMessage = $contactMessageForm->getData(); // @var $contactMessage ContactMessage
            //  on regarde si on a déjà un message de ce user
            /** @var ContactUser $contactUser */
            $contactUser = $em->getRepository(ContactUser::class)->findOneBy(['email' => $contactMessage->getContactUser()->getEmail()]);
            // dans le cas ou il existe déjà on remplace le contactUser du form par celui existant en db
            if($contactUser != null){

                $contactMessage->setContactUser($contactUser);
            }
            // on sauvegarde le message
            $em->persist($contactMessage);
            $em->flush();

            // fonction de création du Json
            $json_data = $contactMessage->jsonSerialize();

            // getting path
            $path = $this->getParameter('app.contact_messages')."Contact-msg-".$contactMessage->getId().'.json';
            //push File
            file_put_contents($path,$json_data);

            $this->addFlash(
                'success',
                "Votre message a bien été envoyé"
            );
            return $this->redirect('home');

        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'contactForm' => $contactMessageForm->createView()
        ]);
    }
}
